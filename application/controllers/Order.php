<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller{

    public function index(){
        $user = $this->session->userdata('user');
        if ($user) {
            $data = $this->commonData($user,
                'Đơn hàng',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/order_list.js'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'order')) {
                $this->loadModel(array('Mfilters', 'Mcustomers', 'Morders'));
                $data['listFilters'] = $this->Mfilters->getList(3);
                $data['listCustomers'] = $this->Mcustomers->getBy(array('StatusId' => STATUS_ACTIVED));
                $data['listOrders'] = $this->Morders->getBy(array('OrderStatusId >' => 0));
                $this->load->view('order/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if ($user) {
            $data = $this->commonData($user,
                'Tạo Đơn hàng',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/order_update.js?20171008'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'order/add')) {
                $data['canEdit'] = true;
                $this->loadModel(array('Mordertypes', 'Motherservices', 'Morderreasons', 'Mprovinces', 'Mdistricts', 'Mcategories'));
                $whereStatus = array('StatusId' => STATUS_ACTIVED);
                $data['listOrderTypes'] = $this->Mordertypes->getBy($whereStatus);
                $data['listOrderReasons'] = $this->Morderreasons->getBy($whereStatus);
                $data['listOtherServices'] = $this->Motherservices->getBy($whereStatus);
                $data['listProvinces'] = $this->Mprovinces->getList();
                $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                $this->load->view('order/add', $data);
            } else $this->load->view('user/permission', $data);
        } else redirect('user');
    }

    public function edit($orderId = 0){
        if ($orderId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật Đơn hàng',
                    array(
                        'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                        'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/order_update.js?20171008'))
                    )
                );
                $this->loadModel(array('Morders', 'Mordertypes', 'Morderreasons', 'Motherservices', 'Morderservices', 'Mstores', 'Mprovinces', 'Mdistricts', 'Mcategories', 'Mcustomeraddress', 'Mtags', 'Morderproducts', 'Mproducts', 'Mproductchilds', 'Mtransporters', 'Mtransporttypes', 'Mtransports', 'Mactionlogs'));
                $order = $this->Morders->get($orderId);
                if ($order) {
                    if ($this->Mactions->checkAccess($data['listActions'], 'order/edit')) {
                        $data['title'] .= ' ' . $order['OrderCode'];
                        $data['canEdit'] = ($order['OrderStatusId'] == 2 || $order['VerifyStatusId'] == 2 || $order['PaymentStatusId'] == 2) ? false : true; //bao dat hang hoac QL duyet
                        $data['orderId'] = $orderId;
                        $data['order'] = $order;
                        if ($order['CustomerAddressId'] > 0) $data['customerAddress'] = $this->Mcustomeraddress->get($order['CustomerAddressId']);
                        else $data['customerAddress'] = false;
                        $whereStatus = array('StatusId' => STATUS_ACTIVED);
                        $data['listOrderTypes'] = $this->Mordertypes->getBy($whereStatus);
                        $data['listOrderReasons'] = $this->Morderreasons->getBy($whereStatus);
                        $data['listOtherServices'] = $this->Motherservices->getBy($whereStatus);
                        $data['listTransportTypes'] = $this->Mtransporttypes->getBy($whereStatus);
                        $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                        $data['listTransporters'] = $this->Mtransporters->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                        $data['listProvinces'] = $this->Mprovinces->getList();
                        $data['listCategories'] = $this->Mcategories->getListByItemType(1);
                        $data['tagNames'] = $this->Mtags->getTagNames($orderId, 6);
                        $data['listOrderProducts'] = $this->Morderproducts->getBy(array('OrderId' => $orderId));
                        $data['listOrderServices'] = $this->Morderservices->getBy(array('OrderId' => $orderId));
                        $data['transportId'] = $this->Mtransports->getFieldValue(array('OrderId' => $orderId, 'TransportStatusId >' => 0), 'TransportId', 0);
                        $data['listActionLogs'] = $this->Mactionlogs->getList($orderId, 6);
                        $this->load->view('order/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['canEdit'] = false;
                    $data['orderId'] = 0;
                    $data['txtError'] = "Không tìm thấý Đơn hàng";
                    $this->load->view('order/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('order');
    }

    public function checkOrder($orderId){
        if (is_numeric($orderId) && $orderId > 0) {
            // lấy đia chỉ đặt hàng và số lượng sản phẩm đặt của đơn hàng của người dùng
            $select_customer_info = "
                select customeraddress.Address,provinces.ProvinceName,districts.DistrictName,count(orderproducts.ProductId) as count_product from customeraddress 
                INNER join orders on orders.CustomerAddressId = customeraddress.CustomerAddressId
                INNER join orderproducts on orderproducts.OrderId = orders.OrderId 
                INNER JOIN provinces on provinces.ProvinceId = customeraddress.ProvinceId 
                INNER JOIN districts on districts.DistrictId = customeraddress.DistrictId 
                where orders.OrderId = $orderId
            ";

            $query_select_customer_info = $this->db->query($select_customer_info);
            $result_select_customer_info = $query_select_customer_info->row_array();

            $select_location_store =
                "
                   select stores.StoreName,provinces.ProvinceName,districts.DistrictName,stores.StoreId from stores
                   INNER JOIN provinces on provinces.ProvinceId = stores.ProvinceId 
                   INNER JOIN districts on districts.DistrictId = stores.DistrictId 
                ";
            $storesData = $this->db->query($select_location_store)->result_array();
            $storesDataCheck = [];

            foreach($storesData as $store){
                $storesDataCheck[$store['StoreId']] = $store;
            }

            // lấy trường hợp perfect nhất
            $select_check_quantity =
              "
                select products.ProductName,products.ProductId,productchilds.ProductChildId,productchilds.ProductName as ProductNameChild,productquantity.Quantity as product_quantity,orderproducts.Quantity as order_quantity,productquantity.StoreId from products
                 LEFT JOIN productchilds on productchilds.ProductId = products.ProductId 
                 INNER join productquantity on productquantity.ProductId = products.ProductId and (productquantity.ProductChildId = productchilds.ProductChildId or (productchilds.ProductChildId = 0 or productchilds.ProductChildId is NULL )) 
                 INNER JOIN orderproducts on orderproducts.ProductId = productquantity.ProductId and orderproducts.ProductChildId = productquantity.ProductChildId where orderproducts.OrderId = $orderId {conds}
              ";

            $select_check_quantity_perfect = str_replace('{conds}','and productquantity.Quantity >= orderproducts.Quantity',$select_check_quantity);
            $query_select_check_quantity_perfect = $this->db->query($select_check_quantity_perfect);
            $result_select_check_quantity_perfect = $query_select_check_quantity_perfect->result_array();


            // sắp lại data theo StoreId để xem cơ sở này có đủ số lượng hay không , tiện thể nhét luôn cái khoảng cách vào cho nó để tính tiếp
            $checkDatas = [];
            $api_distance = "http://maps.googleapis.com/maps/api/distancematrix/json?origins={origins}&destinations={destinations}&language=vn-VN&sensor=false";
            if (count($result_select_check_quantity_perfect) > 0) {
                $checkDatas = $this->mergerStore($result_select_check_quantity_perfect,$result_select_customer_info,$api_distance,$storesDataCheck);
            }
            $dataFiltersPerfect = [];
            foreach ($checkDatas as $keyStore => $checkData) {
                if ($checkData['count_product'] == $result_select_customer_info['count_product']) {
                    $dataFiltersPerfect[] = [
                        'StoreData' => $storesDataCheck[$keyStore],
                        'DataProduct' => $checkData
                    ];
                }
            }

            // sắp xếp lại mảng theo khoảng cách và kiểm tra điều kiện thỏa mãn
            for ($i = 0; $i < count($dataFiltersPerfect); $i++) {
                for ($j = $i + 1; $j < count($dataFiltersPerfect); $j++) {
                    if ($dataFiltersPerfect[$i]['distance'] > $dataFiltersPerfect[$j]['distance']) {
                        $tmp = $dataFiltersPerfect[$i];
                        $dataFiltersPerfect[$i] = $dataFiltersPerfect[$j];
                        $dataFiltersPerfect[$j] = $tmp;
                    }
                }
                //Sắp xếp xong lấy luôn phần tử đầu tiền
                if (count($dataFiltersPerfect) > 0) {
                    echo json_encode($dataFiltersPerfect[0]);
                    return;
                }
            }
            // kết thúc kiểm tra trường hợp perfect nhất


            //Kiểm tra trường hợp bình thường
            $select_check_quantity_nomarl = str_replace('{conds}','',$select_check_quantity);
            $query_select_check_quantity_nomarl = $this->db->query($select_check_quantity_nomarl);
            $result_select_check_quantity_nomarl  = $query_select_check_quantity_nomarl->result_array();

            // sắp lại data theo StoreId , tiện thể nhét luôn cái khoảng cách vào cho nó để tính tiếp
            $dataFilterNomarl = [];
            if (count($result_select_check_quantity_nomarl) > 0) {
                $checkDatas = $this->mergerStore($result_select_check_quantity_nomarl,$result_select_customer_info,$api_distance,$storesDataCheck);
            }

            foreach ($checkDatas as $checkData) {
                $dataFilterNomarl[] = $checkData;
            }
            //sx lại mảng theo số lượng trước , đông thời tạo các nhóm có cùng số lượng với nhau lại để còn sắp xếp theo khoảng cách
            $dataGroupCountProduct = [];
            $quantity_sub = [];
            for ($i = 0; $i < count($dataFilterNomarl); $i++) {
                for ($j = $i + 1; $j < count($dataFilterNomarl); $j++) {
                    if ($dataFilterNomarl[$i]['count_product'] < $dataFilterNomarl[$j]['count_product']) {
                        $tmp = $dataFilterNomarl[$i];
                        $dataFilterNomarl[$i] = $dataFilterNomarl[$j];
                        $dataFilterNomarl[$j] = $tmp;
                    }
                }
                $dataGroupCountProduct[$dataFilterNomarl[$i]['count_product']][] = $dataFilterNomarl[$i];
            }

            //sx lại mảng theo khoảng cách của từng nhóm có cùng số lượng
            $dataFilterNomarl = [];
            foreach ($dataGroupCountProduct as $dataGroup){
                for($i = 0 ;$i < count($dataGroup) ;$i++){
                    for($j = $i+1;$j < count($dataGroup) ;$j++){
                        if ($dataGroup[$i]['distance'] > $dataGroup[$j]['distance']) {
                            $tmp = $dataGroup[$i];
                            $dataGroup[$i] = $dataGroup[$j];
                            $dataGroup[$j] = $tmp;
                        }
                    }
                    $dataFilterNomarl [] = $dataGroup[$i];
                }
            }
            $storeDataFilter = [];
            $keyStore = [];
            foreach ($dataFilterNomarl as $filters){
                foreach ($filters as $key =>  $data){
                    if(is_numeric($key) && is_array($data)) {
                        if (!array_key_exists($data['ProductId'] . $data['ProductChildId'], $quantity_sub)) {
                            $quantity_sub[$data['ProductId'] . $data['ProductChildId']] = intval($data['order_quantity']) - intval($data['product_quantity']);
                        } else {
                            $quantity_sub[$data['ProductId'] . $data['ProductChildId']] = $quantity_sub[$data['ProductId'] . $data['ProductChildId']] - intval($data['product_quantity']);
                        }

                        if (!in_array($data['StoreId'], $keyStore)) {
                            $keyStore[] = $data['StoreId'];
                            $storeDataFilter[] = [
                                'StoreData' => $storesDataCheck[$data['StoreId']],
                                'DataProduct' => $filters
                            ];
                        }
                        if ($this->checkFullProduct($quantity_sub) && count($quantity_sub) == $result_select_customer_info['count_product']) {
                            echo json_encode($storeDataFilter);
                            return;
                        }
                    }
                }
            }
            //kết thúc việc xử lý bình thường

            echo json_encode(['status' => -1]);
            return;
        }
    }

    private function checkFullProduct($data)
    {
        foreach ($data as $value)
            if (intval($value) > 0) return false;
        return true;
    }


    private function mergerStore($dataQuantity,$result_select_customer_info,$api_distance,$storesDataCheck){
        $checkDatas = [];
        foreach ($dataQuantity as $check_quantity) {
            //gộp các bảng ghi có cùng store lại với nhau
            if (array_key_exists($check_quantity['StoreId'], $checkDatas)) {
                    $checkDatas[$check_quantity['StoreId']][] = $check_quantity;
                    $checkDatas[$check_quantity['StoreId']]['count_product'] += 1;
            } else {
                // chuẩn hóa string để search với api của google
                $district_name_origin = trim(str_replace('Quận', '', $storesDataCheck[$check_quantity['StoreId']]['DistrictName']));
                $district_name_origin = trim(str_replace('Huyện', '', $district_name_origin));
                $province_name_origin = trim($storesDataCheck[$check_quantity['StoreId']]['ProvinceName']);
                $origins = $district_name_origin . ", " . $province_name_origin;
                $origins = preg_replace('/\s+/', '+', $origins);

                $address_des = $result_select_customer_info['Address'];
                $district_name_des = trim(str_replace('Quận ', '', $result_select_customer_info['DistrictName']));
                $district_name_des = trim(str_replace('Huyện ', '', $district_name_des));
                $province_name_des = trim($result_select_customer_info['ProvinceName']);
                $destinations = $address_des . ", " . $district_name_des . ', ' . $province_name_des;
                $destinations = preg_replace('/\s+/', '+', $destinations);
                // kết thúc chuẩn hóa

                // thực hiện việc lấy khoảng cách
                $url_distance = str_replace('{origins}', $origins, $api_distance);
                $url_distance = str_replace('{destinations}', $destinations, $url_distance);
                $ch = curl_init($url_distance);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                $data_distance = json_decode(curl_exec($ch));
                $length_distance = $data_distance->rows[0]->elements[0]->distance->value;
                // kết thúc việc lấy khoảng cách
                $checkDatas[$check_quantity['StoreId']]['distance'] = $length_distance;
                $checkDatas[$check_quantity['StoreId']]['count_product'] = 1;
                $checkDatas[$check_quantity['StoreId']][] = $check_quantity;
            }
            // kết thúc việc gộp
        }
        return $checkDatas;
    }


}