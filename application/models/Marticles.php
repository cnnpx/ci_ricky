<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marticles extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "articles";
        $this->_primary_key = "ArticleId";
    }
    public function getCount($postData){
        $query = "ArticleStatusId > 0" . $this->buildQuery($postData);
        return $this->countRows($query);
    }

    public function search($postData, $perPage = 0, $page = 1){
        $query = "SELECT * FROM articles WHERE ArticleStatusId > 0" . $this->buildQuery($postData);
        if($perPage > 0) {
            $from = ($page-1) * $perPage;
            $query .= " LIMIT {$from}, {$perPage}";
        }
        return $this->getByQuery($query);
    }

    private function buildQuery($postData){
        $query = '';
        if(isset($postData['ArticleTitle']) && !empty($postData['ArticleTitle'])) $query.=" AND ArticleTitle LIKE '%{$postData['ArticleTitle']}%'";
        if(isset($postData['ArticleTypeId']) && $postData['ArticleTypeId'] > 0)  $query.=" AND ArticleTypeId=".$postData['ArticleTypeId'];
        return $query;
    }

    public function update($postData, $articleId = 0, $categoryIds = array(), $tagNames = array()){
        $this->load->model('Mtags');
        $itemTypeId = 4;
        $isUpdate = $articleId > 0;
        $this->db->trans_begin();
        $articleId = $this->save($postData, $articleId);
        if($articleId > 0){
            if($isUpdate){
                $this->db->delete('categoryitems', array('ItemId' => $articleId, 'ItemTypeId' => $itemTypeId));
                $this->db->delete('itemtags', array('ItemId' => $articleId, 'ItemTypeId' => $itemTypeId));
            }
            if(!empty($categoryIds)){
                $categoryItems = array();
                foreach($categoryIds as $cateId){
                    $categoryItems[] = array(
                        'CategoryId' => $cateId,
                        'ItemId' => $articleId,
                        'ItemTypeId' => $itemTypeId
                    );
                }
                if(!empty($categoryItems)) $this->db->insert_batch('categoryitems', $categoryItems);
            }
            if(!empty($tagNames)){
                $itemTags = array();
                foreach($tagNames as $tagName){
                    $tagId = $this->Mtags->getTagId($tagName, $itemTypeId);
                    if($tagId > 0){
                        $itemTags[] = array(
                            'ItemId' => $articleId,
                            'ItemTypeId' => $itemTypeId,
                            'TagId' => $tagId
                        );
                    }
                }
                if(!empty($itemTags)) $this->db->insert_batch('itemtags', $itemTags);
            }
        }
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $articleId;
        }
    }
}
