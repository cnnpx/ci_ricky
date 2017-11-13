<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mactionlogs extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "actionlogs";
        $this->_primary_key = "ActionLogId";
    }

    public function getList($itemId, $itemTypeId){
        return $this->getBy(array('ItemId' => $itemId, 'ItemTypeId' => $itemTypeId), false, 'CrDateTime');
    }
}
