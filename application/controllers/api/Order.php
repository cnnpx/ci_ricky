<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller{

    public function getInfo(){
        header('Content-Type: application/json');
        $barCode = trim($this->input->post('BarCode'));
        if (!empty($barCode)) {
            $this->loadModel(array('Morders', 'Mcustomers', 'Mproducts', 'Mtransports', 'Mtransporttypes'));
            $order = $this->Morders->getBy(array('OrderCode' => $barCode), true);
            if ($order) {
                $data = array(
                    'Customer' => $this->Mcustomers->get($order['CustomerId'], true, '', 'FullName, PhoneNumber'),
                    'Products' => $this->Mproducts->getInfoByOrder($order['OrderId']),
                    'BarCode' => $barCode,
                    'message' => 'Lấy thông tin đơn hàng thành công',
                    'OrderStatusId' => array($order['OrderStatusId'] => $this->Mconstants->orderStatus[$order['OrderStatusId']]),
                    'CrDateTime' => ddMMyyyy($order['CrDateTime']),
                    'TransportTypeId' => array('id' => 0, 'name' => ''),
                );
                $transport = $this->Mtransports->getBy(array('OrderId' => $order['OrderId']), true);
                if ($transport) $data['TransportTypeId'] = array('id' => $transport['TransportTypeId'], 'name' => $this->Mtransporttypes->getFieldValue(array('TransportTypeId' => $transport['TransportTypeId']), 'TransportTypeName'));
                echo json_encode(array('code' => 1, 'data' => $data));
            }
            else echo json_encode(array('code' => 0, 'message' => "Đơn hàng không tồn tại"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Mã vạch không được bỏ trống"));
    }

    /*
     * type = 1: check tung don
     * type = 2: gop don
     */
    public function packing(){ //dong goi hang
        header('Content-Type: application/json');
        //log_message('error', json_encode($_POST));
        $barCode = trim($this->input->post('BarCode'));
        $type = trim($this->input->post('Type'));
        $userId = trim($this->input->post('UserId'));//ng thuc hien
        if (!empty($barCode) && $type > 0 && $type < 3 && $userId > 0) {
            $desc = trim($this->input->post('Desc'));
            $fromApp = trim($this->input->post('FromApp'));
            $imageName = '';
            $image = trim($this->input->post('Image'));
            if (!empty($image)) {
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $image = base64_decode($image);
                $imageName = IMAGE_PATH . date('YmdHis') . '.png';
                file_put_contents($imageName, $image);
            }
            echo json_encode(array('code' => 1, 'message' => "Đóng gói hàng thành công", 'data' => array('message' => "Đóng gói hàng thành công")));
        } else echo json_encode(array('code' => -1, 'message' => "Mã vạch không được bỏ trống"));
    }

    public function mergeProduct(){ //check gop sp
        header('Content-Type: application/json');
        $barCodes = trim($this->input->post('BarCodes'));
        $type = trim($this->input->post('Type'));
        if (!empty($barCodes) && $type > 0 && $type < 3) {
            $barCodes = explode(';', $barCodes);
            if (!empty($barCodes)) echo json_encode(array('code' => 1, 'message' => "Gộp sản phẩm thành công", 'data' => array('message' => "Gộp sản phẩm thành công")));
            else echo json_encode(array('code' => -1, 'message' => "Mã vạch không được bỏ trống"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Mã vạch không được bỏ trống"));
    }

    public function changeStatus(){
        header('Content-Type: application/json');
        $barCode = trim($this->input->post('BarCode'));
        $orderStatusId = trim($this->input->post('OrderStatusId'));
        $userId = trim($this->input->post('UserId'));
        $transportTypeId = trim($this->input->post('TransportTypeId'));
        if (!empty($barCode) && $orderStatusId > 0 && $userId > 0 && $transportTypeId > 0) {
            $this->load->model('Morders');
            $order = $this->Morders->getBy(array('BarCode' => $barCode), true);
            if ($order) {
                $flag = $this->Morders->changeStatus($orderStatusId, $order['OrderId'], 'OrderStatusId');
                if ($flag) echo json_encode(array('code' => 1, 'message' => "Cập nhật trạng thái đơn hàng thành công", 'data' => array('message' => "Cập nhật trạng thái đơn hàng thành công")));
                else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => 0, 'message' => "Đơn hàng không tồn tại"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Mã vạch không được bỏ trống"));
    }

    public function changeStatusBatch(){
        header('Content-Type: application/json');
        $barCodes = explode(';', trim($this->input->post('BarCodes')));
        $orderStatusId = trim($this->input->post('OrderStatusId'));
        $userId = trim($this->input->post('UserId'));
        $transportTypeId = trim($this->input->post('TransportTypeId'));
        if (!empty($barCodes) && $orderStatusId > 0 && $userId > 0 && $transportTypeId > 0) {
            $this->load->model('Mtransporttypes');
            $transportTypeName = $this->Mtransporttypes->getFieldValue(array('TransportTypeId' => $transportTypeId), 'TransportTypeName');
            if (!empty($transportTypeName)) {
                $success = array();
                $error = array();
                $i = 0;
                foreach ($barCodes as $barCode) {
                    $i++;
                    if ($i % 2 == 0) {
                        $success[] = array(
                            'BarCode' => $barCode,
                            'TransportTypeName' => $transportTypeName
                        );
                    } else {
                        $error[] = array(
                            'BarCode' => $barCode,
                            'TransportTypeName' => $transportTypeName
                        );
                    }
                }
                echo json_encode(array('code' => 1, 'message' => "Cập nhật trạng thái đơn hàng thành công", 'data' => array('message' => "Cập nhật trạng thái đơn hàng thành công", 'success' => $success, 'error' => $error)));
            }
            else echo json_encode(array('code' => -1, 'message' => "Không tồn tại loại Vận chuyển"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Mã vạch không được bỏ trống"));
    }

    public function update(){
        $user = $this->session->userdata('user');
        if ($user) {
            $postData = $this->arrayFromPost(array('CustomerId', 'StaffId', 'OrderChanelId', 'OrderStatusId', 'Comment', 'TransportCost', 'IsLendBack', 'LendBackCost', 'Discount', 'PreCost', 'VATPercent', 'PaymentStatusId', 'VerifyStatusId', 'OrderTypeId', 'DeliveryTypeId', 'OrderReasonId', 'CODCost', 'CODStatusId'));
            $orderId = $this->input->post('OrderId');
            $crDateTime = getCurentDateTime();
            $actionLogs = array(
                'ItemTypeId' => 6,
                'CrUserId' => $user['UserId'],
                'CrDateTime' => $crDateTime
            );
            if ($orderId > 0) {
                $postData['UpdateUserId'] = $user['UserId'];
                $postData['UpdateDateTime'] = $crDateTime;
                $actionLogs['ActionTypeId'] = 2;
                $actionLogs['Comment'] = $user['FullName'] . ': Cập nhật đơn hàng';
            }
            else {
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = $crDateTime;
                $actionLogs['ActionTypeId'] = 1;
                $actionLogs['Comment'] = $user['FullName'] . ': Thêm mới đơn hàng';
            }
            $customerAddress = $this->arrayFromPost(array('CustomerId', 'CustomerName', 'Email', 'PhoneNumber', 'Address', 'ProvinceId', 'DistrictId'));
            $customerAddress['CrUserId'] = $user['UserId'];
            $customerAddress['CrDateTime'] = $crDateTime;
            $products = json_decode(trim($this->input->post('Products')), true);
            $tagNames = json_decode(trim($this->input->post('TagNames')), true);
            $services = json_decode(trim($this->input->post('OrderServices')), true);
            $this->load->model('Morders');
            $orderId = $this->Morders->update($postData, $orderId, $customerAddress, $products, $tagNames, $services, $actionLogs);
            if ($orderId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật đơn hàng thành công", 'data' => $orderId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeStatusBatchWeb(){
        $user = $this->session->userdata('user');
        if ($user) {
            $orderIds = json_decode(trim($this->input->post('ItemIds')), true);
            $statusId = $this->input->post('StatusId');
            if (!empty($orderIds) && $statusId >= 0) {
                $this->load->model('Morders');
                $flag = $this->Morders->changeStatusBatchWeb($orderIds, $statusId, $user);
                if ($flag) {
                    $msg = 'Xóa đơn hàng thành công';
                    $statusName = '';
                    if ($statusId > 0) {
                        $msg = 'Thay đổi trạng thái thành công';
                        $statusName = '<span class="' . $this->Mconstants->labelCss[$statusId] . '">' . $this->Mconstants->orderStatus[$statusId] . '</span>';
                    }
                    echo json_encode(array('code' => 1, 'message' => $msg, 'data' => $statusName));
                }
                else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function changeVerifyStatusBatch(){
        $user = $this->session->userdata('user');
        if ($user) {
            $orderIds = json_decode(trim($this->input->post('OrderIds')), true);
            $verifyStatusId = $this->input->post('VerifyStatusId');
            if (!empty($orderIds) && $verifyStatusId >= 0) {
                $this->load->model('Morders');
                $flag = $this->Morders->changeVerifyStatusBatch($orderIds, $verifyStatusId, $user);
                if ($flag) echo json_encode(array('code' => 1, 'message' => 'Đổi trạng thái xác thực thành công', 'data' => $verifyStatusId));
                else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function getList01(){ //o trang transaction
        $user = $this->session->userdata('user');
        if ($user) {
            $customerId = $this->input->post('CustomerId');
            if($customerId > 0) {
                $this->load->model('Morders');
                $data = $this->Morders->getByQuery('SELECT OrderId, OrderCode FROM orders WHERE OrderStatusId > 0 AND CustomerId = ? AND OrderId NOT IN(SELECT OrderId FROM transactions WHERE CustomerId = ? AND TransactionStatusId = 3)', array($customerId, $customerId));
                echo json_encode(array('code' => 1, 'message' => "Lấy danh sách đơn hàng thành công", 'data' => $data));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}