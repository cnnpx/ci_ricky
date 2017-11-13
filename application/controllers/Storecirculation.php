<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storecirculation extends  MY_Controller {

    public function index()
    {
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Danh sách Lưu chuyển kho',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
					'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/store_circulation.js'))
                )
            );
            if($this->Mactions->checkAccess($data['listActions'], 'storecirculation')) {
                $this->loadModel(array('Mstorecirculations', 'Mstores'));
                $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId >' => 0));
                $data['listStoreCirculations'] = $this->Mstorecirculations->getBy(array('OrderStatusId >' => 0));
                $data['listFilters'] = array();
                $this->load->view('storecirculation/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Tạo đơn Lưu chuyển kho',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/store_circulation.js'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'storecirculation/add')) {
                $this->loadModel(array('Mcategories', 'Mstores'));
                $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                $this->load->view('storecirculation/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function edit($storeCirculationId = 0){
        if($storeCirculationId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật Lưu chuyển kho',
                    array(
                        'scriptHeader' => array('css' => array('vendor/plugins/datepicker/datepicker3.css', 'vendor/plugins/tagsinput/jquery.tagsinput.min.css')),
                        'scriptFooter' => array('js' => array( 'vendor/plugins/datepicker/bootstrap-datepicker.js', 'vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/store_circulation.js'))
                    )
                );
                $this->loadModel(array('Mcategories', 'Mstores', 'Mstorecirculations', 'Mtags', 'Mstorecirculationproducts', 'Mproducts', 'Mproductchilds', 'Mactionlogs'));
                $storeCirculation = $this->Mstorecirculations->get($storeCirculationId);
                if ($storeCirculation) {
                    $listActions = $data['listActions'];
                    if ($this->Mactions->checkAccess($listActions, 'storecirculation/edit')) {
                        $data['title'] .= ' ' . $storeCirculation['StoreCirculationCode'];
                        $data['canEdit'] = (/*$storeCirculation['OrderStatusId'] == 2 || */$storeCirculation['StatusId'] == 2) ? false : true;
                        $data['storeCirculationId'] = $storeCirculationId;
                        $data['storeCirculation'] = $storeCirculation;
                        $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId >' => 0));
                        $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                        $data['tagNames'] = $this->Mtags->getTagNames($storeCirculationId, 7);
                        $data['listStoreCirculationProducts'] = $this->Mstorecirculationproducts->getBy(array('StoreCirculationId' => $storeCirculationId));
                        $data['listActionLogs'] = $this->Mactionlogs->getList($storeCirculationId, 7);
                        $this->load->view('storecirculation/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['canEdit'] = false;
                    $data['storeCirculationId'] = 0;
                    $data['txtError'] = "Không tìm thấý Lưu chuyển kho";
                    $this->load->view('storecirculation/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('storecirculation');
    }
}