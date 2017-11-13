<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends MY_Controller {

	public function index(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Danh sách Chức vụ',
				array('scriptFooter' => array('js' => 'js/position.js'))
			);
			$listActions = $data['listActions'];
			if($this->Mactions->checkAccess($listActions, 'position')) {
				$this->load->model('Mpositions');
				$data['listPositions'] = $this->Mpositions->getBy(array('StatusId' => STATUS_ACTIVED));
				$this->load->view('setting/position', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function update(){
		$postData = $this->arrayFromPost(array('PositionName'));
		if(!empty($postData['PositionName'])) {
			$postData['StatusId'] = STATUS_ACTIVED;
			$positionId = $this->input->post('PositionId');
			$this->load->model('Mpositions');
			$flag = $this->Mpositions->save($postData, $positionId);
			if ($flag > 0) {
				$postData['PositionId'] = $flag;
				$postData['IsAdd'] = ($positionId > 0) ? 0 : 1;
				echo json_encode(array('code' => 1, 'message' => "Cập nhật Chức vụ thành công", 'data' => $postData));
			}
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
	
	public function delete(){
		$positionId = $this->input->post('PositionId');
		if($positionId > 0){
			$this->load->model('Mpositions');
			$flag = $this->Mpositions->changeStatus(0, $positionId);
			if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa Chức vụ thành công"));
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
}
