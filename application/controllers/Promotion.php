<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends MY_Controller{

    public function index(){

        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Khuyến mại',
                array('scriptFooter' => array('js' => 'js/promotion_list.js'))
            );
            if($this->Mactions->checkAccess($data['listActions'], 'promotion')) {
                $this->loadModel(array('Mfilters', 'Mprovinces', 'Mcustomergroups', 'Mcategories', 'Mpromotions', 'Mcustomers', 'Mproducts'));
                $data['listFilters'] = $this->Mfilters->getList(11);
                $data['listProvinces'] = $this->Mprovinces->getList();
                $data['listCustomerGroups'] = $this->Mcustomergroups->getList();
                $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                $data['listPromotions'] = $this->Mpromotions->getBy(array('PromotionStatusId >' => 0));
                $this->load->view('promotion/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Tạo Khuyến mại',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/datepicker/datepicker3.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'js/choose_item.js', 'js/promotion_update.js'))
                )
            );
            if($this->Mactions->checkAccess($data['listActions'], 'promotion/add')) {
                $this->loadModel(array('Mprovinces', 'Mcustomergroups', 'Mcategories'));
                $data['listProvinces'] = $this->Mprovinces->getList();
                $data['listCustomerGroups'] = $this->Mcustomergroups->getList();
                $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                $this->load->view('promotion/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    /*public function edit($promotionId = 0){
        if($promotionId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật Khuyến mại',
                    array(
                        'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                        'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/promotion_update.js'))
                    )
                );
                $this->loadModel(array('Mpromotions', 'Mpromotiontypes', 'Mpromotionreasons', 'Motherservices', 'Mpromotionservices', 'Mstores', 'Mprovinces', 'Mdistricts', 'Mcategories', 'Mcustomeraddress', 'Mtags', 'Mpromotionproducts', 'Mproducts', 'Mproductchilds', 'Mtransporters', 'Mtransporttypes', 'Mtransports', 'Mactionlogs'));
                $promotion = $this->Mpromotions->get($promotionId);
                if ($promotion) {
                    $listActions = $data['listActions'];
                    if ($this->Mactions->checkAccess($listActions, 'promotion/edit')) {
                        $data['title'] .= ' ' . $promotion['PromotionCode'];
                        $data['canEdit'] = ($promotion['PromotionStatusId'] == 2 || $promotion['VerifyStatusId'] == 2 || $promotion['PaymentStatusId'] == 2) ? false : true; //bao dat hang hoac QL duyet
                        $data['promotionId'] = $promotionId;
                        $data['promotion'] = $promotion;
                        $data['customerAddress'] = $this->Mcustomeraddress->get($promotion['CustomerAddressId']);
                        $whereStatus = array('StatusId' => STATUS_ACTIVED);
                        $data['listPromotionTypes'] = $this->Mpromotiontypes->getBy($whereStatus);
                        $data['listPromotionReasons'] = $this->Mpromotionreasons->getBy($whereStatus);
                        $data['listOtherServices'] = $this->Motherservices->getBy($whereStatus);
                        $data['listTransportTypes'] = $this->Mtransporttypes->getBy($whereStatus);
                        $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                        $data['listTransporters'] = $this->Mtransporters->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                        $data['listProvinces'] = $this->Mprovinces->getList();
                        $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                        $data['tagNames'] = $this->Mtags->getTagNames($promotionId, 6);
                        $data['listPromotionProducts'] = $this->Mpromotionproducts->getBy(array('PromotionId' => $promotionId));
                        $data['listPromotionServices'] = $this->Mpromotionservices->getBy(array('PromotionId' => $promotionId));
                        $data['transportId'] = $this->Mtransports->getFieldValue(array('PromotionId' => $promotionId, 'TransportStatusId >' => 0), 'TransportId', 0);
                        $data['listActionLogs'] = $this->Mactionlogs->getList($promotionId, 6);
                        $this->load->view('promotion/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['canEdit'] = false;
                    $data['promotionId'] = 0;
                    $data['txtError'] = "Không tìm thấý Khuyến mại";
                    $this->load->view('promotion/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('promotion');
    }*/

    public function update(){
        $user = $this->session->userdata('user');
        if($user){
            $postData = $this->arrayFromPost(array('PromotionName', 'PromotionTypeId', 'PromotionStatusId', 'ReduceTypeId', 'BeginDate', 'EndDate', 'IsSharePromotion', 'NumberUse', 'ReduceNumber', 'MinimumCost', 'ProvinceId', 'PromotionItemId', 'PromotionItemTypeId', 'ProductNumber', 'DiscountTypeId'));
            if(!empty($postData['BeginDate'])) $postData['BeginDate'] = ddMMyyyyToDate($postData['BeginDate']);
            if(!empty($postData['EndDate'])) $postData['EndDate'] = ddMMyyyyToDate($postData['EndDate']);
            $promotionId = $this->input->post('PromotionId');
            if($promotionId > 0){
                $postData['UpdateUserId'] = $user['UserId'];
                $postData['UpdateDateTime'] = getCurentDateTime();
            }
            else{
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = getCurentDateTime();
            }
            $this->load->model('Mpromotions');
            $promotionId = $this->Mpromotions->save($postData, $promotionId, array('EndDate'));
            if($promotionId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật Khuyến mại thành công", 'data' => $promotionId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));

        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
    
    public function changeStatusBatch(){
        $user = $this->session->userdata('user');
        if($user){
            $promotionIds = json_decode(trim($this->input->post('ItemIds')), true);
            $statusId = $this->input->post('StatusId');
            if(!empty($promotionIds) && $statusId >= 0){
                $this->load->model('Mpromotions');
                $flag = $this->Mpromotions->changeStatusBatch($promotionIds, $statusId);
                if($flag) {
                    $msg = 'Xóa mã khuyến mại thành công';
                    if ($statusId > 0) $msg = 'Thay đổi trạng thái thành công';
                    echo json_encode(array('code' => 1, 'message' => $msg));
                }
                else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}