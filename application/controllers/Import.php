<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends MY_Controller{

    public function index() {
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Nhập kho',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/import.js'))
                )
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($data['listActions'], 'import')) {
                $this->loadModel(array('Mimports', 'Mfilters', 'Mstores', 'Msuppliers'));
                $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listSuppliers'] = $this->Msuppliers->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listFilters'] = $this->Mfilters->getList(3);
                $data['listImports'] = $this->Mimports->getBy(array('StatusId >' => 0));
                $this->load->view('import/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if ($user) {
            $data = $this->commonData($user,
                'Tạo Phiếu nhập kho',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/import_update.js'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'order/add')) {
                $this->loadModel(array('Mstores', 'Msuppliers', 'Mcategories'));
                $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listSuppliers'] = $this->Msuppliers->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                $this->load->view('import/add', $data);
            } else $this->load->view('user/permission', $data);
        } else redirect('user');
    }

    public function edit($importId = 0){
        if($importId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật Phiếu nhập kho',
                    array(
                        'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                        'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/import_update.js'))
                    )
                );
                $this->loadModel(array('Mimports', 'Mstores', 'Mtags', 'Mproductchilds', 'Mproducts', 'Mimportproducts', 'Msuppliers', 'Mcategories', 'Mactionlogs'));
                $import = $this->Mimports->get($importId);
                if ($import) {
                    $listActions = $data['listActions'];
                    if ($this->Mactions->checkAccess($listActions, 'import/edit')) {
                        $data['title'] .= ' ' . $import['ImportCode'];
                        $data['canCancle'] = $import['StatusId'] == 2 ? false : true;
                        $data['importId'] = $importId;
                        $data['import'] = $import;
                        $data['listSuppliers'] = $this->Msuppliers->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                        $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                        $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                        $data['tagNames'] = $this->Mtags->getTagNames($importId, 8);
                        $data['listActionLogs'] = $this->Mactionlogs->getList($importId, 8);
                        $data['listImportProduct'] = $this->Mimportproducts->getBy(array('ImportId' => $importId));
                        $this->load->view('import/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['canCancle'] = false;
                    $data['orderId'] = 0;
                    $data['txtError'] = "Không tìm thấý phiếu nhập kho";
                    $this->load->view('import/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('import');
    }

    public function update(){
        $user = $this->session->userdata('user');
        if ($user) {
            $postData = $this->arrayFromPost(array('ImportCode', 'StatusId', 'SupplierId', 'DeliverName', 'DeliverPhone', 'StoreId', 'Comment', 'FileExcel', 'ScanBarCodeId'));
            $importId = $this->input->post('ImportId');
            $crDateTime = getCurentDateTime();
            $actionLogs = array(
                'ItemTypeId' => 8,
                'CrUserId' => $user['UserId'],
                'CrDateTime' => $crDateTime
            );
            if($importId > 0){
                $postData['UpdateUserId'] = $user['UserId'];
                $postData['UpdateDateTime'] = $crDateTime;
                $actionLogs['ActionTypeId'] = 2;
                $actionLogs['Comment'] = $user['FullName'] . ': Cập nhật phiếu nhập kho';
            }
            else{
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = $crDateTime;
                $actionLogs['ActionTypeId'] = 1;
                $actionLogs['Comment'] = $user['FullName'] . ': Thêm phiếu nhập kho';
            }
            $products = json_decode(trim($this->input->post('Products')), true);
            $tagNames = json_decode(trim($this->input->post('TagNames')), true);
            $this->load->model('Mimports');
            $importId = $this->Mimports->update($postData, $importId, $products, $tagNames, $actionLogs);
            if($importId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật phiếu nhập kho thành công", 'data' => $importId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeStatusBatch(){
        $user = $this->session->userdata('user');
        if($user){
            $importIds = json_decode(trim($this->input->post('ItemIds')), true);
            $statusId = $this->input->post('StatusId');
            if(!empty($importIds) && $statusId >= 0){
                $this->load->model('Mimports');
                $flag = $this->Mimports->changeStatusBatch($importIds, $statusId, $user);
                if($flag) {
                    $msg = 'Xóa nhập kho thành công';
                    $statusName = '';
                    if ($statusId > 0) {
                        $msg = 'Thay đổi trạng thái thành công';
                        $statusName = '<span class="' . $this->Mconstants->labelCss[$statusId] . '">' . $this->Mconstants->status[$statusId] . '</span>';
                    }
                    echo json_encode(array('code' => 1, 'message' => $msg, 'data' => $statusName));
                }
                else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}