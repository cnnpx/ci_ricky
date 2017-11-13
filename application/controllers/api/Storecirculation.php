<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storecirculation extends  MY_Controller {

    public function update(){
        $user = $this->session->userdata('user');
        if ($user) {
            $postData = $this->arrayFromPost(array('StoreCirculationCode', 'StoreSourceId', 'StoreDestinationId', 'OrderStatusId', 'StatusId', 'DeliveryTypeId', 'Comment', 'CancelReason', 'HandleDate'));
            if(!empty($postData['HandleDate'])) $postData['HandleDate'] = ddMMyyyyToDate($postData['HandleDate']);
            $storeCirculationId = $this->input->post('StoreCirculationId');
            $crDateTime = getCurentDateTime();
            $actionLogs = array(
                'ItemTypeId' => 7,
                'CrUserId' => $user['UserId'],
                'CrDateTime' => $crDateTime
            );
            if($storeCirculationId > 0){
                $postData['UpdateUserId'] = $user['UserId'];
                $postData['UpdateDateTime'] = $crDateTime;
                $actionLogs['ActionTypeId'] = 2;
                $actionLogs['Comment'] = $user['FullName'] . ': Cập nhật lưu chuyển kho';
            }
            else{
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = $crDateTime;
                $actionLogs['ActionTypeId'] = 1;
                $actionLogs['Comment'] = $user['FullName'] . ': Thêm mới lưu chuyển kho';
            }
            $products = json_decode(trim($this->input->post('Products')), true);
            $tagNames = json_decode(trim($this->input->post('TagNames')), true);
            $this->load->model('Mstorecirculations');
            $storeCirculationId = $this->Mstorecirculations->update($postData, $storeCirculationId, $products, $tagNames, $actionLogs);
            if($storeCirculationId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật Lưu chuyển kho thành công", 'data' => $storeCirculationId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeStatusBatch(){
        $user = $this->session->userdata('user');
        if($user){
            $storeCirculationIds = json_decode(trim($this->input->post('ItemIds')), true);
            $statusId = $this->input->post('StatusId');
            if(!empty($storeCirculationIds) && $statusId >= 0){
                $this->load->model('Mstorecirculations');
                $flag = $this->Mstorecirculations->changeStatusBatch($storeCirculationIds, $statusId, $user);
                if($flag) {
                    $msg = 'Xóa Lưu chuyển kho thành công';
                    $statusName = '';
                    if ($statusId > 0) {
                        $msg = 'Thay đổi trạng thái thành công';
                        $statusName = '<span class="' . $this->Mconstants->labelCss[$statusId] . '">' . $this->Mconstants->orderStatus[$statusId] . '</span>';
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
        $typeId = $this->input->post('TypeId');
        if(!empty($barCode) && $typeId > 0){
            $this->loadModel(array('Mstorecirculations', 'Mscanbarcodes', 'Mscanproducts', 'Mproducts'));
            $storeCirculation= $this->Mstorecirculations->getBy(array('StoreCirculationCode' => $barCode), true, '', 'StoreCirculationId,OrderStatusId,StatusId,CrDateTime');
            if($storeCirculation) {
                if ($typeId == 1) { // tra ve ds kien hang
                    $listScanBarCodes = $this->Mscanbarcodes->getBy(array('ItemId' => $storeCirculation['StoreCirculationId'], 'ScanTypeId' => 3));//kien hang luc xuat LCK
                    $packages = array();
                    $productNames = array();
                    $barCodes = array();
                    foreach($listScanBarCodes as $sb){
                        $listScanProducts = $this->Mscanproducts->getBy(array('ScanBarCodeId' => $sb['ScanBarCodeId']), false, '', 'BarCode, Quantity');
                        $products = array();
                        foreach($listScanProducts as $sp){
                            if(!isset($productNames[$sp['BarCode']])) $productNames[$sp['BarCode']] = $this->Mproducts->getProductName(0, 0, $sp['BarCode']);
                            $sp['ProductName'] = $productNames[$sp['BarCode']];
                            $products[] = $sp;
                        }
                        if(!in_array($sb['ScanName'], $barCodes)) {
                            $packages[] = array(
                                'BarCode' => $sb['ScanName'],
                                'Products' => $products
                            );
                            $barCodes[] = $sb['ScanName'];
                        }
                    }
                    echo json_encode(array('code' => 1, 'message' => "Lấy thông tin đơn hàng thành công", 'data' => array('BarCode' => $barCode, 'Packages' => $packages)));
                }
                elseif ($typeId == 2) { //tra ve ds sp tren web
                    $data = array(
                        'Products' => $this->Mproducts->getInfoByStoreCirculation($storeCirculation['StoreCirculationId']),
                        'BarCode' => $barCode,
                        'message' => 'Lấy thông tin đơn hàng thành công',
                        'OrderStatusId' => array($storeCirculation['OrderStatusId'] => $this->Mconstants->orderStatus[$storeCirculation['OrderStatusId']]),
                        'StatusId' => array($storeCirculation['StatusId'] => $this->Mconstants->status[$storeCirculation['StatusId']]),
                        'CrDateTime' => ddMMyyyy($storeCirculation['CrDateTime'])
                    );
                    echo json_encode(array('code' => 1, 'message' => "Lấy thông tin đơn hàng thành công", 'data' => $data));
                }
            }
            else echo json_encode(array('code' => -1, 'message' => "Không tìm thấy đơn Lưu chuyển kho"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function scan(){
        header('Content-Type: application/json');
        $userId = trim($this->input->post('UserId'));
        $barCode = trim($this->input->post('BarCode'));
        $scanTypeId = trim($this->input->post('ScanTypeId'));
        $createdDate = trim($this->input->post('CreatedDate'));
        $data = json_decode(trim($this->input->post('Data')), true);
        if($userId > 0 && !empty($barCode) && $scanTypeId > 0 && !empty($data)){
            $this->loadModel(array('Mstorecirculations', 'Mscanbarcodes'));
            $storeCirculation = $this->Mstorecirculations->getBy(array('StoreCirculationCode' => $barCode), true, '', 'StoreCirculationId, StoreSourceId, StoreDestinationId');
            if($storeCirculation){
                $crDateTime = getCurentDateTime();
                if(!empty($createdDate)) $createdDate = ddMMyyyyToDate($createdDate, 'd/m/Y H:i:s', 'Y-m-d H:i:s');
                else $createdDate = $crDateTime;
                $scanBarCodes = array();
                foreach($data as $sb){
                    $scanBarCodes[] = array(
                        'ScanName' => $sb['BarCode'],
                        'ScanTypeId' => $scanTypeId,
                        'ItemId' => $storeCirculation['StoreCirculationId'],
                        'StoreId' => $scanTypeId == 3 ? $storeCirculation['StoreSourceId'] : $storeCirculation['StoreDestinationId'],
                        'ScanDateTime' => $createdDate,
                        'CrUserId' => $userId,
                        'CrDateTime' => $crDateTime,
                        'Products' => $sb['Products']
                    );
                }
                $flag = $this->Mscanbarcodes->insertBatch($scanBarCodes);
                if($flag) echo json_encode(array('code' => 1, 'message' => "Cập nhật dữ liệu thành công"));
                else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Không tìm thấy đơn Lưu chuyển kho"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}