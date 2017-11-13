<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mimports extends MY_Model
{

    function __construct() {
        parent::__construct();
        $this->_table_name = 'imports';
        $this->_primary_key = 'ImportId';
    }

    public function update($postData, $importId = 0, $products = array(), $tagNames = array(), $actionLogs = array()){
        $user = $this->session->userdata('user');
        $this->load->model('Mtags');
        $itemTypeId = 8;
        $isUpdate = $importId > 0 ? true : false;
        $this->db->trans_begin();
        $importId = $this->save($postData, $importId, array('UpdateUserId', 'UpdateDateTime'));
        $import = $this->Mimports->get($importId);
        if($importId > 0){
            if(!empty($actionLogs)){
                $actionLogs['ItemId'] = $importId;
                $this->load->model('Mactionlogs');
                $this->Mactionlogs->save($actionLogs);
            }
            if($isUpdate){
                $this->db->delete('importproducts', array('ImportId' => $importId));
                $this->db->delete('itemtags', array('ItemId' => $importId, 'ItemTypeId' => $itemTypeId));
            }
            else{
                $importCode = 'NK-' . ($importId + 10000);
                $this->db->update('imports', array('ImportCode' => $importCode), array('ImportId' => $importId));
            }
            if(!empty($products)){
                $importProducts = array();
                foreach($products as $p){
                    $p['ImportId'] = $importId;
                    $importProducts[] = $p;
                }
                if(!empty($importProducts)) $this->db->insert_batch('importproducts', $importProducts);
            }
            if(!empty($tagNames)){
                $itemTags = array();
                foreach($tagNames as $tagName){
                    $tagId = $this->Mtags->getTagId($tagName, $itemTypeId);
                    if($tagId > 0){
                        $itemTags[] = array(
                            'ItemId' => $importId,
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
            return $importId;
        }
    }

    public function changeStatusBatch($importIds, $statusId, $user){
        $crDateTime = getCurentDateTime();
        $comment = $statusId > 0 ? ($user['FullName'].' thay đổi trạng thái nhập kho về '.$this->Mconstants->status[$statusId]) : ($user['FullName'].' xóa nhập kho');
        $this->db->trans_begin();
        $this->db->query('UPDATE imports SET StatusId = ? WHERE ImportId IN('.implode(',', $importIds).')', array($statusId));
        $actionLogs = array();
        foreach($importIds as $importId){
            $actionLogs[] = array(
                'ItemId' => $importId,
                'ItemTypeId' => 8,
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