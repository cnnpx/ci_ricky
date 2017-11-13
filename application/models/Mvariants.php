<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mvariants extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "variants";
        $this->_primary_key = "VariantId";
    }
}