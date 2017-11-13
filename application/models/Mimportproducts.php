<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mimportproducts extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "importproducts";
        $this->_primary_key = "ImportProductId";
    }
}