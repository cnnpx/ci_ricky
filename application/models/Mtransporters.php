<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransporters extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "transporters";
        $this->_primary_key = "TransporterId";
    }

    /*public function getCount($postData){
        $query = "ItemStatusId > 0" . $this->buildQuery($postData);
        return $this->countRows($query);
    }

    public function search($postData, $perPage = 0, $page = 1){
        $query = "SELECT * FROM transporters WHERE ItemStatusId > 0" . $this->buildQuery($postData);
        if($perPage > 0) {
            $from = ($page-1) * $perPage;
            $query .= " LIMIT {$from}, {$perPage}";
        }
        return $this->getByQuery($query);
    }

    private function buildQuery($postData){
        $query = '';
        if(isset($postData['TransporterCode']) && !empty($postData['TransporterCode'])) $query.=" AND TransporterCode LIKE '%{$postData['TransporterCode']}%'";
        if(isset($postData['TransporterName']) && !empty($postData['TransporterName'])) $query.=" AND TransporterName LIKE '%{$postData['TransporterName']}%'";
        if(isset($postData['HasCOD']) && $postData['HasCOD'] > 0) $query.=" AND HasCOD=".$postData['HasCOD'];
        if(isset($postData['ItemStatusId']) && $postData['ItemStatusId'] > 0) $query.=" AND ItemStatusId=".$postData['ItemStatusId'];
        if(isset($postData['StoreId']) && $postData['StoreId'] > 0) $query.=" AND TransporterId IN(SELECT TransporterId FROM transporterstores WHERE StoreId = {$postData['StoreId']})";
        if(isset($postData['ContactName']) && !empty($postData['ContactName'])) $query.=" AND TransporterId IN(SELECT TransporterId FROM transportercontacts WHERE ContactName LIKE '%{$postData['ContactName']}%')";
        if(isset($postData['ContactPhone']) && !empty($postData['ContactPhone'])) $query.=" AND TransporterId IN(SELECT TransporterId FROM transportercontacts WHERE ContactPhone LIKE '%{$postData['ContactPhone']}%')";
        return $query;
    }*/

    public function update($postData, $transporterId, $storeIds, $contacts){
        $isUpdate = $transporterId > 0 ? true : false;
        $this->db->trans_begin();
        $transporterId = $this->save($postData, $transporterId);
        if($transporterId > 0){
            if($isUpdate){
                $this->db->delete('transporterstores', array('TransporterId' => $transporterId));
                $this->db->delete('transportercontacts', array('TransporterId' => $transporterId));
            }
            if(!empty($storeIds)){
                $valueData = array();
                foreach($storeIds as $storeId) $valueData[] = array('TransporterId' => $transporterId, 'StoreId' => $storeId);
                $this->db->insert_batch('transporterstores', $valueData);
            }
            if(!empty($contacts)){
                $valueData = array();
                foreach($contacts as $c){
                    $c['TransporterId'] = $transporterId;
                    $valueData[] = $c;
                }
                $this->db->insert_batch('transportercontacts', $valueData);
            }
        }
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $transporterId;
        }
    }

    public function deleteBatch($transporterIds){
        $this->db->query('UPDATE transporters SET ItemStatusId = 0 WHERE TransporterId IN('.implode(',', $transporterIds).')');
    }
}