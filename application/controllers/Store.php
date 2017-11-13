<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends  MY_Controller {

    public function index()
    {
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Danh sách Cơ sở',
                array('scriptFooter' => array('js' => 'js/store.js'))
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'store/list')) {
                $data['deleteStore'] = $this->Mactions->checkAccess($listActions, 'store/delete');
                $data['changeStatus'] = $this->Mactions->checkAccess($listActions, 'store/edit');
                $this->loadModel(array('Mprovinces', 'Mdistricts', 'Mstores'));
                $data['listProvinces'] = $this->Mprovinces->getList();
                $data['listUsers'] = $this->Musers->getlist();
                $data['listStore'] = $this->Mstores->getBy(array('ItemStatusId >' => 0));
                $this->load->view('store/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Thêm Cơ sở',
                array('scriptFooter' => array('js' => 'js/store.js'))
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'store/add')) {
                $this->loadModel(array('Mprovinces', 'Mdistricts'));
                $data['listProvinces'] = $this->Mprovinces->getList();
                $data['listUsers'] = $this->Musers->getlist();
                $this->load->view('store/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function edit($storeId = 0){
        if($storeId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật Cơ sở',
                    array('scriptFooter' => array('js' => 'js/store.js'))
                );
                $this->load->model('Mstores');
                $store = $this->Mstores->get($storeId);
                if ($store) {
                    $listActions = $data['listActions'];
                    if ($this->Mactions->checkAccess($listActions, 'store/edit')) {
                        $data['storeId'] = $storeId;
                        $data['store'] = $store;
                        $this->loadModel(array('Mprovinces', 'Mdistricts', 'Mstoreusers'));
                        $data['listProvinces'] = $this->Mprovinces->getList();
                        $data['listUsers'] = $this->Musers->getlist();
                        $data['listUserIds'] = $this->Mstoreusers->getUserIds($storeId);
                        $this->load->view('store/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['storeId'] = 0;
                    $data['txtError'] = "Không tìm thấy cơ sở";
                    $this->load->view('store/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('store');
    }

    public function saveStore(){
        $user = $this->session->userdata('user');
        if ($user) {
            $postData = $this->arrayFromPost(array('StoreName', 'StoreCode', 'ItemStatusId', 'StoreTypeId', 'ProvinceId', 'DistrictId', 'Address', 'HeadUserId', 'Comment'));
            $storeId = $this->input->post('StoreId');
            if($storeId == 0){
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = getCurentDateTime();
            }
            $userIds = json_decode(trim($this->input->post('UserIds')), true);
            $this->load->model('Mstores');
            $storeId = $this->Mstores->update($postData, $storeId, $userIds);
            if($storeId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật cơ sở thành công", 'data' => $storeId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeStatus(){
        $storeId = $this->input->post('StoreId');
        $storeStatusId = $this->input->post('StoreStatusId');
        if ($storeId > 0 && $storeStatusId >= 0 && $storeStatusId <= count($this->Mconstants->storeStatus)) {
            $this->load->model('Mstores');
            $flag = $this->Mstores->changeStatus($storeStatusId, $storeId, 'StoreStatusId');
            if ($flag) {
                $txtSuccess = "";
                $statusName = "";
                if ($storeStatusId == 0) $txtSuccess = "Xóa {$this->input->post('StoreName')} thành công";
                else {
                    $txtSuccess = "Đổi trạng thái thành công";
                    $statusName = '<span class="' . $this->Mconstants->labelCss[$storeStatusId] . '">' . $this->Mconstants->storeStatus[$storeStatusId] . '</span>';
                }
                echo json_encode(array('code' => 1, 'message' => $txtSuccess, 'data' => array('StatusName' => $statusName)));
            }
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}