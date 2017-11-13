<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

    public function index($itemTypeId = 0){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Danh sách Chuyên mục',
                array('scriptFooter' => array('js' => 'js/category.js'))
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'category')) {
                if(!in_array($itemTypeId, array(1, 2, 4))) $itemTypeId = 1;
                $itemTypeName = '';
                if($itemTypeId == 1) $itemTypeName = 'nhóm/ chuyên mục sản phẩm';
                elseif($itemTypeId == 2) $itemTypeName = 'loại sản phẩm';
                elseif($itemTypeId == 4) $itemTypeName = 'chuyên mục bài viết';
                $data['itemTypeId'] = $itemTypeId;
                $data['itemTypeName'] = $itemTypeName;
                $data['title'] = 'Danh sách '.$itemTypeName;
                $this->loadModel(array('Mcategories','Mproducttypes'));
                $data['listProductTypes'] = $this->Mproducttypes->getList();
                $data['listCategories'] = $this->Mcategories->getListByItemType($itemTypeId, false, true);
                $this->load->view('category/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add($itemTypeId = 0){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Thêm Chuyên mục',
                array('scriptFooter' => array('js' => array('ckeditor/ckeditor.js', 'js/category_update.js')))
            );
            if($this->Mactions->checkAccess($data['listActions'], 'categorie/add')) {
                if(!in_array($itemTypeId, array(1, 2, 4))) $itemTypeId = 1;
                $itemTypeName = '';
                if($itemTypeId == 1) $itemTypeName = 'nhóm/ chuyên mục sản phẩm';
                elseif($itemTypeId == 2) $itemTypeName = 'loại sản phẩm';
                elseif($itemTypeId == 4) $itemTypeName = 'chuyên mục bài viết';
                $data['itemTypeId'] = $itemTypeId;
                $data['itemTypeName'] = $itemTypeName;
                $data['title'] = 'Thêm '.$itemTypeName;
                $this->loadModel(array('Mcategories','Mproducttypes'));
                $data['listProductTypes'] = $this->Mproducttypes->getList();
                $data['listCategories'] = $this->Mcategories->getBy(array('ItemTypeId' => $itemTypeId, 'StatusId' => STATUS_ACTIVED, 'ParentCategoryId' => 0));
                $this->load->view('category/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function edit($categoryId){
        if($categoryId > 0){
            $user = $this->session->userdata('user');
            if($user) {
                $data = $this->commonData($user,
                    'Sửa Chuyên mục',
                    array('scriptFooter' => array('js' => array('ckeditor/ckeditor.js', 'js/category_update.js')))
                );
                if($this->Mactions->checkAccess($data['listActions'], 'category/edit')) {
                    $this->loadModel(array('Mcategories','Mproducttypes'));
                    $category = $this->Mcategories->get($categoryId);
                    if($category) {
                        $data['categoryId'] = $categoryId;
                        $data['category'] = $category;
                        $itemTypeId = $category['ItemTypeId'];
                        if($itemTypeId == 1) $itemTypeName = 'nhóm/ chuyên mục sản phẩm';
                        elseif($itemTypeId == 2) $itemTypeName = 'loại sản phẩm';
                        elseif($itemTypeId == 4) $itemTypeName = 'chuyên mục bài viết';
                        $data['itemTypeId'] = $itemTypeId;
                        $data['itemTypeName'] = $itemTypeName;
                        $data['title'] = 'Sửa '.$itemTypeName;
                        $data['listProductTypes'] = $this->Mproducttypes->getList();
                        $data['listCategories'] = $this->Mcategories->getBy(array('ItemTypeId' => $itemTypeId, 'StatusId' => STATUS_ACTIVED, 'ParentCategoryId' => 0));
                    }
                    else{
                        $data['categoryId'] = 0;
                        $data['txtError'] = "Không tìm thấy chuyên mục";
                    }
                    $this->load->view('category/edit', $data);
                }
                else $this->load->view('user/permission', $data);
            }
            else redirect('user');
        }
        else redirect('category');
    }

    public function update(){
        $user = $this->session->userdata('user');
        if($user){
            $postData = $this->arrayFromPost(array('CategoryName', 'CategoryDesc', 'CategorySlug', 'ItemTypeId', 'ProductTypeId', 'CategoryTypeId', 'StatusId' , 'ParentCategoryId', 'DisplayOrder'));
            if(empty($postData['CategorySlug'])) $postData['CategorySlug'] = makeSlug($postData['CategoryName']);
            else $postData['CategorySlug'] = makeSlug($postData['CategorySlug']);
            $categoryId = $this->input->post('CategoryId');
            if($categoryId > 0){
                $postData['UpdateUserId'] = $user['UserId'];
                $postData['UpdateDateTime'] = getCurentDateTime();
            }
            else{
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = getCurentDateTime();
            }
            $this->load->model('Mcategories');
            $categoryId = $this->Mcategories->update($postData, $categoryId);
            if ($categoryId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật Chuyên mục thành công", 'data' => $categoryId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeDisplayOrder(){
        $postData = $this->arrayFromPost(array('DisplayOrder', 'ItemTypeId', 'ProductTypeId', 'CategoryTypeId', 'ParentCategoryId'));
        $categoryId = $this->input->post('CategoryId');
        if($categoryId > 0 && $postData['DisplayOrder'] > 0 && $postData['ItemTypeId'] > 0 && $postData['ProductTypeId'] > 0 && $postData['CategoryTypeId'] > 0){
            $this->load->model('Mcategories');
            $flag = $this->Mcategories->update($postData, $categoryId);
            if($flag) echo json_encode(array('code' => 1, 'message' => "Thay đổi thứ tự thành công"));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeStatusBatch(){
        $user = $this->session->userdata('user');
        if($user){
            $categoryIds = json_decode(trim($this->input->post('ItemIds')), true);
            $statusId = $this->input->post('StatusId');
            if(!empty($categoryIds) && $statusId >= 0){
                $this->load->model('Mcategories');
                $flag = $this->Mcategories->changeStatusBatch($categoryIds, $statusId);
                if($flag) {
                    $msg = 'Xóa chuyên mục thành công';
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