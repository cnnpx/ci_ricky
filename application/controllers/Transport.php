<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport extends MY_Controller{

    public function index(){
        $user = $this->session->userdata('user');
        if($user){
            $data = $this->commonData($user,
                'Vận chuyển',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/transport.js'))
                )
            );
            if($this->Mactions->checkAccess($data['listActions'], 'transport')) {
                $this->loadModel(array('Mfilters', 'Mcustomers', 'Mtransporters', 'Mtransports', 'Morders'));
                $data['listFilters'] = $this->Mfilters->getList(3);
                $data['listCustomers'] = $this->Mcustomers->getBy(array('StatusId' => STATUS_ACTIVED));
                $data['listTransporters'] = $this->Mtransporters->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listTransports'] = $this->Mtransports->getBy(array('TransportStatusId >' => 0));
                $this->load->view('transport/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function dashboard(){

    }

    public function edit($transportId = 0){
        if($transportId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Cập nhật Vận chuyển',
                    array(
                        'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                        'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/transport_update.js'))
                    )
                );
                $this->loadModel(array('Mtransports', 'Morders', 'Mtransporttypes', 'Mtransporters', 'Mstores', 'Mcustomeraddress', 'Mprovinces', 'Mdistricts', 'Mactionlogs', 'Mtags', 'Motherservices', 'Morderservices', 'Morderproducts', 'Mproducts', 'Mproductchilds'));
                $transport = $this->Mtransports->get($transportId);
                if ($transport) {
                    $listActions = $data['listActions'];
                    if ($this->Mactions->checkAccess($listActions, 'transport/edit')) {
                        $data['title'] .= ' ' . $transport['TransportCode'];
                        $data['canEdit'] = $transport['TransportStatusId'] == 1 || $transport['TransportStatusId'] == 9;
                        $data['transportId'] = $transportId;
                        $data['transport'] = $transport;
                        $data['order'] = $this->Morders->get($transport['OrderId']);
                        $data['customerAddress'] = $this->Mcustomeraddress->get($transport['CustomerAddressId']);
                        $data['listProvinces'] = $this->Mprovinces->getList();
                        $data['tagNames'] = $this->Mtags->getTagNames($transportId, 9);
                        $data['listOrderProducts'] = $this->Morderproducts->getBy(array('OrderId' => $transport['OrderId']));
                        $data['listTransportTypes'] = $this->Mtransporttypes->getBy(array('StatusId' => STATUS_ACTIVED));
                        $data['listTransporters'] = $this->Mtransporters->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                        $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                        $data['listOtherServices'] = $this->Motherservices->getBy(array('StatusId' => STATUS_ACTIVED));
                        $data['listOrderServices'] = $this->Morderservices->getBy(array('OrderId' => $transport['OrderId']));
                        $data['listActionLogs'] = $this->Mactionlogs->getList($transportId, 9);
                        $this->load->view('transport/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else {
                    $data['canEdit'] = false;
                    $data['transportId'] = 0;
                    $data['txtError'] = "Không tìm thấý Vận chuyển";
                    $this->load->view('transport/edit', $data);
                }
            }
            else redirect('user');
        }
        else redirect('order');
    }
}