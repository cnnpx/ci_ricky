<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mproducttypes extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "producttypes";
        $this->_primary_key = "ProductTypeId";
    }

    public function getList(){
        return $this->get(0, false, '' , '', 0, 0, 'asc');
    }

    public function checkExist($productTypeId, $productTypeName){
        $query = "SELECT ProductTypeId FROM producttypes WHERE ProductTypeId!=? AND StatusId=?";
        if(!empty($productTypeName)){
            $query .= " AND (ProductTypeName = ?) LIMIT 1";
            $productTypes = $this->getByQuery($query, array($productTypeId, STATUS_ACTIVED, $productTypeName));
        }
        if (!empty($productTypes)) return $productTypes[0];
        return false;
    }

    public function update($postData, $productTypeId){
        $this->db->trans_begin();
        $productTypeId = $this->save($postData, $productTypeId);
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $productTypeId;
        }
    }
}