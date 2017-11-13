<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mconstants extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*public $roles = array(
        1 => 'Nhân Viên CSKH',
        2 => 'Nhân Viên Vận chuyển',
        3 => 'Quản lý chung'
    );*/

    //USER
    public $workTypes = array(
        1 => 'PART TIME',
        2 => 'FULL TIME'
    );
    //CUSTOMER
    public $customerTypes = array(
        1 => 'Cá nhân',
        2 => 'Công ty'
    );

    public $discountType = array(
        1 => '5%',
        2 => '8%',
        3 => '10%',
        4 => '15%',
        5 => '20%',
        6 => '30%',
    );

    public $paymentTime = array(
        1 => '1 tháng',
        2 => '2 tháng'
    );

    //STORE
    public $storeTypes = array(
        1 => 'Kho',
        2 => 'Cửa hàng',
        3 => 'Kho + Cửa hàng'
    );

    //SUPPLIER
    public $supplierTypes = array(
        1 => 'Công ty',
        2 => 'Cá nhân',
    );

    //product
    public $productStatus = array(
        2 => 'Đang Kinh doanh',
        1 => 'Tạm dừng Kinh doanh'
    );

    /*public $productLevels = array(
        2 => 'Sản phẩm chính',
        1 => 'Sản phẩm phụ'
    );

    public $productKinds = array(
        1 => 'Sản phẩm đơn',
        2 => 'Sản phẩm nhiều phiên bản',
        3 => 'Combo'
    );*/

    public $productDisplayTypes = array(
        1 => 'Hiển thị trêm web',
        2 => 'Ẩn nhưng search mới ra',
        3 => 'Ẩn hoàn toàn'
    );

    public $fileTypes = array(
        1 => 'Ảnh',
        2 => 'PDF'
    );

    public $scanTypes = array(
        1 => 'Nhập kho',
        2 => 'Kiểm kho',
        3 => 'Xuất Lưu chuyển kho',
        4 => 'Nhập Lưu chuyển kho',
        5 => 'Hoàn đơn hàng'
    );

    //ORDER
    public $orderStatus = array(
        1 => 'Đã hủy',
        3 => 'Chưa báo giao hàng',
        2 => 'Đã báo giao hàng'
    );

    public $orderChannels = array(
        1 => 'WEB',
        2 => 'FB',
        3 => 'Tự tạo',
        4 => 'POS', //Trực tiếp
        5 => 'Phone'
    );

    public $verifyStatus = array(
        1 => 'Chưa xác minh',
        2 => 'Đã xác minh'
    );

    public $deliveryTypes = array(
        1 => 'POS',
        2 => 'Từ xa'
    );

    public $paymentStatus = array(
        1 => 'Chưa thanh toán',
        2 => 'Đã thanh toán',
        //3 => 'Đã xác minh'
    );

    public $CODStatus = array(
        1 => 'Không có COD',
        2 => 'Chưa về',
        3 => 'Đã nhận',
        4 => 'Đã đối soát'
    );

    //TRANSACTION
    public $transactionTypes = array(
        1 => 'Phiếu thu',
        2 => 'Phiếu chi',
        3 => 'Ghi nợ'
    );

    public $transactionStatus = array(
        1 => 'Chưa duyệt',
        2 => 'Kế toán đã duyệt',
        3 => 'Quản lý đã duyệt',
    );

    //TRANSPORT
    public $transportStatus = array(
        9 => 'Chờ xử lý',
        1 => 'Chờ đóng hàng',
        2 => 'Đã đóng hàng',
        3 => 'Đang giao hàng',
        4 => 'Hẹn giao lại',
        5 => 'Giao thành công',
        6 => 'Đang hoàn về',
        7 => 'Đã nhận hoàn', //that bai
        8 => 'Hủy bỏ đơn hàng'
    );

    //Khuyen mai
    public $promotionTypes = array(
        1 => 'Mã khuyến mãi (Coupon)',
        2 => 'Chương trình khuyến mãi'
    );

    public $promotionStatus = array(
        1 => 'Đang khuyến mãi',
        2 => 'Đã kích hoạt',
        3 => 'Chưa kích hoạt',
        4 => 'Ngừng khuyến mãi'
    );

    public $reduceTypes = array(
        1 => 'Giá trị xác định',
        2 => 'Theo phần trăm',
        3 => 'Miễn phí vận chuyển'
    );

    public $discountTypes = array(
        1 => 'Một lần trên một đơn hàng',
        2 => 'Cho từng mặt hàng trong giỏ hàng'
    );

    //hoan hang ve
    public $returnGoodTypes = array(
        1 => 'Hoàn đơn bưu điện',
        2 => 'Hoàn đơn ngoại thành'
    );

    //
    public $itemStatus = array(
        2 => 'Đang hoạt động',
        1 => 'Tạm dừng',
        3 => 'Dừng hoạt động'
    );

    public $status = array(
        2 => 'Đã duyệt',
        1 => 'Chưa duyệt',
        3 => 'Không được duyệt',
        4 => 'Xem xét thêm'
    );

    public $itemTypes = array(
        1 => 'Nhóm Sản phẩm', //chuyen muc sp
        2 => 'Loại hàng hóa', //loai sp
        3 => 'Sản phẩm',
        4 => 'Bài viết',
        5 => 'Khách hàng',
        6 => 'Đơn hàng',
        7 => 'Lưu chuyển kho',
        8 => 'Nhập kho',
        9 => 'Vận chuyển',
        10 => 'Tài chính',
        11 => 'Nhóm Khách hàng',
        12 => 'Khuyến mại',
        13 => 'Sản phẩm con',
        14 => 'Hoàn hàng về',
        15 => 'Tồn kho',
        16 => "Combo Sản phẩm"
    );

    public  $nameFuctionRenderTableContent=[
        10 => 'renderContentTransactions'
    ];

    public $genders = array(
        1 => 'Nam',
        2 => 'Nữ'
    );

    public $labelCss = array(
        1 => 'label label-default',
        2 => 'label label-success',
        3 => 'label label-warning',
        4 => 'label label-danger',
        5 => 'label label-default',
        6 => 'label label-success',
        7 => 'label label-warning',
        8 => 'label label-danger',
        9 => 'label label-default',
        10 => 'label label-success',
        11 => 'label label-warning',
        12 => 'label label-danger'

    );

    public $isShare = array(
        1 => 'Không',
        2 => 'Có'
    );

    /*public $InventoryTypes = array(
        1 => 'Cộng thêm/ trừ đi',
        2 => 'Set'
    );*/

    public function selectConstants($key, $selectName, $itemId = 0, $isAll = false, $txtAll = 'Tất cả'){
        $obj = $this->$key;
        if($obj) {
            echo '<select class="form-control" name="'.$selectName.'" id="'.lcfirst($selectName).'">';
            if($isAll) echo '<option value="0">'.$txtAll.'</option>';
            foreach($obj as $i => $v){
                if($itemId == $i) $selected = ' selected="selected"';
                else $selected = '';
                echo '<option value="'.$i.'"'.$selected.'>'.$v.'</option>';
            }
            echo "</select>";
        }
    }

    public function selectObject($listObj, $objKey, $objValue, $selectName, $objId = 0, $isAll = false, $txtAll = "", $selectClass = '', $attrSelect = ''){
        $id = str_replace('[]', '', lcfirst($selectName));
        echo '<select class="form-control'.$selectClass.'" name="'.$selectName.'" id="'.$id.'"'.$attrSelect.'>';
        if($isAll){
            if(empty($txtAll)) echo '<option value="0">Tất cả</option>';
            else echo '<option value="0">'.$txtAll.'</option>';
        }
        $isSelectMutiple = is_array($objId);
        foreach($listObj as $obj){
            $selected = '';
            if(!$isSelectMutiple) {
                if ($obj[$objKey] == $objId) $selected = ' selected="selected"';
            }
            elseif(in_array($obj[$objKey], $objId)) $selected = ' selected="selected"';
            echo '<option value="'.$obj[$objKey].'"'.$selected.'>'.$obj[$objValue].'</option>';
        }
        echo '</select>';
    }

    public function selectNumber($start, $end, $selectName, $itemId = 0, $asc = false, $attrSelect = ''){
        echo '<select class="form-control" name="'.$selectName.'" id="'.lcfirst($selectName).'"'.$attrSelect.'>';
        if($asc){
            for($i = $start; $i <= $end; $i++){
                if($i == $itemId) $selected = ' selected="selected"';
                else $selected = '';
                echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
            }
        }
        else{
            for($i = $end; $i >= $start; $i--){
                if($i == $itemId) $selected = ' selected="selected"';
                else $selected = '';
                echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
            }
        }
        echo '</select>';
    }

    public function getObjectValue($listObj, $objKey, $objValue, $objKeyReturn){
        foreach($listObj as $obj){
            if($obj[$objKey] == $objValue) return $obj[$objKeyReturn];
        }
        return '';
    }
}