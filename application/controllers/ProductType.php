<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producttype extends MY_Controller {

    public function index(){
        $user = $this->session->userdata('user');
        if($user) {
            $data = $this->commonData($user,
                'Danh sách Mảng kinh doanh',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js', 'js/productType_update.js'))
                )
            );
            $listActions = $data['listActions'];
            if($this->Mactions->checkAccess($listActions, 'productType')) {
                $data['updateProductType'] = $this->Mactions->checkAccess($listActions, 'productType/update');
                $data['deleteProductType'] = $this->Mactions->checkAccess($listActions, 'productType/delete');
                $this->load->model('Mproducttypes');
                $data['listProductType'] = $this->Mproducttypes->getBy(array('StatusId' => STATUS_ACTIVED));
                $this->load->view('productType/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Thêm Mảng kinh doanh',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js', 'js/productType_update.js'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'productType/add')) {
                $this->load->view('productType/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function update(){
        $user = $this->session->userdata('user');
        $postData = $this->arrayFromPost(array('ProductTypeName','StatusId', 'IsShare', 'ActiveDate', 'CrDateTime'));
        $productTypeId = $this->input->post('ProductTypeId');
        if (!empty($postData['ProductTypeName'])) {
            $this->load->model('Mproducttypes');
            if ($this->Mproducttypes->checkExist($productTypeId, $postData['ProductTypeName'])) {
                echo json_encode(array('code' => -1, 'message' => "Tên mảng kinh doanh đã tồn tại trong hệ thống"));
            } else {
                $postData['ActiveDate'] = ddMMyyyyToDate($postData['ActiveDate']);
                $postData['CrUserId'] = ($user) ? $user['UserId'] : 0;
                $postData['CrDateTime'] = getCurentDateTime();
                $postData['StatusId'] = 2;
                $productTypeId = $this->Mproducttypes->update($postData, $productTypeId);
                if ($productTypeId > 0) {
                    echo json_encode(array('code' => 1, 'message' => "Thêm mảng kinh doanh thành công", 'data' => $productTypeId));
                } else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
        } else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function edit($productTypeId = 0){
        if($productTypeId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật mảng kinh doanh',
                    array(
                        'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
                        'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'ckfinder/ckfinder.js', 'js/productType_update.js'))
                    )
                );
                $this->load->model('Mproducttypes');
                $producttype = $this->Mproducttypes->get($productTypeId);
                if ($producttype) {
                    $listActions = $data['listActions'];
                    if ($this->Mactions->checkAccess($listActions, 'productType/view')) {
                        $data['canEdit'] = $this->Mactions->checkAccess($listActions, 'productType/edit');
                        $data['productTypeId'] = $productTypeId;
                        $data['producttype'] = $producttype;
                        $this->load->view('productType/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['productTypeId'] = 0;
                    $data['txtError'] = "Không tìm thấy mảng kinh doanh";
                    $this->load->view('productType/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('productType');
    }

    public function changeStatus(){
        $productTypeId = $this->input->post('ProductTypeId');
        $statudId = $this->input->post('StatusId');
        if($productTypeId  > 0){
            $this->load->model('Mproducttypes');
            $flag = $this->Mproducttypes->changeStatus($statudId, $productTypeId);
            if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa mảng kinh doanh thành công"));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}