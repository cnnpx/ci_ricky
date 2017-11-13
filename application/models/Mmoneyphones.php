<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmoneyphones extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "moneyphones";
        $this->_primary_key = "MoneyPhoneId";
    }
}
