<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Morders extends MY_Model{

    function __construct(){
        parent::__construct();
        $this->_table_name = "orders";
        $this->_primary_key = "OrderId";
    }

    public function update($postData, $orderId, $customerAddress, $products = array(), $tagNames = array(), $services = array(), $actionLogs = array()){
        $this->load->model('Mcustomeraddress');
        $this->load->model('Mtags');
        $itemTypeId = 6;
        $isUpdate = $orderId > 0 ? true : false;
        $this->db->trans_begin();
        $postData['CustomerAddressId'] = $this->Mcustomeraddress->update($customerAddress);
        $orderId = $this->save($postData, $orderId, array('UpdateUserId', 'UpdateDateTime'));
        if ($orderId > 0) {
            if (!empty($actionLogs)) {
                $actionLogs['ItemId'] = $orderId;
                $this->load->model('Mactionlogs');
                $this->Mactionlogs->save($actionLogs);
            }
            if ($isUpdate) {
                $this->db->delete('orderproducts', array('OrderId' => $orderId));
                $this->db->delete('itemtags', array('ItemId' => $orderId, 'ItemTypeId' => $itemTypeId));
                $this->db->delete('orderservices', array('OrderId' => $orderId));
            } else {
                $orderCode = 'DH-' . ($orderId + 10000);
                $this->db->update('orders', array('OrderCode' => $orderCode), array('OrderId' => $orderId));
            }
            if (!empty($products)) {
                $orderProducts = array();
                foreach ($products as $p) {
                    $p['OrderId'] = $orderId;
                    $orderProducts[] = $p;
                }
                if (!empty($orderProducts)) $this->db->insert_batch('orderproducts', $orderProducts);
            }
            if (!empty($tagNames)) {
                $itemTags = array();
                foreach ($tagNames as $tagName) {
                    $tagId = $this->Mtags->getTagId($tagName, $itemTypeId);
                    if ($tagId > 0) {
                        $itemTags[] = array(
                            'ItemId' => $orderId,
                            'ItemTypeId' => $itemTypeId,
                            'TagId' => $tagId
                        );
                    }
                }
                if (!empty($itemTags)) $this->db->insert_batch('itemtags', $itemTags);
            }
            if (!empty($services)) {
                $orderServices = array();
                foreach ($services as $s) {
                    $s['OrderId'] = $orderId;
                    $orderServices[] = $s;
                }
                if (!empty($orderProducts)) $this->db->insert_batch('orderservices', $orderServices);
            }
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return $orderId;
        }
    }

    public function changeStatusBatchWeb($orderIds, $statusId, $user){
        $crDateTime = getCurentDateTime();
        $comment = $statusId > 0 ? ($user['FullName'] . ' thay đổi trạng thái đơn hàng về ' . $this->Mconstants->orderStatus[$statusId]) : ($user['FullName'] . ' xóa đơn hàng');
        $this->db->trans_begin();
        $this->db->query('UPDATE orders SET OrderStatusId = ? WHERE OrderId IN(' . implode(',', $orderIds) . ')', array($statusId));
        $actionLogs = array();
        foreach ($orderIds as $orderId) {
            $actionLogs[] = array(
                'ItemId' => $orderId,
                'ItemTypeId' => 6,
                'ActionTypeId' => $statusId > 0 ? 2 : 3,
                'Comment' => $comment,
                'CrUserId' => $user['UserId'],
                'CrDateTime' => $crDateTime
            );
        }
        if (!empty($actionLogs)) $this->db->insert_batch('actionlogs', $actionLogs);
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function changeVerifyStatusBatch($orderIds, $verifyStatusId, $user){
        $crDateTime = getCurentDateTime();
        $comment = $verifyStatusId == 2 ? ($user['FullName'] . ' đã xác thực đơn hàng') : ($user['FullName'] . ' chuyển đơn hàng về trạng thái chưa xác thực');
        $this->db->trans_begin();
        $this->db->query('UPDATE orders SET VerifyStatusId = ? WHERE OrderId IN(' . implode(',', $orderIds) . ')', array($verifyStatusId));
        $actionLogs = array();
        foreach ($orderIds as $orderId) {
            $actionLogs[] = array(
                'ItemId' => $orderId,
                'ItemTypeId' => 6,
                'ActionTypeId' => 2,
                'Comment' => $comment,
                'CrUserId' => $user['UserId'],
                'CrDateTime' => $crDateTime
            );
        }
        if (!empty($actionLogs)) $this->db->insert_batch('actionlogs', $actionLogs);
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}