<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpositions extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "positions";
        $this->_primary_key = "PositionId";
    }
}
