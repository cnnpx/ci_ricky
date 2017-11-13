<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mscanproducts extends MY_Model{

    function __construct() {
        parent::__construct();
        $this->_table_name = 'scanproducts';
        $this->_primary_key = 'ScanProductId';
    }
}