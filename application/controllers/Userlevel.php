<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLevel extends MY_Controller {

	public function index(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Danh sách Level (Thâm niên)',
				array('scriptFooter' => array('js' => 'js/user_level.js'))
			);
			$listActions = $data['listActions'];
			if($this->Mactions->checkAccess($listActions, 'userlevel')) {
				$this->load->model('Muserlevels');
				$data['listUserLevels'] = $this->Muserlevels->getBy(array('StatusId' => STATUS_ACTIVED));
				$this->load->view('setting/user_level', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function update(){
		$postData = $this->arrayFromPost(array('UserLevelName'));
		if(!empty($postData['UserLevelName'])) {
			$postData['StatusId'] = STATUS_ACTIVED;
			$userlevelId = $this->input->post('UserLevelId');
			$this->load->model('Muserlevels');
			$flag = $this->Muserlevels->save($postData, $userlevelId);
			if ($flag > 0) {
				$postData['UserLevelId'] = $flag;
				$postData['IsAdd'] = ($userlevelId > 0) ? 0 : 1;
				echo json_encode(array('code' => 1, 'message' => "Cập nhật Level (Thâm niên) thành công", 'data' => $postData));
			}
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
	
	public function delete(){
		$userlevelId = $this->input->post('UserLevelId');
		if($userlevelId > 0){
			$this->load->model('Muserlevels');
			$flag = $this->Muserlevels->changeStatus(0, $userlevelId);
			if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa Level (Thâm niên) thành công"));
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
}
