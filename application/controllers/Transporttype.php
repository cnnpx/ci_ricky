<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transporttype extends MY_Controller {

    public function index(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Danh sách Loại vận chuyển',
                array('scriptFooter' => array('js' => 'js/transport_type.js'))
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'transportType')) {
                $this->load->model('Mtransporttypes');
                $data['listTransportTypes'] = $this->Mtransporttypes->getBy(array('StatusId' => STATUS_ACTIVED));
                $this->load->view('setting/transport_type', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function update(){
        $postData = $this->arrayFromPost(array('TransportTypeName'));
        if(!empty($postData['TransportTypeName'])) {
            $postData['StatusId'] = STATUS_ACTIVED;
            $transportTypeId = $this->input->post('TransportTypeId');
            $this->load->model('Mtransporttypes');
            $flag = $this->Mtransporttypes->save($postData, $transportTypeId);
            if ($flag > 0) {
                $postData['TransportTypeId'] = $flag;
                $postData['IsAdd'] = ($transportTypeId > 0) ? 0 : 1;
                echo json_encode(array('code' => 1, 'message' => "Cập nhật loại vận chuyển thành công", 'data' => $postData));
            }
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function delete(){
        $transportTypeId = $this->input->post('TransportTypeId');
        if($transportTypeId > 0){
            $this->load->model('Mtransporttypes');
            $flag = $this->Mtransporttypes->changeStatus(0, $transportTypeId);
            if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa loại vận chuyển thành công"));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}
