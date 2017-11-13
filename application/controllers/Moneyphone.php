<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moneyphone extends MY_Controller {

	public function index(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Danh sách Máy nạp tiền',
				array('scriptFooter' => array('js' => 'js/moneyphone.js'))
			);
			if($this->Mactions->checkAccess($data['listActions'], 'moneyphone')) {
				$this->load->model('Mmoneyphones');
				$data['listMoneyPhones'] = $this->Mmoneyphones->getBy(array('StatusId' => STATUS_ACTIVED));
				$this->load->view('setting/moneyphone', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function update(){
		$postData = $this->arrayFromPost(array('MoneyPhoneName'));
		if(!empty($postData['MoneyPhoneName'])) {
			$postData['StatusId'] = STATUS_ACTIVED;
			$moneyPhoneId = $this->input->post('MoneyPhoneId');
			$this->load->model('Mmoneyphones');
			$flag = $this->Mmoneyphones->save($postData, $moneyPhoneId);
			if ($flag > 0) {
				$postData['MoneyPhoneId'] = $flag;
				$postData['IsAdd'] = ($moneyPhoneId > 0) ? 0 : 1;
				echo json_encode(array('code' => 1, 'message' => "Cập nhật Máy nạp tiền thành công", 'data' => $postData));
			}
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
	
	public function delete(){
		$moneyPhoneId = $this->input->post('MoneyPhoneId');
		if($moneyPhoneId > 0){
			$this->load->model('Mmoneyphones');
			$flag = $this->Mmoneyphones->changeStatus(0, $moneyPhoneId);
			if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa Máy nạp tiền thành công"));
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
}