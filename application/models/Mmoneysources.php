<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmoneysources extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "moneysources";
        $this->_primary_key = "MoneySourceId";
    }
}
