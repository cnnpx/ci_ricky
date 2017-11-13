<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends MY_Controller{

    public function updateItem(){
        $user = $this->session->userdata('user');
        if($user){
            $itemIds = json_decode(trim($this->input->post('ItemIds')), true);
            $tagNames = json_decode(trim($this->input->post('TagNames')), true);
            if(!empty($itemIds) && !empty($tagNames)){
                $itemTypeId = $this->input->post('ItemTypeId');
                $changeTagTypeId = $this->input->post('ChangeTagTypeId'); // 1- add 2- remove
                $this->load->model('Mtags');
                $flag = $this->Mtags->updateItem($itemIds, $tagNames, $itemTypeId, $changeTagTypeId);
                if ($flag) echo json_encode(array('code' => 1, 'message' => "Cập nhật nhãn thành công"));
                else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}