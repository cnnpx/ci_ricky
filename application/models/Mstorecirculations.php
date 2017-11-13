<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mstorecirculations extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "storecirculations";
        $this->_primary_key = "StoreCirculationId";
    }

    public function update($postData, $storeCirculationId = 0, $products = array(), $tagNames = array(), $actionLogs = array()){
        $this->load->model('Mtags');
        $itemTypeId = 7;
        $isUpdate = $storeCirculationId > 0 ? true : false;
        $this->db->trans_begin();
        $storeCirculationId = $this->save($postData, $storeCirculationId, array('Comment', 'CancelReason', 'HandleDate'));
        if($storeCirculationId > 0){
            if(!empty($actionLogs)){
                $actionLogs['ItemId'] = $storeCirculationId;
                $this->load->model('Mactionlogs');
                $this->Mactionlogs->save($actionLogs);
            }
            if($isUpdate){
                $this->db->delete('storecirculationproducts', array('StoreCirculationId' => $storeCirculationId));
                $this->db->delete('itemtags', array('ItemId' => $storeCirculationId, 'ItemTypeId' => $itemTypeId));
            }
            else{
                $orderCode = 'LCK-' . ($storeCirculationId + 10000);
                $this->db->update('storecirculations', array('StoreCirculationCode' => $orderCode), array('StoreCirculationId' => $storeCirculationId));
            }
            if(!empty($products)){
                $storeCirculationProducts = array();
                foreach($products as $p){
                    $p['StoreCirculationId'] = $storeCirculationId;
                    $storeCirculationProducts[] = $p;
                }
                $this->db->insert_batch('storecirculationproducts', $storeCirculationProducts);
            }
            if(!empty($tagNames)){
                $itemTags = array();
                foreach($tagNames as $tagName){
                    $tagId = $this->Mtags->getTagId($tagName, $itemTypeId);
                    if($tagId > 0){
                        $itemTags[] = array(
                            'ItemId' => $storeCirculationId,
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
            return $storeCirculationId;
        }
    }

    public function changeStatusBatch($storeCirculationIds, $statusId, $user){
        $crDateTime = getCurentDateTime();
        $comment = $statusId > 0 ? ($user['FullName'].' thay đổi trạng thái lưu chuyển kho về '.$this->Mconstants->orderStatus[$statusId]) : ($user['FullName'].' xóa lưu chuyển kho');
        $this->db->trans_begin();
        $this->db->query('UPDATE storecirculations SET OrderStatusId = ? WHERE StoreCirculationId IN('.implode(',', $storeCirculationIds).')', array($statusId));
        $actionLogs = array();
        foreach($storeCirculationIds as $circulationId){
            $actionLogs[] = array(
                'ItemId' => $circulationId,
                'ItemTypeId' => 7,
                'ActionTypeId' => $statusId > 0 ? 2 : 3,
                'Comment' => $comment,
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