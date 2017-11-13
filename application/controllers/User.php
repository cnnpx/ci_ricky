<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function index(){
		if(!$this->session->userdata('user')){
			$data = array('title' => 'Đăng nhập');
			if ($this->session->flashdata('txtSuccess')) $data['txtSuccess'] = $this->session->flashdata('txtSuccess');
			$this->load->helper('cookie');
			$data['userName'] = $this->input->cookie('userName', true);
			$data['userPass'] = $this->input->cookie('userPass', true);
			$this->load->view('user/login', $data);
		}
		else redirect('user/dashboard');
		//$this->gen_barcode('123456789');
	}

	/*private function gen_barcode($code, $bcs = 'code128', $height = 60, $text = 1) {
		$drawText = ($text != 1) ? FALSE : TRUE;
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		$barcodeOptions = array('text' => $code, 'barHeight' => $height, 'drawText' => $drawText);
		$rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
		$imageResource = Zend_Barcode::render($bcs, 'image', $barcodeOptions, $rendererOptions);
		return $imageResource;
	}*/

	public function logout(){
		$fields = array('user', 'configs');
		foreach($fields as $field) $this->session->unset_userdata($field);
		redirect('user');
	}

	public function forgotPass(){
		$this->load->view('user/forgotpass', array('title' => 'Quên mật khẩu'));
	}

	public function sendToken(){
		$email = trim($this->input->post('Email'));
		if(!empty($email)){
			$user = $this->Musers->getBy(array('StatusId' => STATUS_ACTIVED, 'Email' => $email), true, "", "UserId,FullName");
			if($user){
				$token = bin2hex(mcrypt_create_iv(10, MCRYPT_DEV_RANDOM));
				$message = "Xin chào {$user['FullName']}<br/>Xin vào link ".base_url('user/changePass/'.$token).' để đổi mật khẩu.';
				$configs = $this->session->userdata('configs');
				if(!$configs) $configs = array();
				$emailFrom = isset($configs['EMAIL_COMPANY']) ? $configs['EMAIL_COMPANY'] : 'dathang86@gmail.com';
				$companyName = isset($configs['COMPANY_NAME']) ? $configs['COMPANY_NAME'] : 'Đặt hàng 86';
				$flag = $this->sendMail($emailFrom, $companyName, $email, 'Lấy lại mật khẩu', $message);
				if($flag){
					$this->Musers->save(array('Token' => $token), $user['UserId']);
					$this->load->view('user/forgotpass', array('title' => 'Quên mật khẩu', 'txtSuccess' => 'Kiểm tra email và làm theo hướng dẫn'));
				}
			}
			else $this->load->view('user/forgotpass', array('title' => 'Quên mật khẩu', 'txtError' => 'Người dùng không tốn tại hoặc chưa kích hoạt!'));
		}
		else $this->load->view('user/forgotpass', array('title' => 'Quên mật khẩu', 'txtError' => 'Email không được bỏ trống!'));
	}

	public function changePass($token = ''){
		$data = array('title' => 'Đổi mật khẩu', 'token' => $token);
		$isWrongToken = true;
		if(!empty($token)){
			$user = $this->Musers->getBy(array('StatusId' => STATUS_ACTIVED, 'Token' => $token), true, "", "UserId");
			if($user){
				if($this->input->post('UserPass')) {
					$postData = $this->arrayFromPost(array('UserPass', 'RePass'));
					if (!empty($postData['UserPass']) && $postData['UserPass'] == $postData['RePass']) {
						$this->Musers->save(array('UserPass' => md5($postData['UserPass']), 'Token' => ''), $user['UserId'], array('Token'));
						$this->session->set_flashdata('txtSuccess', "Đổi mật khẩu thành công");
						redirect('user');
						exit();
					}
					else $data['txtError'] = "Mật khẩu không trùng";
				}
			}
			else {
				$data['txtError'] = "Mã Token không dúng";
				$isWrongToken = false;
			}
		}
		else {
			$data['txtError'] = "Mã Token không dúng";
			$isWrongToken = false;
		}
		$data['isWrongToken'] = $isWrongToken;
		$this->load->view('user/changepass', $data);
	}

	public function dashboard(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Dashboard'
				//array('scriptFooter' => array('js' => array('vendor/plugins/jquery.matchHeight.js', 'js/dashboard.js?20170712')))
			);
			$this->load->view('user/dashboard', $data);
		}
		else redirect('user');
	}

	public function permission(){
		$this->load->view('user/permission');
	}

	public function profile(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Trang cá nhân - '.$user['FullName'],
				array(
					'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
					'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js', 'js/user_profile.js'))
				)
			);
			$this->load->model('Mprovinces');
			$data['listProvinces'] = $this->Mprovinces->getList();
			$this->load->view('user/profile', $data);
		}
		else redirect('user');
	}

	public function staff(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Danh sách Nhân viên',
				array('scriptFooter' => array('js' => 'js/user_list.js'))
			);
			$listActions = $data['listActions'];
			if($this->Mactions->checkAccess($listActions, 'user/staff')) {
				$data['deleteUser'] = $this->Mactions->checkAccess($listActions, 'user/delete');
				$data['changeStatus'] = $this->Mactions->checkAccess($listActions, 'user/edit');
				$this->load->model('Mprovinces');
				$data['listProvinces'] = $this->Mprovinces->getList();
				$postData = $this->arrayFromPost(array('UserName', 'FullName', 'Email', 'PhoneNumber', 'StatusId', 'GenderId', 'ProvinceId', 'DegreeName'));
				$rowCount = $this->Musers->getCount($postData);
				$data['listUsers'] = array();
				if($rowCount > 0){
					$perPage = 20;
					$pageCount = ceil($rowCount / $perPage);
					$page = $this->input->post('PageId');
					if(!is_numeric($page) || $page < 1) $page = 1;
					$data['listUsers'] = $this->Musers->search($postData, $perPage, $page);
					$data['paggingHtml'] = getPaggingHtml($page, $pageCount);
				}
				$this->load->view('user/list', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function add(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Thêm Nhân viên',
				array(
					'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
					'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js', 'js/user_update.js'))
				)
			);
			if ($this->Mactions->checkAccess($data['listActions'], 'user/add')) {
				$this->load->model('Mprovinces');
				$data['listProvinces'] = $this->Mprovinces->getList();
				$this->load->view('user/add', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function edit($userId = 0){
		if($userId > 0) {
			$user = $this->session->userdata('user');
			if ($user) {
				$data = $this->commonData($user,
					'Cập nhật nhân viên',
					array(
						'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
						'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js', 'js/user_update.js'))
					)
				);
				$userEdit = $this->Musers->get($userId);
				if ($userEdit) {
					$listActions = $data['listActions'];
					if ($this->Mactions->checkAccess($listActions, 'user/view')) {
						$data['canEdit'] = $this->Mactions->checkAccess($listActions, 'user/edit');
						$data['userId'] = $userId;
						$data['userEdit'] = $userEdit;
						$this->load->model('Mprovinces');
						$data['listProvinces'] = $this->Mprovinces->getList();
						$this->load->view('user/edit', $data);
					}
					else $this->load->view('user/permission', $data);
				}
				else {
					$data['userId'] = 0;
					$data['txtError'] = "Không tìm thấy nhân viên";
					$this->load->view('user/edit', $data);
				}
			}
			else redirect('user');
		}
		else redirect('user/profile');
	}
}
