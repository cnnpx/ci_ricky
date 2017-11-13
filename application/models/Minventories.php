<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minventories extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "inventories";
        $this->_primary_key = "InventoryId";
    }

    public function update($postData, $inventoryId){
        $this->db->trans_begin();
        $inventoryId = $this->save($postData, $inventoryId, array('UpdateUserId', 'UpdateDateTime'));
        if($inventoryId > 0 && $postData['StatusId'] == STATUS_ACTIVED){
            $flag = false;
            if($postData['InventoryTypeId'] == 1 && $postData['Quantity'] != 0) $flag = true; //cong them
            else if($postData['InventoryTypeId'] == 2 && $postData['Quantity'] > 0) $flag = true; //set
            if($flag){
                $this->load->model('Mproductquantity');
                $this->Mproductquantity->updateInventory($postData);
            }
        }
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $inventoryId;
        }
    }
}