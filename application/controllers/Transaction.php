<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MY_Controller{

    public function index(){
        $user = $this->session->userdata('user');
        if ($user) {
            $data = $this->commonData($user,
                'Danh sách phiếu thu chi',
                array(
                    'scriptHeader' => array('css' => array('vendor/plugins/datepicker/datepicker3.css', 'vendor/plugins/tagsinput/jquery.tagsinput.min.css')),
                    'scriptFooter' => array('js' => array('vendor/plugins/datepicker/bootstrap-datepicker.js', 'vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/transaction_list.js'))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'transaction')) {
                $this->loadModel(array('Mfilters', 'Mcustomers', 'Morders', 'Mtransactions', 'Mstores', 'Mmoneysources', 'Mmoneyphones'));
                $page = 1;
                $limit = DEFAULT_LIMIT;
                $totalRow = $this->db->select('count(*) as totalRow')->get('transactions')->row_array()['totalRow'];
                $pageSize = ceil($totalRow / $limit);
                $data['paginate'] = json_encode(['page' => $page, 'pageSize' => $pageSize, 'totalRow' => intval($totalRow)]);

                $data['itemTypeId'] = 10;
                $data['listFilters'] = $this->Mfilters->getList(10);
                $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $data['listMoneySources'] = $this->Mmoneysources->getBy(array('StatusId' => STATUS_ACTIVED));
                $data['listMoneyPhones'] = $this->Mmoneyphones->getBy(array('StatusId' => STATUS_ACTIVED));
                $data['listTransactions'] = $this->Mtransactions->getBy(array('TransactionStatusId >' => 0));
                $data['listUsers'] = $this->Musers->getby(array('StatusId > ' => 0));
                $this->load->view('transaction/list', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function add(){
        $user = $this->session->userdata('user');
        if ($user) {
            $data = $this->commonData($user,
                'Tạo phiếu thu chi',
                array(
                    'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                    'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/transaction_update.js',))
                )
            );
            if ($this->Mactions->checkAccess($data['listActions'], 'transaction/add')) {
                $this->loadModel(array('Mmoneyphones', 'Mmoneysources', 'Mstores'));
                $data['listMoneySources'] = $this->Mmoneysources->getBy(array('StatusId' => STATUS_ACTIVED));
                $data['listMoneyPhones'] = $this->Mmoneyphones->getBy(array('StatusId' => STATUS_ACTIVED));
                $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                $this->load->view('transaction/add', $data);
            }
            else $this->load->view('user/permission', $data);
        }
        else redirect('user');
    }

    public function edit($transactionId = 0){
        if ($transactionId > 0) {
            $user = $this->session->userdata('user');
            if ($user) {
                $data = $this->commonData($user,
                    'Sửa phiếu thu chi',
                    array(
                        'scriptHeader' => array('css' => 'vendor/plugins/tagsinput/jquery.tagsinput.min.css'),
                        'scriptFooter' => array('js' => array('vendor/plugins/tagsinput/jquery.tagsinput.min.js', 'js/choose_item.js', 'js/transaction_update.js',))
                    )
                );
                $this->loadModel(array('Mtransactions', 'Mcustomers', 'Mmoneyphones', 'Mmoneysources', 'Mstores', 'Mtags', 'Mactionlogs'));
                $transaction = $this->Mtransactions->get($transactionId);
                if($transaction) {
                    if ($this->Mactions->checkAccess($data['listActions'], 'transaction/edit')) {
                        $data['title'] = 'Sửa phiếu ' . $this->Mconstants->transactionTypes[$transaction['TransactionTypeId']];
                        $data['canEdit'] = $transaction['TransactionStatusId'] != 3;
                        $data['transactionId'] = $transactionId;
                        $data['transaction'] = $transaction;
                        $data['customerName'] = $this->Mcustomers->getFieldValue(array('CustomerId' => $transaction['CustomerId']), 'FullName');
                        $data['listMoneySources'] = $this->Mmoneysources->getBy(array('StatusId' => STATUS_ACTIVED));
                        $data['listMoneyPhones'] = $this->Mmoneyphones->getBy(array('StatusId' => STATUS_ACTIVED));
                        $data['listStores'] = $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED));
                        $data['tagNames'] = $this->Mtags->getTagNames($transactionId, 10);
                        $data['listActionLogs'] = $this->Mactionlogs->getList($transactionId, 10);
                        $this->load->view('transaction/edit', $data);
                    }
                    else $this->load->view('user/permission', $data);
                }
                else{
                    $data['canEdit'] = false;
                    $data['transactionId'] = 0;
                    $data['txtError'] = "Không tìm thấý phiếu thu chi";
                    $this->load->view('transaction/edit', $data);
                }
            }
        }
        else redirect('transaction');
    }
}