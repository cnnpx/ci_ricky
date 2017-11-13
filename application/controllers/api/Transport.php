<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport extends MY_Controller{

    public function update(){
        $user = $this->session->userdata('user');
        if($user){
            $postData = $this->arrayFromPost(array('TransportCode', 'OrderId', 'CustomerId', 'TransportUserId', 'TransportStatusId', 'TransportTypeId', 'TransporterId', 'StoreId', 'Tracking', 'Weight', 'CODCost', 'Comment', 'CancerReasonId', 'CancerReasonText'));
            $transportId = $this->input->post('TransportId');
            $crDateTime = getCurentDateTime();
            $actionLogs = array(
                'ItemTypeId' => 9,
                'CrUserId' => $user['UserId'],
                'CrDateTime' => $crDateTime
            );
            if($transportId > 0){
                $postData['UpdateUserId'] = $user['UserId'];
                $postData['UpdateDateTime'] = $crDateTime;
                $actionLogs['ActionTypeId'] = 2;
                $actionLogs['Comment'] = $user['FullName'] . ': Cập nhật vận chuyển';
            }
            else{
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = $crDateTime;
                $actionLogs['ActionTypeId'] = 1;
                $actionLogs['Comment'] = $user['FullName'] . ': Thêm mới vận chuyển';
            }
            $customerAddress = $this->arrayFromPost(array('CustomerId', 'CustomerName', 'Email', 'PhoneNumber', 'Address', 'ProvinceId', 'DistrictId'));
            $customerAddress['CrUserId'] = $user['UserId'];
            $customerAddress['CrDateTime'] = $crDateTime;
            $tagNames = json_decode(trim($this->input->post('TagNames')), true);
            $this->load->model('Mtransports');
            $transportId = $this->Mtransports->update($postData, $transportId, $customerAddress, $tagNames, $actionLogs);
            if($transportId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật vận chuyển thành công", 'data' => $transportId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeStatusBatch(){
        $user = $this->session->userdata('user');
        if($user){
            $transportIds = json_decode(trim($this->input->post('ItemIds')), true);
            $statusId = $this->input->post('StatusId');
            if(!empty($transportIds) && $statusId >= 0){
                $this->load->model('Mtransports');
                $flag = $this->Mtransports->changeStatusBatch($transportIds, $statusId, $user);
                if($flag) {
                    $msg = 'Xóa vận chuyển thành công';
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
}