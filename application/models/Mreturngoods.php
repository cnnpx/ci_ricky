<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreturngoods extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "returngoods";
        $this->_primary_key = "ReturnGoodId";
    }

    public function update($postData, $returnGoodId, $customerAddress, $products = array(), $tagNames = array(), $actionLogs = array()){
        $this->load->model('Mcustomeraddress');
        $this->load->model('Mtags');
        $itemTypeId = 14;
        $isUpdate = $returnGoodId > 0 ? true : false;
        $this->db->trans_begin();
        $postData['CustomerAddressId'] = $this->Mcustomeraddress->update($customerAddress);
        $returnGoodId = $this->save($postData, $returnGoodId, array('UpdateUserId', 'UpdateDateTime'));
        if($returnGoodId > 0){
            if(!empty($actionLogs)){
                $actionLogs['ItemId'] = $returnGoodId;
                $this->load->model('Mactionlogs');
                $this->Mactionlogs->save($actionLogs);
            }
            if($isUpdate){
                $this->db->delete('returngoodproducts', array('ReturnGoodId' => $returnGoodId));
                $this->db->delete('itemtags', array('ItemId' => $returnGoodId, 'ItemTypeId' => $itemTypeId));
            }
            else{
                $returnGoodCode = 'HDH-' . ($returnGoodId + 10000);
                $this->db->update('returngoods', array('ReturnGoodCode' => $returnGoodCode), array('ReturnGoodId' => $returnGoodId));
            }
            if (!empty($products)) {
                $returnGoodProducts = array();
                foreach ($products as $p) {
                    $p['ReturnGoodId'] = $returnGoodId;
                    $returnGoodProducts[] = $p;
                }
                if (!empty($returnGoodProducts)) $this->db->insert_batch('returngoodproducts', $returnGoodProducts);
            }
            if(!empty($tagNames)){
                $itemTags = array();
                foreach($tagNames as $tagName){
                    $tagId = $this->Mtags->getTagId($tagName, $itemTypeId);
                    if($tagId > 0){
                        $itemTags[] = array(
                            'ItemId' => $returnGoodId,
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
            return $returnGoodId;
        }
    }

    public function changeStatusBatch($returnGoodIds, $statusId, $user){
        $crDateTime = getCurentDateTime();
        $statusName = $this->Mconstants->returnGoodStatus[$statusId];
        $this->db->trans_begin();
        $this->db->query('UPDATE returngoods SET TransportStatusId = ? WHERE ReturnGoodId IN('.implode(',', $returnGoodIds).')', array($statusId));
        $actionLogs = array();
        foreach($returnGoodIds as $returnGoodId){
            $actionLogs[] = array(
                'ItemId' => $returnGoodId,
                'ItemTypeId' => 9,
                'ActionTypeId' => $statusId > 0 ? 2 : 3,
                'Comment' => $statusId > 0 ? ($user['FullName'].' thay đổi trạng thái đơn hoàn hàng về về '.$statusName) : ($user['FullName'].' xóa đơn hoàn hàng về'),
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