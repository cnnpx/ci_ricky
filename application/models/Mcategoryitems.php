<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcategoryitems extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "categoryitems";
        $this->_primary_key = "CategoryItemId";
    }

    public function getCateIds($itemId, $itemTypeId){
        $retVal = array();
        $cateItems = $this->getBy(array('ItemId' => $itemId, 'ItemTypeId' => $itemTypeId));
        foreach($cateItems as $ci) $retVal[] = $ci['CategoryId'];
        return $retVal;
    }
}