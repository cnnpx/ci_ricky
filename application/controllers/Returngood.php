<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returngood extends MY_Controller{

    public function index(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Đơn hoàn hàng về',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/returngood.js'))
                )
            );
            if($this->Mactions->checkAccess($data['listActions'], 'returngood')) {
                $this->loadModel(array('Mfilters', 'Mcustomers', 'Mreturngoods', 'Mstores'));
                $data['listCustomers'] = $this->Mcustomers->getBy(array('StatusId' => STATUS_ACTIVED));
                $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listFilters'] = $this->Mfilters->getList(14);
                $data['listReturnGoods'] = $this->Mreturngoods->getBy(array('TransportStatusId >' => 0));
                $this->load->view('returngood/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if ($user) {
            $data = $this->commonData($user,
                'Tạo Đơn hoàn hàng về',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/returngood_update.js'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'returngood/add')) {
                $this->loadModel(array('Mprovinces', 'Mdistricts', 'Mcategories', 'Mstores'));
                $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listProvinces'] = $this->Mprovinces->getList();
                $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                $this->load->view('returngood/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function edit($returnGoodId = 0){
        if($returnGoodId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật Đơn hoàn hàng về',
                    array(
                        'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                        'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/returngood_update.js'))
                    )
                );
                $this->loadModel(array('Mreturngoods', 'Mreturngoodproducts', 'Mproducts', 'Mproductchilds', 'Mcustomeraddress', 'Mtags', 'Mprovinces', 'Mdistricts', 'Mcategories', 'Mstores', 'Mactionlogs'));
                $returnGood = $this->Mreturngoods->get($returnGoodId);
                if ($returnGood) {
                    $listActions = $data['listActions'];
                    if ($this->Mactions->checkAccess($listActions, 'returngood/edit')) {
                        $data['title'] .= ' ' . $returnGood['ReturnGoodCode'];
                        $data['canEdit'] =true;// $returnGood['ReturngoodStatusId'] == 1 || $returnGood['ReturngoodStatusId'] == 9;
                        $data['returnGoodId'] = $returnGoodId;
                        $data['returnGood'] = $returnGood;
                        $data['customerAddress'] = $this->Mcustomeraddress->get($returnGood['CustomerAddressId']);
                        $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                        $data['listProvinces'] = $this->Mprovinces->getList();
                        $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                        $data['tagNames'] = $this->Mtags->getTagNames($returnGoodId, 14);
                        $data['listReturnGoodProducts'] = $this->Mreturngoodproducts->getBy(array('ReturnGoodId' => $returnGoodId));
                        $data['listActionLogs'] = $this->Mactionlogs->getList($returnGoodId, 14);
                        $this->load->view('returngood/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['canEdit'] = false;
                    $data['returnGoodId'] = 0;
                    $data['txtError'] = "Không tìm thấý Đơn hoàn hàng về";
                    $this->load->view('returngood/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('order');
    }
}