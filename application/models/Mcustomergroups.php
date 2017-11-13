<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcustomergroups extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "customergroups";
        $this->_primary_key = "CustomerGroupId";
    }

    public function getList(){
        return $this->getBy(array('StatusId >' => 0));
    }
}
