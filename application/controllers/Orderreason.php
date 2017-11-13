<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orderreason extends MY_Controller {

    public function index(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Danh sách lý do mua hàng',
                array('scriptFooter' => array('js' => 'js/order_reason.js'))
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'orderReasons')) {
                $this->load->model('Morderreasons');
                $data['listOrderReasons'] = $this->Morderreasons->getBy(array('StatusId' => STATUS_ACTIVED));
                $this->load->view('setting/order_reason', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function update(){
        $postData = $this->arrayFromPost(array('OrderReasonName'));
        if(!empty($postData['OrderReasonName'])) {
            $postData['StatusId'] = STATUS_ACTIVED;
            $orderReasonId = $this->input->post('OrderReasonId');
            $this->load->model('Morderreasons');
            $flag = $this->Morderreasons->save($postData, $orderReasonId);
            if ($flag > 0) {
                $postData['OrderReasonId'] = $flag;
                $postData['IsAdd'] = ($orderReasonId > 0) ? 0 : 1;
                echo json_encode(array('code' => 1, 'message' => "Cập nhật lý do mua hàng thành công", 'data' => $postData));
            }
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function delete(){
        $orderReasonId = $this->input->post('OrderReasonId');
        if($orderReasonId > 0){
            $this->load->model('Morderreasons');
            $flag = $this->Morderreasons->changeStatus(0, $orderReasonId);
            if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa lý do mua hàng thành công"));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}
