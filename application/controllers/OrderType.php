<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordertype extends MY_Controller {

    public function index(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Danh sách loại đơn hàng',
                array('scriptFooter' => array('js' => 'js/order_type.js'))
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'orderType')) {
                $this->load->model('Mordertypes');
                $data['listOrderTypes'] = $this->Mordertypes->getBy(array('StatusId' => STATUS_ACTIVED));
                $this->load->view('setting/order_type', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function update(){
        $postData = $this->arrayFromPost(array('OrderTypeName'));
        if(!empty($postData['OrderTypeName'])) {
            $postData['StatusId'] = STATUS_ACTIVED;
            $orderTypeId = $this->input->post('OrderTypeId');
            $this->load->model('Mordertypes');
            $flag = $this->Mordertypes->save($postData, $orderTypeId);
            if ($flag > 0) {
                $postData['OrderTypeId'] = $flag;
                $postData['IsAdd'] = ($orderTypeId > 0) ? 0 : 1;
                echo json_encode(array('code' => 1, 'message' => "Cập nhật loại đơn hàng thành công", 'data' => $postData));
            }
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function delete(){
        $orderTypeId = $this->input->post('OrderTypeId');
        if($orderTypeId > 0){
            $this->load->model('Mordertypes');
            $flag = $this->Mordertypes->changeStatus(0, $orderTypeId);
            if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa loại đơn hàng thành công"));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}
