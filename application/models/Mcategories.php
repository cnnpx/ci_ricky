<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcategories extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "categories";
        $this->_primary_key = "CategoryId";
    }

    public function changeStatusBatch($categoryIds, $statusId){
        $this->db->query('UPDATE categories SET StatusId = ? WHERE CategoryId IN(' . implode(',', $categoryIds) . ')', array($statusId));
        return true;
    }

    public function update($postData, $categoryId = 0){
        $this->db->trans_begin();
        $this->db->set('DisplayOrder', 'DisplayOrder+1', false);
        $this->db->where(array('ItemTypeId' => $postData['ItemTypeId'], 'ProductTypeId' => $postData['ProductTypeId'], 'CategoryTypeId' => $postData['CategoryTypeId'], 'ParentCategoryId' => $postData['ParentCategoryId'], 'DisplayOrder>=' => $postData['DisplayOrder']));
        $this->db->update('categories');
        $categoryId = $this->save($postData, $categoryId);
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $categoryId;
        }
    }

    public function getListByItemType($itemTypeIds, $isAllItemType = false, $isAllStatus = false){
        $retVal = array();
        $query = 'SELECT * FROM categories WHERE 1=1 AND StatusId';
        if($isAllStatus) $query .= '> 0';
        else $query .= '='.STATUS_ACTIVED;
        if($isAllItemType) $retVal = $this->getByQuery($query . ' ORDER BY DisplayOrder ASC');
        else{
            if(is_numeric($itemTypeIds) && $itemTypeIds > 0) $retVal = $this->getByQuery($query. ' AND ItemTypeId = ? ORDER BY DisplayOrder ASC', array($itemTypeIds));
            elseif(is_array($itemTypeIds)) $retVal = $this->getByQuery($query . ' AND ItemTypeId IN(' . implode(',', $itemTypeIds) . ') ORDER BY DisplayOrder ASC');
        }
        return $retVal;
    }
}
