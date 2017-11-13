<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {

    public function index(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Danh sách Nhà Cung cấp',
                array('scriptFooter' => array('js' => 'js/supplier.js'))
            );
            if($this->Mactions->checkAccess($data['listActions'], 'supplier')) {
                $this->loadModel(array('Msuppliercontacts', 'Msuppliers'));
                $data['listSupplierContacts'] = $this->Msuppliercontacts->get();
                $postData = $this->arrayFromPost(array('SupplierCode', 'SupplierName', 'SupplierTypeId', 'ItemStatusId', 'HasBill', 'ContactName', 'ContactPhone'));
                $data['listSuppliers'] = $this->Msuppliers->search($postData, PHP_INT_MAX, 1);
                $this->load->view('supplier/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Thêm Nhà Cung cấp',
                array('scriptFooter' => array('js' => 'js/supplier_update.js'))
            );
            if($this->Mactions->checkAccess($data['listActions'], 'supplier')) {
                $this->load->model('Mstores');
                $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $this->load->view('supplier/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function edit($supplierId = 0){
        if($supplierId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật Nhà Cung cấp',
                    array('scriptFooter' => array('js' => 'js/supplier_update.js'))
                );
                $this->loadModel(array('Msuppliercontacts', 'Msuppliers'));
                $supplier = $this->Msuppliers->get($supplierId);
                if ($supplier) {
                    if($this->Mactions->checkAccess($data['listActions'], 'supplier')) {
                        $data['supplierId'] = $supplierId;
                        $data['supplier'] = $supplier;
                        $data['listSupplierContacts'] = $this->Msuppliercontacts->getBy(array('SupplierId' => $supplierId));
                        $this->load->view('supplier/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['supplierId'] = 0;
                    $data['txtError'] = "Không tìm thấy Nhà Cung cấp";
                    $this->load->view('supplier/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('supplier');
    }

    public function update(){
        $user = $this->session->userdata('user');
        if($user){
            $postData = $this->arrayFromPost(array('SupplierCode', 'SupplierName', 'SupplierTypeId', 'ItemStatusId', 'TaxCode', 'HasBill', 'Comment'));
            $contacts = json_decode(trim($this->input->post('Contacts')), true);
            $supplierId = $this->input->post('SupplierId');
            if($supplierId == 0){
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = getCurentDateTime();
            }
            $this->load->model('Msuppliers');
            $supplierId = $this->Msuppliers->update($postData, $supplierId, $contacts);
            if ($supplierId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật nhà Cung cấp thành công", 'data' => $supplierId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeStatus(){
        $supplierId = $this->input->post('SupplierId');
        $itemStatusId = $this->input->post('ItemStatusId');
        if($supplierId > 0 && $itemStatusId >= 0 && $itemStatusId <= count($this->Mconstants->itemStatus)) {
            $this->load->model('Msuppliers');
            $flag = $this->Msuppliers->changeStatus($itemStatusId, $supplierId, 'ItemStatusId');
            if($flag) {
                $txtSuccess = "";
                $statusName = "";
                if($itemStatusId == 0) $txtSuccess = "Xóa nhà Cung cấp thành công";
                else{
                    $txtSuccess = "Đổi trạng thái thành công";
                    $statusName = '<span class="' . $this->Mconstants->labelCss[$itemStatusId] . '">' . $this->Mconstants->itemStatus[$itemStatusId] . '</span>';
                }
                echo json_encode(array('code' => 1, 'message' => $txtSuccess, 'data' => array('ItemStatusName' => $statusName)));
            }
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}
