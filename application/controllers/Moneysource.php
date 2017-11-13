<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moneysource extends MY_Controller {

	public function index(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Danh sách Nguồn tiền',
				array('scriptFooter' => array('js' => 'js/moneysource.js'))
			);
			if($this->Mactions->checkAccess($data['listActions'], 'moneysource')) {
				$this->load->model('Mmoneysources');
				$data['listMoneySources'] = $this->Mmoneysources->getBy(array('StatusId' => STATUS_ACTIVED));
				$this->load->view('setting/moneysource', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function update(){
		$postData = $this->arrayFromPost(array('MoneySourceName'));
		if(!empty($postData['MoneySourceName'])) {
			$postData['StatusId'] = STATUS_ACTIVED;
			$moneySourceId = $this->input->post('MoneySourceId');
			$this->load->model('Mmoneysources');
			$flag = $this->Mmoneysources->save($postData, $moneySourceId);
			if ($flag > 0) {
				$postData['MoneySourceId'] = $flag;
				$postData['IsAdd'] = ($moneySourceId > 0) ? 0 : 1;
				echo json_encode(array('code' => 1, 'message' => "Cập nhật nguồn tiền thành công", 'data' => $postData));
			}
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
	
	public function delete(){
		$moneySourceId = $this->input->post('MoneySourceId');
		if($moneySourceId > 0){
			$this->load->model('Mmoneysources');
			$flag = $this->Mmoneysources->changeStatus(0, $moneySourceId);
			if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa nguồn tiền thành công"));
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
}