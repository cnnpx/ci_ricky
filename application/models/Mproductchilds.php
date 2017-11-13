<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mproductchilds extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "productchilds";
        $this->_primary_key = "ProductChildId";
    }
}