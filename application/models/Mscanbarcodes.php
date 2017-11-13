<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mscanbarcodes extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "scanbarcodes";
        $this->_primary_key = "ScanBarCodeId";
    }

    public function update($postData, $scanBarCodeId, $products = array()){
        $this->db->trans_begin();
        $scanBarCodeId = $this->save($postData, $scanBarCodeId);
        if($scanBarCodeId > 0){
            $scanProducts = array();
            foreach($products as $p){
                $p['ScanBarCodeId'] = $scanBarCodeId;
                $scanProducts[] = $p;
            }
            if(!empty($scanProducts)) $this->db->insert_batch('scanproducts', $scanProducts);
        }
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $scanBarCodeId;
        }
    }

    public function insertBatch($scanBarCodes){
        $this->db->trans_begin();
        $scanProducts = array();
        foreach($scanBarCodes as $sc){
            $ps = $sc['Products'];
            unset($sc['Products']);
            $scanBarCodeId = $this->save($sc);
            foreach($ps as $p){
                $p['ScanBarCodeId'] = $scanBarCodeId;
                $scanProducts[] = $p;
            }
        }
        if(!empty($scanProducts)) $this->db->insert_batch('scanproducts', $scanProducts);
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
