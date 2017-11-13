<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transporter extends MY_Controller {

	public function index(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Danh sách Nhà Vận chuyển',
				array('scriptFooter' => array('js' => 'js/transporter.js'))
			);
			if($this->Mactions->checkAccess($data['listActions'], 'transporter')) {
				$this->loadModel(array('Mstores', 'Mtransportercontacts', 'Mtransporterstores', 'Mtransporters'));
				$data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
				$data['listTransporterContacts'] = $this->Mtransportercontacts->get();
				$data['listTransporterStores'] = $this->Mtransporterstores->get();
				$data['listTransporters'] = $this->Mtransporters->getBy(array('ItemStatusId' => STATUS_ACTIVED));
				$this->load->view('transporter/list', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function add(){
		$user = $this->session->userdata('user');
		if($user){
			$data = $this->commonData($user,
				'Thêm Nhà Vận chuyển',
				array('scriptFooter' => array('js' => 'js/transporter_update.js'))
			);
			if($this->Mactions->checkAccess($data['listActions'], 'transporter')) {
				$this->load->model('Mstores');
				$data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
				$this->load->view('transporter/add', $data);
			}
			else $this->load->view('user/permission', $data);
		}
		else redirect('user');
	}

	public function edit($transporterId = 0){
		if($transporterId > 0) {
			$user = $this->session->userdata('user');
			if ($user) {
				$data = $this->commonData($user,
					'Cập nhật Nhà Vận chuyển',
					array('scriptFooter' => array('js' => 'js/transporter_update.js'))
				);
				$this->loadModel(array('Mstores', 'Mtransportercontacts', 'Mtransporterstores', 'Mtransporters'));
				$transporter = $this->Mtransporters->get($transporterId);
				if ($transporter) {
					if($this->Mactions->checkAccess($data['listActions'], 'transporter')) {
						$data['transporterId'] = $transporterId;
						$data['transporter'] = $transporter;
						$data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
						$data['listTransporterContacts'] = $this->Mtransportercontacts->getBy(array('TransporterId' => $transporterId));
						$listTransporterStores = $this->Mtransporterstores->getBy(array('TransporterId' => $transporterId));
						$storeIds = array();
						foreach($listTransporterStores as $ts) $storeIds[] = $ts['StoreId'];
						$data['storeIds'] = $storeIds;
						$this->load->view('transporter/edit', $data);
					}
					else $this->load->view('user/permission', $data);
				}
				else {
					$data['transporterId'] = 0;
					$data['txtError'] = "Không tìm thấy Nhà Vận chuyển";
					$this->load->view('transporter/edit', $data);
				}
			}
			else redirect('user');
		}
		else redirect('transporter');
	}

	public function update(){
		$user = $this->session->userdata('user');
		if($user){
			$storeIds = json_decode(trim($this->input->post('StoreIds')), true);
			if(!empty($storeIds)) {
				$postData = $this->arrayFromPost(array('TransporterCode', 'TransporterName', 'HasCOD', 'ItemStatusId', 'Comment'));
				$contacts = json_decode(trim($this->input->post('Contacts')), true);
				$transporterId = $this->input->post('TransporterId');
				if($transporterId == 0){
					$postData['CrUserId'] = $user['UserId'];
					$postData['CrDateTime'] = getCurentDateTime();
				}
				$this->load->model('Mtransporters');
				$transporterId = $this->Mtransporters->update($postData, $transporterId, $storeIds, $contacts);
				if ($transporterId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật Nhà vận chuyển thành công", 'data' => $transporterId));
				else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
			}
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}

	public function deleteBatch(){
		$user = $this->session->userdata('user');
		if($user){
			$transporterIds = json_decode(trim($this->input->post('ItemIds')), true);
			if(!empty($transporterIds)){
				$this->load->model('Mtransporters');
				$this->Mtransporters->deleteBatch($transporterIds);
				echo json_encode(array('code' => 1, 'message' => "Xóa Nhà vận chuyển thành công"));
			}
			else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
}
