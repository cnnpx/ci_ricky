<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller
{

    public function index()
    {
        $user = $this->session->userdata('user');
        if ($user) {
            $this->load->helper(['form', 'url']);
            $data = $this->commonData($user,
                'Khách hàng',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/customer.js'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'customer')) {
                $this->loadModel(array('Mfilters', 'Mcustomers', 'Mprovinces'));
                $data['listProvinces'] = $this->Mprovinces->getList();
                $data['listFilters'] = $this->Mfilters->getList(5);
                $data['itemTypeId'] = 5;
                $data['listCustomers'] = $this->Mcustomers->getBy(array('StatusId' => STATUS_ACTIVED));
                $this->load->view('customer/list', $data);
            } else $this->load->view('user/permission', $data);
        } else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if ($user) {
            $data = $this->commonData($user,
                'Thêm Khách hàng',
                array(
                    'scriptHeader' => array('css' => array('vendor/plugins/datepicker/datepicker3.css', 'vendor/plugins/timepicker/bootstrap-timepicker.min.css', 'vendor/plugins/tagsinput/jquery.tagsinput.min.css')),
                    'scriptFooter' => array('js' => array('ckeditor/ckeditor.js', 'ckfinder/ckfinder.js', 'vendor/plugins/datepicker/bootstrap-datepicker.js', 'vendor/plugins/timepicker/bootstrap-timepicker.min.js', 'vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/customer_update.js'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'customer/add')) {
                $this->loadModel(array('Mcustomergroups', 'Mprovinces', 'Mdistricts', 'Mtags'));
                $data['listCustomersGroups'] = $this->Mcustomergroups->getList();
                $data['listProvinces'] = $this->Mprovinces->getList();
                $data['listUsers'] = $this->Musers->getlist();
                $data['listTags'] = $this->Mtags->getBy(array('ItemTypeId' => 5));
                $this->load->view('customer/add', $data);
            } else $this->load->view('user/permission', $data);
        } else redirect('user');
    }

    public function edit($customerId){
        if ($customerId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Sửa Khách hàng',
                    array(
                        'scriptHeader' => array('css' => array('vendor/plugins/datepicker/datepicker3.css', 'vendor/plugins/timepicker/bootstrap-timepicker.min.css', 'vendor/plugins/tagsinput/jquery.tagsinput.min.css')),
                        'scriptFooter' => array('js' => array('ckeditor/ckeditor.js', 'ckfinder/ckfinder.js', 'vendor/plugins/datepicker/bootstrap-datepicker.js', 'vendor/plugins/timepicker/bootstrap-timepicker.min.js', 'vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/customer_update.js'))
                    )
                );
                $listActions = $data['listActions'];
                if ($this->Mactions->checkAccess($data['listActions'], 'customer/edit')) {
                    $this->loadModel(array('Mcustomers', 'Mcustomergroups', 'Mprovinces', 'Mdistricts', 'Mtags', 'Mactionlogs'));
                    $customer = $this->Mcustomers->get($customerId);
                    if ($customer) {
                        $data['customerId'] = $customerId;
                        $data['customer'] = $customer;
                        $data['listCustomersGroups'] = $this->Mcustomergroups->getList();
                        $data['listProvinces'] = $this->Mprovinces->getList();
                        $data['listUsers'] = $this->Musers->getlist();
                        $data['listTags'] = $this->Mtags->getBy(array('ItemTypeId' => 5));
                        $data['tagNames'] = $this->Mtags->getTagNames($customerId, 5);
                        $data['listActionLogs'] = $this->Mactionlogs->getList($customerId, 5);
                    } else {
                        $data['customerId'] = 0;
                        $data['txtError'] = "Không tìm thấy khách hàng";
                    }
                    $this->load->view('customer/edit', $data);
                } else $this->load->view('user/permission', $data);
            } else redirect('user');
        } else redirect('customer');
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //------------- lấy điều kiện lọc---------------//
            //item
            $itemFilters = $this->input->post('itemFilters');
            //text search
            $searchText=$this->input->post('searchText');
            //page
            $page = !empty($this->input->post('page')) ? $this->input->post('page') : 1;

            // lấy dữ liệ từ bộ lọc gửi lại
            $pageSize = 100;
            $totalRow = 1000;
            $callBackTable = 'renderTable';
            $callBackTagFilter = 'renderTagFilter';

            if (count($itemFilters) > 0) {

            }
            echo json_encode([
                'dataTables' => 'dataTables',
                'page' => $page,
                'pageSize' => $pageSize,
                'totalRow' => $totalRow,
                'callBackTable' => $callBackTable,
                'callBackTagFilter'=>$callBackTagFilter
            ]);
        }
    }

}