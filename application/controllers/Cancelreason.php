<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancelreason extends MY_Controller {

    public function index(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Danh sách lý do hủy đơn hàng',
                array('scriptFooter' => array('js' => 'js/cancel_reason.js'))
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'cancelReasons')) {
                $this->load->model('Mcancelreasons');
                $data['listCancelReasons'] = $this->Mcancelreasons->getBy(array('StatusId' => STATUS_ACTIVED));
                $this->load->view('setting/cancel_reason', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function update(){
        $postData = $this->arrayFromPost(array('CancelReasonName'));
        if(!empty($postData['CancelReasonName'])) {
            $postData['StatusId'] = STATUS_ACTIVED;
            $cancelReasonId = $this->input->post('CancelReasonId');
            $this->load->model('Mcancelreasons');
            $flag = $this->Mcancelreasons->save($postData, $cancelReasonId);
            if ($flag > 0) {
                $postData['CancelReasonId'] = $flag;
                $postData['IsAdd'] = ($cancelReasonId > 0) ? 0 : 1;
                echo json_encode(array('code' => 1, 'message' => "Cập nhật lý do hủy đơn hàng thành công", 'data' => $postData));
            }
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function delete(){
        $cancelReasonId = $this->input->post('CancelReasonId');
        if($cancelReasonId > 0){
            $this->load->model('Mcancelreasons');
            $flag = $this->Mcancelreasons->changeStatus(0, $cancelReasonId);
            if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa lý do hủy đơn hàng thành công"));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}
