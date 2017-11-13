<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Otherservice extends MY_Controller {

    public function index(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Danh sách dịch vụ đơn hàng',
                array('scriptFooter' => array('js' => 'js/other_service.js'))
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'ortherservice')) {
                $this->load->model('Motherservices');
                $data['listOtherServices'] = $this->Motherservices->getBy(array('StatusId' => STATUS_ACTIVED));
                $this->load->view('setting/other_service', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function update(){
        $postData = $this->arrayFromPost(array('OtherServiceName'));
        if(!empty($postData['OtherServiceName'])) {
            $postData['StatusId'] = STATUS_ACTIVED;
            $otherServiceId = $this->input->post('OtherServiceId');
            $this->load->model('Motherservices');
            $flag = $this->Motherservices->save($postData, $otherServiceId);
            if ($flag > 0) {
                $postData['OtherServiceId'] = $flag;
                $postData['IsAdd'] = ($otherServiceId > 0) ? 0 : 1;
                echo json_encode(array('code' => 1, 'message' => "Cập nhật dịch vụ đơn hàng thành công", 'data' => $postData));
            }
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function delete(){
        $otherServiceId = $this->input->post('OtherServiceId');
        if($otherServiceId > 0){
            $this->load->model('Motherservices');
            $flag = $this->Motherservices->changeStatus(0, $otherServiceId);
            if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa dịch vụ đơn hàng thành công"));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}
