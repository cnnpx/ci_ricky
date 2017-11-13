<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtags extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "tags";
        $this->_primary_key = "TagId";
    }

    public function getTagId($tagName, $itemTypeId){
        $tagId = $this->getFieldValue(array('TagName' => $tagName, 'ItemTypeId' => $itemTypeId), 'TagId', 0);
        if($tagId == 0) $tagId = $this->save(array('TagName' => $tagName, 'TagSlug' => makeSlug($tagName), 'ItemTypeId' => $itemTypeId), 0);
        return $tagId;
    }

    public function getTagNames($itemId, $itemTypeId){
        $retVal = array();
        $tags = $this->getByQuery('SELECT TagName FROM tags WHERE TagId IN(SELECT TagId FROM itemtags WHERE ItemId = ? AND ItemTypeId = ?)', array($itemId, $itemTypeId));
        foreach($tags as $tag) $retVal[] = $tag['TagName'];
        return $retVal;
    }

    public function updateItem($itemIds, $tagNames, $itemTypeId, $changeTagTypeId){
        $this->load->model('Mitemtags');
        $this->db->trans_begin();
        $tagIds = array();
        foreach($tagNames as $tagName) $tagIds[] = $this->getTagId($tagName, $itemTypeId);
        if(!empty($tagIds)) {
            if ($changeTagTypeId == 1) { //add
                foreach($itemIds as $itemId) {
                    foreach ($tagIds as $tagId) $this->Mitemtags->update(array('ItemId' => $itemId, 'ItemTypeId' => $itemTypeId, 'TagId' => $tagId));
                }
            }
            elseif ($changeTagTypeId == 2) { //remove
                $this->db->query('DELETE FROM itemtags WHERE ItemTypeId = '.$itemTypeId.' AND ItemId IN('.implode(',', $itemIds).') AND TagId IN('.implode(',', $tagIds).')');
            }
        }
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return false;
        }
        else{
            $this->db->trans_commit();
            return true;
        }
    }
}
