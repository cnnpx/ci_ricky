<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfilters extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "filters";
        $this->_primary_key = "FilterId";
    }

    public function getList($itemTypeId){
        return $this->getBy(array('StatusId >' => 0, 'ItemTypeId' => $itemTypeId));
    }
}
