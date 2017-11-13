<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpromotions extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "promotions";
        $this->_primary_key = "PromotionId";
    }

    public function changeStatusBatch($promotionIds, $statusId){
        $this->db->query('UPDATE promotions SET PromotionStatusId = 0 WHERE PromotionId IN('.implode(',', $promotionIds).')');
    }
}