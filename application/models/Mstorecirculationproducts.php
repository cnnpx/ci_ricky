<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mstorecirculationproducts extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "storecirculationproducts";
        $this->_primary_key = "StoreCirculationProductId";
    }
}