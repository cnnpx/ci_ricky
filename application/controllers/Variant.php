<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variant extends MY_Controller {

	public function index(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Danh sách Thuộc tính sản phẩm',
				array('scriptFooter' => array('js' => 'js/variant.js'))
			);
			$listActions = $data['listActions'];
			if($this->Mactions->checkAccess($listActions, 'variant')) {
				$this->load->model('Mvariants');
				$data['listVariants'] = $this->Mvariants->getBy(array('StatusId' => STATUS_ACTIVED));
				$this->load->view('setting/variant', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function update(){
		$postData = $this->arrayFromPost(array('VariantName'));
		if(!empty($postData['VariantName'])) {
			$postData['StatusId'] = STATUS_ACTIVED;
			$variantId = $this->input->post('VariantId');
			$this->load->model('Mvariants');
			$flag = $this->Mvariants->save($postData, $variantId);
			if ($flag > 0) {
				$postData['VariantId'] = $flag;
				$postData['IsAdd'] = ($variantId > 0) ? 0 : 1;
				echo json_encode(array('code' => 1, 'message' => "Cập nhật Thuộc tính sản phẩm thành công", 'data' => $postData));
			}
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
	
	public function delete(){
		$variantId = $this->input->post('VariantId');
		if($variantId > 0){
			$this->load->model('Mvariants');
			$flag = $this->Mvariants->changeStatus(0, $variantId);
			if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa Thuộc tính sản phẩm thành công"));
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
}
