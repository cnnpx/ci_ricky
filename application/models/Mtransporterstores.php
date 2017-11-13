<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransporterstores extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "transporterstores";
        $this->_primary_key = "TransporterStoreId";
    }
}
