<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransports extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "transports";
        $this->_primary_key = "TransportId";
    }

    public function update($postData, $transportId, $customerAddress, $tagNames = array(), $actionLogs = array()){
        $this->load->model('Mcustomeraddress');
        $this->load->model('Mtags');
        $itemTypeId = 9;
        $isUpdate = $transportId > 0 ? true : false;
        $this->db->trans_begin();
        $postData['CustomerAddressId'] = $this->Mcustomeraddress->update($customerAddress);
        $transportId = $this->save($postData, $transportId, array('UpdateUserId', 'UpdateDateTime'));
        if($transportId > 0){
            if(!empty($actionLogs)){
                $actionLogs['ItemId'] = $transportId;
                $this->load->model('Mactionlogs');
                $this->Mactionlogs->save($actionLogs);
            }
            if($isUpdate) $this->db->delete('itemtags', array('ItemId' => $transportId, 'ItemTypeId' => $itemTypeId));
            else{
                $transportCode = 'VC-' . ($transportId + 10000);
                $this->db->update('transports', array('TransportCode' => $transportCode), array('TransportId' => $transportId));
            }
            if(!empty($tagNames)){
                $itemTags = array();
                foreach($tagNames as $tagName){
                    $tagId = $this->Mtags->getTagId($tagName, $itemTypeId);
                    if($tagId > 0){
                        $itemTags[] = array(
                            'ItemId' => $transportId,
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
            return $transportId;
        }
    }

    public function changeStatusBatch($transportIds, $statusId, $user){
        $crDateTime = getCurentDateTime();
        $statusName = $this->Mconstants->transportStatus[$statusId];
        $this->db->trans_begin();
        $this->db->query('UPDATE transports SET TransportStatusId = ? WHERE TransportId IN('.implode(',', $transportIds).')', array($statusId));
        $actionLogs = array();
        foreach($transportIds as $transportId){
            $actionLogs[] = array(
                'ItemId' => $transportId,
                'ItemTypeId' => 9,
                'ActionTypeId' => $statusId > 0 ? 2 : 3,
                'Comment' => $statusId > 0 ? ($user['FullName'].' thay đổi trạng thái vận chuyển về '.$statusName) : ($user['FullName'].' xóa vận chuyển'),
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