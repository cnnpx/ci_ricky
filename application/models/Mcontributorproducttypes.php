<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcontributorproducttypes extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "contributorproducttypes";
        $this->_primary_key = "ContributorProductTypeId";
    }

    public function getList($perPage = 0, $page = 1)
    {
    	$query = "SELECT cpt.ContributorProductTypeId,
    		cpt.Cost,
    		cpt.CrDateTime,
    		c.ContributorName,
    		pt.ProductTypeName,
    		u.FullName AS UserName
    		FROM contributorproducttypes cpt
    		JOIN contributors c ON c.ContributorId = cpt.ContributorId
    		JOIN producttypes pt ON pt.ProductTypeId = cpt.ProductTypeId
    		LEFT JOIN users u ON u.UserId = cpt.CrUserId";
        if($perPage > 0) {
            $from = ($page-1) * $perPage;
            $query .= " LIMIT {$from}, {$perPage}";
        }
        return $this->getByQuery($query);
    }

    public function getListContributor()
    {
        $query = "SELECT c.* FROM contributors c";
        return $this->getByQuery($query);
    }

    public function insert($data)
    {
        $this->db->set($data);
        $this->db->insert('contributorproducttypes');
    }

    public function update($postData, $contributorTypeId){
        $this->db->trans_begin();
        $contributorTypeId = $this->save($postData, $contributorTypeId);
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $contributorTypeId;
        }
    }
}