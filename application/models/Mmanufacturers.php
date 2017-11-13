<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmanufacturers extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "manufacturers";
        $this->_primary_key = "ManufacturerId";
    }

    public function getList(){
        return $this->get(0, false, '' , '', 0, 0, 'asc');
    }

}