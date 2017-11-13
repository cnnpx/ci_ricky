<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcontributors extends MY_Model
{
    function __construct() {
        parent::__construct();
        $this->_table_name = "contributors";
        $this->_primary_key = "ContributorId";
    }

    public function getList(){
        return $this->get(0, false, '' , '', 0, 0, 'asc');
    }

    public function checkExist($contributorId, $contributorName){
        $query = "SELECT ContributorId FROM contributors WHERE ContributorId !=?";
        if(!empty($contributorName)){
            $query .= " AND (ContributorName = ?) LIMIT 1";
            $contributors = $this->getByQuery($query, array($contributorId, $contributorName));
        }
        if (!empty($contributors)) return TRUE;
        return false;
    }

    public function update($postData, $contributorId){
        $this->db->trans_begin();
        $contributorId = $this->save($postData, $contributorId);
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $contributorId;
        }
    }
}