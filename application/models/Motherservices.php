<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Motherservices extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "otherservices";
        $this->_primary_key = "OtherServiceId";
    }
}