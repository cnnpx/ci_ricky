<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function updateProfile(){
		$user = $this->session->userdata('user');
		if($user) {
			$postData = $this->arrayFromPost(array('UserName', 'UserPass', 'NewPass', 'FullName', 'Email', 'GenderId', 'ProvinceId', 'Address', 'BirthDay', 'PhoneNumber', 'DegreeName', 'Avatar', 'Facebook'));
			$flag = false;
			if (!empty($postData['NewPass'])) {
				if ($user['UserPass'] == md5($postData['UserPass'])) {
					$flag = true;
					$postData['UserPass'] = md5($postData['NewPass']);
					unset($postData['NewPass']);
				}
				else echo json_encode(array('code' => -1, 'message' => "Mật khảu cũ không đúng"));
			}
			else {
				$flag = true;
				unset($postData['UserPass']);
				unset($postData['NewPass']);
			}
			if ($flag) {
				if ($this->Musers->checkExist($user['UserId'], $postData['UserName'], $postData['Email'], $postData['PhoneNumber'])) {
					echo json_encode(array('code' => -1, 'message' => "Tên đăng nhập hoặc Số điện thoại đã tồn tại trong hệ thống"));
				}
				else {
					$postData['BirthDay'] = ddMMyyyyToDate($postData['BirthDay']);
					$postData['Avatar'] = replaceFileUrl($postData['Avatar'], USER_PATH);
					$postData['CrUserId'] = $user['UserId'];
					$postData['CrDateTime'] = getCurentDateTime();
					$flag = $this->Musers->save($postData, $user['UserId']);
					if ($flag) {
						$user = array_merge($user, $postData);
						$this->session->set_userdata('user', $user);
						echo json_encode(array('code' => 1, 'message' => "Cập nhật thông tin cá nhân thành công"));
					}
					else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
				}
			}
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}

	public function changeStatus(){
		$userId = $this->input->post('UserId');
		$statusId = $this->input->post('StatusId');
		if($userId > 0 && $statusId >= 0 && $statusId <= count($this->Mconstants->status)) {
			$flag = $this->Musers->changeStatus($statusId, $userId);
			if($flag) {
				$txtSuccess = "";
				$statusName = "";
				if($statusId == 0) $txtSuccess = "Xóa {$this->input->post('UserTypeName')} thành công";
				else{
					$txtSuccess = "Đổi trạng thái thành công";
					$statusName = '<span class="' . $this->Mconstants->labelCss[$statusId] . '">' . $this->Mconstants->status[$statusId] . '</span>';
				}
				echo json_encode(array('code' => 1, 'message' => $txtSuccess, 'data' => array('StatusName' => $statusName)));
			}
			else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}

	public function saveUser(){
		$user = $this->session->userdata('user');
		$postData = $this->arrayFromPost(array('UserName', 'UserPass', 'FullName', 'Email', 'GenderId', 'StatusId', 'ProvinceId', 'Address', 'BirthDay', 'PhoneNumber', 'DegreeName', 'Facebook', 'Avatar'));
		$userId = $this->input->post('UserId');
		if(empty($postData['UserName'])) $postData['UserName'] = $postData['PhoneNumber'];
		if(!empty($postData['UserName']) && !empty($postData['FullName'])) {
			if ($this->Musers->checkExist($userId, $postData['UserName'], $postData['Email'], $postData['PhoneNumber'])) {
				echo json_encode(array('code' => -1, 'message' => "Tên đăng nhập hoặc Số điện thoại đã tồn tại trong hệ thống"));
			}
			else {
				$postData['BirthDay'] = ddMMyyyyToDate($postData['BirthDay']);
				$postData['Avatar'] = replaceFileUrl($postData['Avatar'], USER_PATH);
				$userPass = $postData['UserPass'];
				if ($userId == 0) $postData['UserPass'] = md5($userPass);
				else {
					unset($postData['UserPass']);
					$newPass = trim($this->input->post('NewPass'));
					if (!empty($newPass)) $postData['UserPass'] = md5($newPass);
				}
				$postData['CrUserId'] = ($user) ? $user['UserId'] : 0;
				$postData['CrDateTime'] = getCurentDateTime();
				$userId = $this->Musers->save($postData, $userId);
				if ($userId > 0) {
					if($user && $user['UserId'] == $userId){
						$user = array_merge($user, $postData);
						$this->session->set_userdata('user', $user);
					}
					if ($this->input->post('IsSendPass') == 'on') {
						$message = "Xin chào {$postData['FullName']}<br/>Thông tin đăng nhập của bạn là:<br/>Địa chỉ: " . base_url() . "<br/>Tên đăng nhập: {$postData['UserName']}<br/>Mật khẩu: {$userPass}";
						$configs = $this->session->userdata('configs');
						if (!$configs) $configs = array();
						$emailFrom = isset($configs['EMAIL_COMPANY']) ? $configs['EMAIL_COMPANY'] : 'ricky@gmail.com';
						$companyName = isset($configs['COMPANY_NAME']) ? $configs['COMPANY_NAME'] : 'Ricky';
						$this->sendMail($emailFrom, $companyName, $postData['Email'], 'Thông tin đăng nhập', $message);
					}
					echo json_encode(array('code' => 1, 'message' => "Cập nhật nhân viên thành công", 'data' => $userId));
				}
				else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
			}
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}

	public function checkLogin(){
		header('Content-Type: application/json');
		//log_message('error', json_encode($_POST));
		$postData = $this->arrayFromPost(array('UserName', 'UserPass', 'IsRemember', 'IsGetConfigs'));
		$userName = $postData['UserName'];
		$userPass = $postData['UserPass'];
		if(!empty($userName) && !empty($userPass)) {
			$configs = array();
			$user = $this->Musers->login($userName, $userPass);
			if ($user) {
				if (empty($user['Avatar'])) $user['Avatar'] = NO_IMAGE;
				$this->session->set_userdata('user', $user);
				if ($postData['IsGetConfigs'] == 1) {
					$this->load->model('Mconfigs');
					$configs = $this->Mconfigs->getListMap();
					$this->session->set_userdata('configs', $configs);
				}
				if ($postData['IsRemember'] == 'on') {
					$this->load->helper('cookie');
					$this->input->set_cookie(array('name' => 'userName', 'value' => $userName, 'expire' => '86400'));
					$this->input->set_cookie(array('name' => 'userPass', 'value' => $userPass, 'expire' => '86400'));
				}
				echo json_encode(array('code' => 1, 'message' => "Đăng nhập thành công", 'data' => array('User' => $user, 'Configs' => $configs, 'message' => "Đăng nhập thành công")));
			}
			else echo json_encode(array('code' => 0, 'message' => "Đăng nhập không thành công"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Tên đăng nhập hoặc Mật khẩu không được bỏ trống"));
	}

	public function forgotPass(){
		header('Content-Type: application/json');
		$email = trim($this->input->post('Email'));
		if(!empty($email)){
			$user = $this->Musers->getBy(array('StatusId' => STATUS_ACTIVED, 'Email' => $email), true, "", "UserId,FullName");
			if($user){
				$userPass = bin2hex(mcrypt_create_iv(5, MCRYPT_DEV_RANDOM));
				$message = "Xin chào {$user['FullName']}.<br/> Mật khẩu mới của bạn là {$userPass}";
				$this->load->model('Mconfigs');
				$configs = $this->Mconfigs->getListMap();
				$emailFrom = isset($configs['EMAIL_COMPANY']) ? $configs['EMAIL_COMPANY'] : 'ricky@gmail.com';
				$companyName = isset($configs['COMPANY_NAME']) ? $configs['COMPANY_NAME'] : 'Ricky';
				$flag = $this->sendMail($emailFrom, $companyName, $email, 'Mật khẩu mới của bạn', $message);
				if($flag){
					$this->Musers->save(array('UserPass' => md5($userPass)), $user['UserId']);
					echo json_encode(array('code' => 1, 'message' => "Đã gửi mật khẩu vào {$email}", 'data' => array('message' => "Đăng nhập thành công")));
				}
				else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
			}
			else echo json_encode(array('code' => 0, 'message' => "Người dùng không tốn tại hoặc chưa kích hoạt"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Email không được bỏ trống"));
	}

	public function checkStatus(){
		header('Content-Type: application/json');
		$userName = trim($this->input->post('UserName'));
		if(!empty($userName)){
			echo json_encode(array('code' => 1, 'message' => "Nhân viên vẫn còn hiệu lực"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Tên đăng nhập không được bỏ trống"));
	}

	public function logout(){
		$fields = array('user', 'configs');
		foreach($fields as $field) $this->session->unset_userdata($field);
	}

	public function requestSendToken(){
		$email = trim($this->input->post('Email'));
		if(!empty($email)){
			$user = $this->Musers->getBy(array('StatusId' => STATUS_ACTIVED, 'Email' => $email), true, "", "UserId,FullName");
			if($user){
				$token = bin2hex(mcrypt_create_iv(10, MCRYPT_DEV_RANDOM));
				$message = "Xin chào {$user['FullName']}<br/>Xin vào link ".base_url('user/changePass/'.$token).' để đổi mật khẩu.';
				$configs = $this->session->userdata('configs');
				if(!$configs) $configs = array();
				$emailFrom = isset($configs['EMAIL_COMPANY']) ? $configs['EMAIL_COMPANY'] : 'ricky@gmail.com';
				$companyName = isset($configs['COMPANY_NAME']) ? $configs['COMPANY_NAME'] : 'Ricky';
				$flag = $this->sendMail($emailFrom, $companyName, $email, 'Lấy lại mật khẩu', $message);
				if($flag){
					$this->Musers->save(array('Token' => $token), $user['UserId']);
					echo json_encode(array('code' => 1, 'message' => "Kiểm tra email và làm theo hướng dẫn"));
				}
				else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
			}
			else echo json_encode(array('code' => 0, 'message' => "Người dùng không tốn tại hoặc chưa kích hoạt"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Email không được bỏ trống"));
	}

	public function getStore(){
		header('Content-Type: application/json');
		$userId = trim($this->input->post('UserId'));
		if($userId > 0){
			$this->load->model('Mstores');
			$listStores = $this->Mstores->getByUserId($userId);
			echo json_encode(array('code' => 1, 'data' => $listStores));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
}