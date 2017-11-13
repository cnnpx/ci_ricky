<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgroupactions extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "groupactions";
        $this->_primary_key = "GroupActionId";
    }

    public function updateBatch($groupid, $valueData){
        if(!empty($valueData)){
            $this->db->trans_begin();
            $this->db->delete('groupactions', array('GroupId' => $groupid));
            $this->db->insert_batch('groupactions', $valueData);
            if ($this->db->trans_status() === false){
                $this->db->trans_rollback();
                return false;
            }
            else{
                $this->db->trans_commit();
                return true;
            }
        }
        else{
            $this->db->delete('groupactions', array('GroupId' => $groupid));
            return true;
        }
    }

}