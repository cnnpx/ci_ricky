<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mordertypes extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "ordertypes";
        $this->_primary_key = "OrderTypeId";
    }
}
