<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Morderproducts extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "orderproducts";
        $this->_primary_key = "OrderProductId";
    }
}
