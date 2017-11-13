<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends MY_Controller {

    public function index(){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Danh sách Sản phẩm',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
					'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/product_list.js'))
                )
            );
            if($this->Mactions->checkAccess($data['listActions'], 'product')) {
                $this->loadModel(array('Mproducts', 'Mproductchilds', 'Mproducttypes', 'Msuppliers', 'Mfilters'));
                $data['listProductTypes'] = $this->Mproducttypes->getList();
                $data['listSuppliers'] = $this->Msuppliers->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listFilters'] = $this->Mfilters->getList(3);
                $data['listProduct'] = $this->Mproducts->getBy(array('ProductStatusId >' => 0, 'ProductKindId !=' => 3));
                $this->load->view('product/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Thêm Sản phẩm',
                array(
                    'scriptHeader' => array('css' => array('vendor/plugins/datepicker/datepicker3.css', 'vendor/plugins/timepicker/bootstrap-timepicker.min.css', 'vendor/plugins/tagsinput/jquery.tagsinput.min.css')),
                    'scriptFooter' => array('js' => array('ckeditor/ckeditor.js', 'ckfinder/ckfinder.js', 'vendor/plugins/datepicker/bootstrap-datepicker.js', 'vendor/plugins/timepicker/bootstrap-timepicker.min.js', 'vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/product_update.js?201710081')))
            );
            if($this->Mactions->checkAccess($data['listActions'], 'product/add')) {
                $this->loadModel(array('Mproducttypes', 'Mcategories', 'Msuppliers', 'Mtags', 'Mvariants'));
                $data['listProductTypes'] = $this->Mproducttypes->getBy(array('StatusId' => STATUS_ACTIVED));
                $data['listSuppliers'] = $this->Msuppliers->search(array('ItemStatusId' => STATUS_ACTIVED), PHP_INT_MAX, 1);
                $data['listCategories'] = $this->Mcategories->getListByItemType(array(1, 2));
                $data['listTags'] = $this->Mtags->getBy(array('ItemTypeId' => 3));
                $data['listVariants'] = $this->Mvariants->get();
                $this->load->view('product/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function edit($productId){
        if($productId > 0){
            $user = $this->session->userdata('user');
            if($user) {
                $data = $this->commonData($user,
                    'Sửa Sản phẩm',
                    array(
                        'scriptHeader' => array('css' => array('vendor/plugins/datepicker/datepicker3.css', 'vendor/plugins/timepicker/bootstrap-timepicker.min.css', 'vendor/plugins/tagsinput/jquery.tagsinput.min.css')),
                        'scriptFooter' => array('js' => array('ckeditor/ckeditor.js', 'ckfinder/ckfinder.js', 'vendor/plugins/datepicker/bootstrap-datepicker.js', 'vendor/plugins/timepicker/bootstrap-timepicker.min.js', 'vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/product_update.js?201710081')))
                );
                if($this->Mactions->checkAccess($data['listActions'], 'product/edit')) {
                    $this->loadModel(array('Mproducts', 'Mproducttypes', 'Mcategories', 'Msuppliers', 'Mtags', 'Mcategoryitems', 'Mitemmetadatas', 'Mfiles', 'Mvariants', 'Mproductchilds', 'Mactionlogs'));
                    $product = $this->Mproducts->get($productId);
                    if($product && $product['ProductKindId'] != 3) {
                        $data['productId'] = $productId;
                        //$product['ProductDesc'] = str_replace('/hmd/', IMAGE_PATH, $product['ProductDesc']);
                        $data['product'] = $product;
                        $data['listProductTypes'] = $this->Mproducttypes->getBy(array('StatusId' => STATUS_ACTIVED));
                        $data['listSuppliers'] = $this->Msuppliers->search(array('ItemStatusId' => STATUS_ACTIVED), PHP_INT_MAX, 1);
                        $data['listCategories'] = $this->Mcategories->getListByItemType(array(1, 2));
                        $data['listTags'] = $this->Mtags->getBy(array('ItemTypeId' => 3));
                        $data['cateIds'] = $this->Mcategoryitems->getCateIds($productId, 3);
                        $data['tagNames'] = $this->Mtags->getTagNames($productId, 3);
                        $data['listImages'] = $this->Mfiles->getFileUrls($productId, 3, 1);
                        $data['itemSEO'] = $this->Mitemmetadatas->getBy(array('ItemId' => $productId, 'ItemTypeId' => 3), true);
                        $data['listActionLogs'] = $this->Mactionlogs->getList($productId, 3);
                        $data['listVariants'] = $this->Mvariants->get();
                        $data['variants'] = array();
                        $data['listProductChilds'] = array();
                        if($product['ProductKindId'] == 2) {
                            $listProductChilds = $this->Mproductchilds->getBy(array('ProductId' => $productId));
                            $variants = array();
                            foreach($listProductChilds as $pc){
                                if($pc['VariantId1'] > 0) $variants[$pc['VariantId1']][] = $pc['VariantValue1'];
                                if($pc['VariantId2'] > 0) $variants[$pc['VariantId2']][] = $pc['VariantValue2'];
                                if($pc['VariantId3'] > 0) $variants[$pc['VariantId3']][] = $pc['VariantValue3'];
                            }
                            $data['variants'] = $variants;
                            $data['listProductChilds'] = $listProductChilds;
                        }
                    }
                    else{
                        $data['productId'] = 0;
                        $data['txtError'] = "Không tìm thấy sản phẩm";
                    }
                    $this->load->view('product/edit', $data);
                }
                else $this->load->view('user/permission', $data);
            }
            else redirect('user');
        }
        else redirect('product');
    }

    public function combo(){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Danh sách Combo Sản phẩm',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/product_list.js'))
                )
            );
            if($this->Mactions->checkAccess($data['listActions'], 'product')) {
                $this->loadModel(array('Mproducts', 'Mproductchilds', 'Mproducttypes', 'Msuppliers', 'Mfilters'));
                $data['listProductTypes'] = $this->Mproducttypes->getList();
                $data['listSuppliers'] = $this->Msuppliers->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listFilters'] = $this->Mfilters->getList(16);
                $data['listProduct'] = $this->Mproducts->getBy(array('ProductStatusId >' => 0, 'ProductKindId =' => 3));
                $this->load->view('product/list_combo', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function addCombo(){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Thêm Combo Sản phẩm',
                array(
                    'scriptHeader' => array('css' => array('vendor/plugins/datepicker/datepicker3.css', 'vendor/plugins/timepicker/bootstrap-timepicker.min.css', 'vendor/plugins/tagsinput/jquery.tagsinput.min.css')),
                    'scriptFooter' => array('js' => array('ckeditor/ckeditor.js', 'ckfinder/ckfinder.js', 'vendor/plugins/datepicker/bootstrap-datepicker.js', 'vendor/plugins/timepicker/bootstrap-timepicker.min.js', 'vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/product_update.js?201710081')))
            );
            if($this->Mactions->checkAccess($data['listActions'], 'product/add')) {
                $this->loadModel(array('Mproducttypes', 'Mcategories', 'Msuppliers', 'Mtags', 'Mvariants'));
                $data['listProductTypes'] = $this->Mproducttypes->getBy(array('StatusId' => STATUS_ACTIVED));
                $data['listSuppliers'] = $this->Msuppliers->search(array('ItemStatusId' => STATUS_ACTIVED), PHP_INT_MAX, 1);
                $data['listCategories'] = $this->Mcategories->getListByItemType(array(1, 2));
                $data['listTags'] = $this->Mtags->getBy(array('ItemTypeId' => 3));
                $data['listVariants'] = $this->Mvariants->get();
                $this->load->view('product/add_combo', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function editCombo($productId){
        if($productId > 0){
            $user = $this->session->userdata('user');
            if($user) {
                $data = $this->commonData($user,
                    'Sửa Combo',
                    array(
                        'scriptHeader' => array('css' => array('vendor/plugins/datepicker/datepicker3.css', 'vendor/plugins/timepicker/bootstrap-timepicker.min.css', 'vendor/plugins/tagsinput/jquery.tagsinput.min.css')),
                        'scriptFooter' => array('js' => array('ckeditor/ckeditor.js', 'ckfinder/ckfinder.js', 'vendor/plugins/datepicker/bootstrap-datepicker.js', 'vendor/plugins/timepicker/bootstrap-timepicker.min.js', 'vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/product_update.js?201710081')))
                );
                if($this->Mactions->checkAccess($data['listActions'], 'product/edit')) {
                    $this->loadModel(array('Mproducts', 'Mproducttypes', 'Mcategories', 'Msuppliers', 'Mtags', 'Mcategoryitems', 'Mitemmetadatas', 'Mfiles', 'Mproductchilds', 'Mactionlogs'));
                    $product = $this->Mproducts->get($productId);
                    if($product && $product['ProductKindId'] == 3) {
                        $data['productId'] = $productId;
                        //$product['ProductDesc'] = str_replace('/hmd/', IMAGE_PATH, $product['ProductDesc']);
                        $data['product'] = $product;
                        $data['listProductTypes'] = $this->Mproducttypes->getBy(array('StatusId' => STATUS_ACTIVED));
                        $data['listSuppliers'] = $this->Msuppliers->search(array('ItemStatusId' => STATUS_ACTIVED), PHP_INT_MAX, 1);
                        $data['listCategories'] = $this->Mcategories->getListByItemType(array(1, 2));
                        $data['listTags'] = $this->Mtags->getBy(array('ItemTypeId' => 3));
                        $data['cateIds'] = $this->Mcategoryitems->getCateIds($productId, 3);
                        $data['tagNames'] = $this->Mtags->getTagNames($productId, 3);
                        $data['listImages'] = $this->Mfiles->getFileUrls($productId, 3, 1);
                        $data['itemSEO'] = $this->Mitemmetadatas->getBy(array('ItemId' => $productId, 'ItemTypeId' => 3), true);
                        $data['listActionLogs'] = $this->Mactionlogs->getList($productId, 3);
                        $data['listProductChilds'] = $this->Mproductchilds->getBy(array('ProductId' => $productId));
                    }
                    else{
                        $data['productId'] = 0;
                        $data['txtError'] = "Không tìm thấy combo sản phẩm";
                    }
                    $this->load->view('product/edit_combo', $data);
                }
                else $this->load->view('user/permission', $data);
            }
            else redirect('user');
        }
        else redirect('product');
    }

    public function inventory(){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Quản lý tồn kho',
                array('scriptFooter' => array('js' => 'js/product_inventory.js'))
            );
            if($this->Mactions->checkAccess($data['listActions'], 'product/inventory')) {
                $this->loadModel(array('Mproducts', 'Mproductchilds', /*'Mproducttypes', 'Msuppliers',*/ 'Mfilters', 'Mstores'));
                //$data['listProductTypes'] = $this->Mproducttypes->getList();
                //$data['listSuppliers'] = $this->Msuppliers->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listStores'] = $this->Mstores->getByUserId($user['UserId']);
                $data['listFilters'] = $this->Mfilters->getList(15);
                $data['listProduct'] = $this->Mproducts->getBy(array('ProductStatusId >' => 0));
                $this->load->view('product/inventory', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function activeInventory(){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Duyệt tồn kho',
                array('scriptFooter' => array('js' => 'js/product_inventory.js'))
            );
            if($this->Mactions->checkAccess($data['listActions'], 'product/inventory')) {
                $this->loadModel(array('Mproducts', 'Mproductchilds', 'Mstores', 'Minventories'));
                $data['listStores'] = $this->Mstores->getByUserId($user['UserId']);
                $data['listInventoríes'] = $this->Minventories->getBy(array('StatusId' => 1));
                $this->load->view('product/active_inventory', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }
}