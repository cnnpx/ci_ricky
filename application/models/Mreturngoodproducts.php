<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreturngoodproducts extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "returngoodproducts";
        $this->_primary_key = "ReturnGoodProductId";
    }
}