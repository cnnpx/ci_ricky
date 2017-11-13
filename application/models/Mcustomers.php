<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcustomers extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "customers";
        $this->_primary_key = "CustomerId";
    }

    public function getCount($postData){
        $query = "StatusId > 0" . $this->buildQuery($postData);
        return $this->countRows($query);
    }

    public function search($postData, $perPage = 0, $page = 1){
        $query = "SELECT * FROM customers WHERE StatusId > 0" . $this->buildQuery($postData);
        if($perPage > 0) {
            $from = ($page-1) * $perPage;
            $query .= " LIMIT {$from}, {$perPage}";
        }
        return $this->getByQuery($query);
    }

    private function buildQuery($postData){
        $query = '';
        if(isset($postData['SearchText']) && !empty($postData['SearchText'])) $query.=" AND (FullName LIKE '%{$postData['SearchText']}%' OR PhoneNumber LIKE '%{$postData['SearchText']}%' OR Email LIKE '%{$postData['SearchText']}%')";
        return $query;
    }

    public function update($postData, $customerId = 0, $tagNames = array(), $actionLogs = array()){
        $this->load->model('Mtags');
        $itemTypeId = 5;
        $isUpdate = $customerId > 0 ? true : false;
        $this->db->trans_begin();
        $customerId = $this->save($postData, $customerId);
        if($customerId > 0){
            if(!empty($actionLogs)){
                $actionLogs['ItemId'] = $customerId;
                $this->load->model('Mactionlogs');
                $this->Mactionlogs->save($actionLogs);
            }
            if($isUpdate) $this->db->delete('itemtags', array('ItemId' => $customerId, 'ItemTypeId' => $itemTypeId));
            if(!empty($tagNames)){
                $itemTags = array();
                foreach($tagNames as $tagName){
                    $tagId = $this->Mtags->getTagId($tagName, $itemTypeId);
                    if($tagId > 0){
                        $itemTags[] = array(
                            'ItemId' => $customerId,
                            'ItemTypeId' => $itemTypeId,
                            'TagId' => $tagId
                        );
                    }
                }
                if(!empty($itemTags)) $this->db->insert_batch('itemtags', $itemTags);
            }
        }
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $customerId;
        }
    }

    public function deleteBatch($customerIds, $user){
        $crDateTime = getCurentDateTime();
        $this->db->trans_begin();
        $this->db->query('UPDATE customers SET StatusId = 0 WHERE CustomerId IN('.implode(',', $customerIds).')');
        $actionLogs = array();
        foreach($customerIds as $customerId){
            $actionLogs[] = array(
                'ItemId' => $customerId,
                'ItemTypeId' => 5,
                'ActionTypeId' => 3,
                'Comment' => $user['FullName'].' xóa khách hàng',
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
