<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muserlevels extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "userlevels";
        $this->_primary_key = "UserLevelId";
    }
}