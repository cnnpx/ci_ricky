<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customergroup extends MY_Controller {

    public function index(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Danh sách Nhóm Khách hàng',
                array('scriptFooter' => array('js' => 'js/customergroup.js'))
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'customer_group')) {
                $this->load->model('Mcustomergroups');
                $data['listCustomerGroups'] = $this->Mcustomergroups->getBy(array('StatusId' => STATUS_ACTIVED));
                $this->load->view('customer/customer_group', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function update(){
        $postData = $this->arrayFromPost(array('CustomerGroupName'));
        if(!empty($postData['CustomerGroupName'])) {
            $postData['StatusId'] = STATUS_ACTIVED;
            $customerGroupId = $this->input->post('CustomerGroupId');
            $this->load->model('Mcustomergroups');
            $flag = $this->Mcustomergroups->save($postData, $customerGroupId);
            if ($flag > 0) {
                $postData['CustomerGroupId'] = $flag;
                $postData['IsAdd'] = ($customerGroupId > 0) ? 0 : 1;
                echo json_encode(array('code' => 1, 'message' => "Cập nhật Nhóm Khách hàng thành công", 'data' => $postData));
            }
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function delete(){
        $customerGroupId = $this->input->post('CustomerGroupId');
        if($customerGroupId > 0){
            $this->load->model('Mcustomergroups');
            $flag = $this->Mcustomergroups->changeStatus(0, $customerGroupId);
            if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa Nhóm Khách hàng thành công"));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}
