<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcancelreasons extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "cancelreasons";
        $this->_primary_key = "CancelReasonId";
    }
}
