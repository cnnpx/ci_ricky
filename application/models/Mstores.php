<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mstores extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "stores";
        $this->_primary_key = "StoreId";
    }

    public function update($postData, $storeId, $userIds = array()){
        $isUpdate = $storeId > 0 ? true : false;
        $this->db->trans_begin();
        $storeId = $this->save($postData, $storeId);
        if($storeId > 0){
            if($isUpdate) $this->db->delete('storeusers', array('StoreId' => $storeId));
            $storeUsers = array();
            foreach($userIds as $userId) $storeUsers[] = array('StoreId' => $storeId, 'UserId' => $userId);
            if(!empty($storeUsers)) $this->db->insert_batch('storeusers', $storeUsers);
        }
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $storeId;
        }
    }

    public function getByUserId($userId){
        //return $this->getByQuery('SELECT StoreId, StoreName FROM stores WHERE ItemStatusId = ? StoreId IN(SELECT StoreId FROM storeusers WHERE UserId = ?)', array(STATUS_ACTIVED, $userId));
        return $this->getBy(array('ItemStatusId' => STATUS_ACTIVED));
    }
}
