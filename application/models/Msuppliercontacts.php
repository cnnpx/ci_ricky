<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msuppliercontacts extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "suppliercontacts";
        $this->_primary_key = "SupplierContactId";
    }
}