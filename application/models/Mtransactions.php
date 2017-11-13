<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransactions extends MY_Model{

    function __construct(){
        parent::__construct();
        $this->_table_name = "transactions";
        $this->_primary_key = "TransactionId";
    }

    public function getList($filters=[],$limit=20,$page=1){
        $query=null;
        if(is_array($filters) && count($filters) > 0){

        }else {
            $query=$this->db->select([
                'transactions.*',
                'orders.OrderCode',
                'stores.StoreName',
                'moneysources.MoneySourceName',
                'customers.FullName',
                'customers.Email',
                'moneyphones.MoneyPhoneName',
            ])
                ->join('orders','orders.OrderId = transactions.OrderId','inner')
                ->join('stores','transactions.StoreId=stores.StoreId','left')
                ->join('moneysources','moneysources.MoneySourceId = transactions.MoneySourceId','left')
                ->join('customers','customers.CustomerId = transactions.CustomerId','inner')
                ->join('moneyphones','moneyphones.MoneyPhoneId = transactions.MoneyPhoneId','left')
                ->order_by('CrDateTime','DESC')
                ->get('transactions',$limit*($page-1),$limit);

        }
        return $query->result_array();

    }

    public function update($postData, $transactionId = 0, $tagNames = array(), $actionLogs = array()){
        $this->load->model('Mtags');
        $itemTypeId = 10;
        $isUpdate = $transactionId > 0 ? true : false;
        $this->db->trans_begin();
        $transactionId = $this->save($postData, $transactionId, array('AccountantUserId', 'AccountantDateTime', 'AdminUserId', 'AdminDateTime'));
        if ($transactionId > 0) {
            if (!empty($actionLogs)) {
                $actionLogs['ItemId'] = $transactionId;
                $this->load->model('Mactionlogs');
                $this->Mactionlogs->save($actionLogs);
            }
            if ($isUpdate)   $this->db->delete('itemtags', array('ItemId' => $transactionId, 'ItemTypeId' => $itemTypeId));
            if (!empty($tagNames)) {
                $itemTags = array();
                foreach ($tagNames as $tagName) {
                    $tagId = $this->Mtags->getTagId($tagName, $itemTypeId);
                    if ($tagId > 0) {
                        $itemTags[] = array(
                            'ItemId' => $transactionId,
                            'ItemTypeId' => $itemTypeId,
                            'TagId' => $tagId
                        );
                    }
                }
                if (!empty($itemTags)) $this->db->insert_batch('itemtags', $itemTags);
            }
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return 0;
        }
        else {
            $this->db->trans_commit();
            return $transactionId;
        }
    }


    public function deleteBatch($transactionIds, $user){
        $crDateTime = getCurentDateTime();
        $this->db->trans_begin();
        $this->db->query('UPDATE transactions SET TransactionStatusId = 0 WHERE TransactionId IN('.implode(',', $transactionIds).')');
        $actionLogs = array();
        foreach($transactionIds as $transactionId){
            $actionLogs[] = array(
                'ItemId' => $transactionId,
                'ItemTypeId' => 10,
                'ActionTypeId' => 3,
                'Comment' => $user['FullName'].' xóa phiếu',
                'CrUserId' => $user['UserId'],
                'CrDateTime' => $crDateTime
            );
        }
        if(!empty($actionLogs)) $this->db->insert_batch('actionlogs', $actionLogs);
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return false;
        }
        else{
            $this->db->trans_commit();
            return true;
        }

    }


}
