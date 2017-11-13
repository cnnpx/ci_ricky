<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msuppliers extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "suppliers";
        $this->_primary_key = "SupplierId";
    }

    public function getCount($postData){
        $query = "ItemStatusId > 0" . $this->buildQuery($postData);
        return $this->countRows($query);
    }

    public function search($postData, $perPage = 0, $page = 1){
        $query = "SELECT * FROM suppliers WHERE ItemStatusId > 0" . $this->buildQuery($postData);
        if($perPage > 0) {
            $from = ($page-1) * $perPage;
            $query .= " LIMIT {$from}, {$perPage}";
        }
        return $this->getByQuery($query);
    }

    private function buildQuery($postData){
        $query = '';
        if(isset($postData['SupplierCode']) && !empty($postData['SupplierCode'])) $query.=" AND SupplierCode LIKE '%{$postData['SupplierCode']}%'";
        if(isset($postData['SupplierName']) && !empty($postData['SupplierName'])) $query.=" AND SupplierName LIKE '%{$postData['SupplierName']}%'";
        if(isset($postData['SupplierTypeId']) && $postData['SupplierTypeId'] > 0) $query.=" AND SupplierTypeId=".$postData['SupplierTypeId'];
        if(isset($postData['ItemStatusId']) && $postData['ItemStatusId'] > 0) $query.=" AND ItemStatusId=".$postData['ItemStatusId'];
        if(isset($postData['ContactName']) && !empty($postData['ContactName'])) $query.=" AND SupplierId IN(SELECT SupplierId FROM suppliercontacts WHERE ContactName LIKE '%{$postData['ContactName']}%')";
        if(isset($postData['ContactPhone']) && !empty($postData['ContactPhone'])) $query.=" AND SupplierId IN(SELECT SupplierId FROM suppliercontacts WHERE ContactPhone LIKE '%{$postData['ContactPhone']}%')";
        return $query;
    }

    public function update($postData, $supplierId,  $contacts){
        $this->db->trans_begin();

        if($supplierId > 0) {
            $this->db->delete('suppliercontacts', array('SupplierId' => $supplierId));
        }
        $supplierId = $this->save($postData, $supplierId);
        if($supplierId > 0){
            if(!empty($contacts)){
                $valueData = array();
                foreach($contacts as $c){
                    $c['SupplierId'] = $supplierId;
                    $valueData[] = $c;
                }
                $this->db->insert_batch('suppliercontacts', $valueData);
            }
        }
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $supplierId;
        }
    }
}