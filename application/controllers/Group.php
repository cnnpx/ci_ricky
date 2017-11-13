<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends MY_Controller {

	public function index(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Danh sách Nhóm quyền',
				array('scriptFooter' => array('js' => 'js/group.js'))
			);
			$listActions = $data['listActions'];
			if($this->Mactions->checkAccess($listActions, 'group')) {
				$this->load->model('Mgroups');
				$data['listGroups'] = $this->Mgroups->getBy(array('StatusId' => STATUS_ACTIVED));
				$this->load->view('setting/group', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function update(){
		$postData = $this->arrayFromPost(array('GroupName'));
		if(!empty($postData['GroupName'])) {
			$postData['StatusId'] = STATUS_ACTIVED;
			$groupId = $this->input->post('GroupId');
			$this->load->model('Mgroups');
			$flag = $this->Mgroups->save($postData, $groupId);
			if ($flag > 0) {
				$postData['GroupId'] = $flag;
				$postData['IsAdd'] = ($groupId > 0) ? 0 : 1;
				echo json_encode(array('code' => 1, 'message' => "Cập nhật Nhóm quyền thành công", 'data' => $postData));
			}
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
	
	public function delete(){
		$groupId = $this->input->post('GroupId');
		if($groupId > 0){
			$this->load->model('Mgroups');
			$flag = $this->Mgroups->changeStatus(0, $groupId);
			if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa Nhóm quyền thành công"));
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
}
