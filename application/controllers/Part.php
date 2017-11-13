<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part extends MY_Controller {

	public function index(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Danh sách Bộ phận',
				array('scriptFooter' => array('js' => 'js/part.js'))
			);
			$listActions = $data['listActions'];
			if($this->Mactions->checkAccess($listActions, 'part')) {
				$this->load->model('Mparts');
				$data['listParts'] = $this->Mparts->getBy(array('StatusId' => STATUS_ACTIVED));
				$this->load->view('setting/part', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function update(){
		$postData = $this->arrayFromPost(array('PartName'));
		if(!empty($postData['PartName'])) {
			$postData['StatusId'] = STATUS_ACTIVED;
			$partId = $this->input->post('PartId');
			$this->load->model('Mparts');
			$flag = $this->Mparts->save($postData, $partId);
			if ($flag > 0) {
				$postData['PartId'] = $flag;
				$postData['IsAdd'] = ($partId > 0) ? 0 : 1;
				echo json_encode(array('code' => 1, 'message' => "Cập nhật Bộ phận thành công", 'data' => $postData));
			}
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
	
	public function delete(){
		$partId = $this->input->post('PartId');
		if($partId > 0){
			$this->load->model('Mparts');
			$flag = $this->Mparts->changeStatus(0, $partId);
			if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa Bộ phận thành công"));
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
}
