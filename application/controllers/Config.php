<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends MY_Controller {

	public function index(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Cấu hình hệ thống'
			);
			if($this->Mactions->checkAccess($data['listActions'], 'config')) {
				$this->load->model('Mconfigs');
				$data['listConfigs'] = $this->Mconfigs->get();
				if($this->session->flashdata('txtSuccess')) $data['txtSuccess'] = $this->session->flashdata('txtSuccess');
				if($this->session->flashdata('txtError')) $data['txtError'] = $this->session->flashdata('txtError');
				$this->load->view('setting/config', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function update(){
		$user = $this->session->userdata('user');
		if ($user) {
			$listActions = $this->Mactions->getByUserId($user['UserId']);
			if ($this->Mactions->checkAccess($listActions, 'config/update')) {
				$this->load->model('Mconfigs');
				$listConfigs = $this->Mconfigs->get(0, false, "", "ConfigId,ConfigCode,ConfigValue");
				$valueData = array();
				$crDateTime = getCurentDateTime();
				foreach($listConfigs as $c){
					$configValue = trim($this->input->post('config_'.$c['ConfigId']));
					if($c['ConfigValue'] != $configValue){
						$valueData[] = array('ConfigId' => $c['ConfigId'], 'ConfigValue' => $configValue, 'CrUserId' => $user['UserId'], 'CrDateTime' => $crDateTime);
					}
				}
				$flag = $this->Mconfigs->updateBatch($valueData);
				if($flag){
					$this->session->set_userdata('configs', $this->Mconfigs->getListMap());
					$this->session->set_flashdata('txtSuccess',  "Đã cập nhật cấu hình");
				}
				else $this->session->set_flashdata('txtError', "Có lỗi xảy ra trong quá trình thực hiện");
				redirect('config');
			}
			else $this->load->view('user/permission');
		}
		else redirect('user');
	}
}
