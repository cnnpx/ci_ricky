<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgroups extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "groups";
        $this->_primary_key = "GroupId";
    }
}
