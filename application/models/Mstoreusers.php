<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mstoreusers extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "storeusers";
        $this->_primary_key = "StoreUserId";
    }

    public function getUserIds($storeId){
        $retVal = array();
        $sus = $this->getBy(array('StoreId' => $storeId), false, '', 'UserId');
        foreach($sus as $su) $retVal[] = $su['UserId'];
        return $retVal;
    }
}
