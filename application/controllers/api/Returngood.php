<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returngood extends MY_Controller{

    public function update(){
        $user = $this->session->userdata('user');
        if ($user) {
            $postData = $this->arrayFromPost(array('CustomerId', 'TransportStatusId', 'ReturnGoodTypeId', 'StoreId', 'Comment'));
            $returnGoodId = $this->input->post('ReturnGoodId');
            $crDateTime = getCurentDateTime();
            $actionLogs = array(
                'ItemTypeId' => 14,
                'CrUserId' => $user['UserId'],
                'CrDateTime' => $crDateTime
            );
            if ($returnGoodId > 0) {
                $postData['UpdateUserId'] = $user['UserId'];
                $postData['UpdateDateTime'] = $crDateTime;
                $actionLogs['ActionTypeId'] = 2;
                $actionLogs['Comment'] = $user['FullName'] . ': Cập nhật Đơn hoàn hàng về';
            }
            else {
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = $crDateTime;
                $actionLogs['ActionTypeId'] = 1;
                $actionLogs['Comment'] = $user['FullName'] . ': Thêm mới Đơn hoàn hàng về';
            }
            $customerAddress = $this->arrayFromPost(array('CustomerId', 'CustomerName', 'Email', 'PhoneNumber', 'Address', 'ProvinceId', 'DistrictId'));
            $customerAddress['CrUserId'] = $user['UserId'];
            $customerAddress['CrDateTime'] = $crDateTime;
            $products = json_decode(trim($this->input->post('Products')), true);
            $tagNames = json_decode(trim($this->input->post('TagNames')), true);
            $this->load->model('Mreturngoods');
            $returnGoodId = $this->Mreturngoods->update($postData, $returnGoodId, $customerAddress, $products, $tagNames, $actionLogs);
            if ($returnGoodId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật đơn hàng thành công", 'data' => $returnGoodId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeStatusBatch(){
        $user = $this->session->userdata('user');
        if($user){
            $returnGoodIds = json_decode(trim($this->input->post('ItemIds')), true);
            $statusId = $this->input->post('StatusId');
            if(!empty($returnGoodIds) && $statusId >= 0){
                $this->load->model('Mreturngoods');
                $flag = $this->Mreturngoods->changeStatusBatch($returnGoodIds, $statusId, $user);
                if($flag) {
                    $msg = 'Xóa Đơn hoàn hàng về thành công';
                    $statusName = '';
                    if ($statusId > 0) {
                        $msg = 'Thay đổi trạng thái thành công';
                        $statusName = '<span class="' . $this->Mconstants->labelCss[$statusId] . '">' . $this->Mconstants->transportStatus[$statusId] . '</span>';
                    }
                    echo json_encode(array('code' => 1, 'message' => $msg, 'data' => $statusName));
                }
                else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function getByBarCode(){
        header('Content-Type: application/json');
        $barCode = trim($this->input->post('BarCode'));
        if(!empty($barCode)){
            $this->loadModel(array('Mreturngoods', 'Mcustomers', 'Mproducts'));
            $returnGood= $this->Mreturngoods->getBy(array('ReturnGoodCode' => $barCode), true, '', 'ReturnGoodId,CustomerId,TransportStatusId,ReturnGoodTypeId,CrDateTime');
            if($returnGood) {
                $data = array(
                    'Customer' => $this->Mcustomers->get($returnGood['CustomerId'], true, '', 'FullName, PhoneNumber'),
                    'Products' => $this->Mproducts->getInfoByReturnGood($returnGood['ReturnGoodId']),
                    'BarCode' => $barCode,
                    'message' => 'Lấy thông tin đơn hàng thành công',
                    'TransportStatusId' => array($returnGood['TransportStatusId'] => $this->Mconstants->transportStatus[$returnGood['TransportStatusId']]),
                    'ReturnGoodTypeId' => array($returnGood['ReturnGoodTypeId'] => $this->Mconstants->returnGoodTypes[$returnGood['ReturnGoodTypeId']]),
                    'CrDateTime' => ddMMyyyy($returnGood['CrDateTime'])
                );
                echo json_encode(array('code' => 1, 'message' => "Lấy thông tin đơn hàng thành công", 'data' => $data));
            }
            else echo json_encode(array('code' => -1, 'message' => "Không tìm thấy đơn hoàn đơn hàng"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function scan(){
        header('Content-Type: application/json');
        $userId = trim($this->input->post('UserId'));
        $barCode = trim($this->input->post('BarCode'));
        $createdDate = trim($this->input->post('CreatedDate'));
        $data = json_decode(trim($this->input->post('Data')), true);
        if($userId > 0 && !empty($barCode) && !empty($data)){
            $this->loadModel(array('Mreturngoods', 'Mscanbarcodes'));
            $returnGood= $this->Mreturngoods->getBy(array('ReturnGoodCode' => $barCode), true, '', 'ReturnGoodId,CustomerId,TransportStatusId,ReturnGoodTypeId,StoreId,CrDateTime');
            if($returnGood) {
                $crDateTime = getCurentDateTime();
                if(!empty($createdDate)) $createdDate = ddMMyyyyToDate($createdDate, 'd/m/Y H:i:s', 'Y-m-d H:i:s');
                else $createdDate = $crDateTime;
                $scanBarCodes = array();
                $scanBarCodes[] = array(
                    'ScanName' => $barCode,
                    'ScanTypeId' => 5,
                    'ItemId' => $returnGood['ReturnGoodId'],
                    'StoreId' => $returnGood['StoreId'],
                    'ScanDateTime' => $createdDate,
                    'CrUserId' => $userId,
                    'CrDateTime' => $crDateTime,
                    'Products' => $data
                );
                $flag = $this->Mscanbarcodes->insertBatch($scanBarCodes);
                if($flag) echo json_encode(array('code' => 1, 'message' => "Cập nhật dữ liệu thành công"));
                else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Không tìm thấy đơn Hoàn đơn hàng"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}