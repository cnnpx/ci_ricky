<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mparts extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "parts";
        $this->_primary_key = "PartId";
    }
}
