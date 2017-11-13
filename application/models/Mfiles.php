<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfiles extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "files";
        $this->_primary_key = "FileId";
    }

    public function getFileId($fileName, $fileUrl, $fileTypeId){
        $fileId = $this->getFieldValue(array('FileUrl' => $fileUrl, 'FileTypeId' => $fileTypeId), 'FileId', 0);
        if($fileId == 0) $fileId = $this->save(array('FileName' => $fileName, 'FileUrl' => $fileUrl, 'FileTYpeId' => $fileTypeId), 0);
        return $fileId;
    }

    public function getFileUrls($itemId, $itemTypeId, $fileTypeId){
        $retVal = array();
        $files = $this->getByQuery('SELECT FileUrl FROM files WHERE FileTypeId = ? AND FileId IN(SELECT FileId FROM itemfiles WHERE ItemId = ? AND ItemTypeId = ?)', array($fileTypeId, $itemId, $itemTypeId));
        foreach($files as $file) $retVal[] = $file['FileUrl'];
        return $retVal;
    }
}
