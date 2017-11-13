<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	public function update(){
        $user = $this->session->userdata('user');
        if($user){
			$postData = $this->arrayFromPost(array('FullName', 'PhoneNumber', 'Email', 'GenderId', 'PhoneNumber', 'StatusId', 'BirthDay', 'CustomerTypeId', 'ProvinceId', 'DistrictId', 'Address', 'CustomerGroupId', 'Commnet', 'CareStaffId', 'DiscountTypeId', 'PaymentTimeId', 'PositionName', 'CompanyName', 'TaxCode'));
        	$postData['BirthDay'] = ddMMyyyyToDate($postData['BirthDay']);
            $customerId = $this->input->post('CustomerId');
			$crDateTime = getCurentDateTime();
			$actionLogs = array(
				'ItemTypeId' => 5,
				'CrUserId' => $user['UserId'],
				'CrDateTime' => $crDateTime
			);
			if($customerId > 0){
				$postData['UpdateUserId'] = $user['UserId'];
				$postData['UpdateDateTime'] = $crDateTime;
				$actionLogs['ActionTypeId'] = 2;
				$actionLogs['Comment'] = $user['FullName'] . ': Cập nhật khách hàng';
			}
			else{
				$postData['CrUserId'] = $user['UserId'];
				$postData['CrDateTime'] = $crDateTime;
				$actionLogs['ActionTypeId'] = 1;
				$actionLogs['Comment'] = $user['FullName'] . ': Thêm mới khách hàng hàng';
			}
            $this->load->model('Mcustomers');
			$tagNames = json_decode(trim($this->input->post('TagNames')), true);
            $customerId = $this->Mcustomers->update($postData, $customerId, $tagNames, $actionLogs);
            if ($customerId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật Khách hàng thành công", 'data' => $customerId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

	public function deleteBatch(){
		$user = $this->session->userdata('user');
		if($user){
			$customerIds = json_decode(trim($this->input->post('ItemIds')), true);
			if(!empty($customerIds)){
				$this->load->model('Mcustomers');
				$flag = $this->Mcustomers->deleteBatch($customerIds, $user);
				if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa Khách hàng thành công"));
				else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
			}
			else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}

	public function getList(){
		$pageId = trim($this->input->post('PageId'));
		$limit = trim($this->input->post('Limit'));
		if($pageId > 0 && $limit > 0){
			$searchText = trim($this->input->post('SearchText'));
			$this->load->model('Mcustomers');
			$listCustomers = $this->Mcustomers->search(array('SearchText' => $searchText), $limit, $pageId);
			echo json_encode(array('code' => 1, 'data' => $listCustomers));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}

	public function get(){
		$customerId = $this->input->post('CustomerId');
		if($customerId > 0){
			$this->loadModel(array('Mcustomers', 'Mcustomergroups'));
			$customer = $this->Mcustomers->get($customerId);
			if($customer){
				//$customer['CustomerLink'] = base_url('customer/edit/'.$customerId);
				//$customer['CustomerGroupName'] = $this->Mcustomergroups->getFieldValue(array('CustomerGroupId' => $customer['CustomerGroupId']), 'CustomerGroupName');
				echo json_encode(array('code' => 1, 'data' => $customer));
			}
			else echo json_encode(array('code' => -1, 'message' => "Không tìm thấy Khách hàng"));
		}
		else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
	}
}