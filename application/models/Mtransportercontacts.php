<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransportercontacts extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "transportercontacts";
        $this->_primary_key = "TransporterContactId";
    }
}