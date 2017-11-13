<?php

/**
 * Created by PhpStorm.
 * User: Luffy
 * Date: 7/19/2017
 * Time: 5:25 PM
 */
class Mproducts extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "products";
        $this->_primary_key = "ProductId";
    }

    /*public function getCount($postData){
        $query = "ProductStatusId > 0" . $this->buildQuery($postData);
        return $this->countRows($query);
    }*/

    public function search($postData, $perPage = 0, $page = 1){
        $query = "SELECT * FROM products WHERE ProductStatusId > 0 AND ProductKindId != 3" . $this->buildQuery($postData) . ' ORDER BY ProductId DESC';
        if($perPage > 0) {
            $from = ($page-1) * $perPage;
            $query .= " LIMIT {$from}, {$perPage}";
        }
        return $this->getByQuery($query);
    }

    private function buildQuery($postData){
        $query = '';
        if(isset($postData['ProductName']) && !empty($postData['ProductName'])) $query.=" AND ProductName LIKE '%{$postData['ProductName']}%'";
        if(isset($postData['ProductTypeId']) && $postData['ProductTypeId'] > 0)  $query.=" AND ProductTypeId=".$postData['ProductTypeId'];
        if(isset($postData['ManufacturerId']) && $postData['ManufacturerId'] > 0) $query.=" AND ManufacturerId=".$postData['ManufacturerId'];
        if(isset($postData['NoParentProductId']) && $postData['NoParentProductId'] == 1) $query.=" AND ParentProductId=0";
        if(isset($postData['OrderId']) && $postData['OrderId'] > 0) $query.=" AND ProductId IN(SELECT ProductId FROM orderproducts WHERE OrderId = {$postData['OrderId']})";
        if(isset($postData['CategoryId']) && $postData['CategoryId'] > 0) $query.=" AND ProductId IN(SELECT ProductId FROM categoryitems WHERE ItemTypeId=3 AND CategoryId = {$postData['CategoryId']})";
        if(isset($postData['SearchText']) && !empty($postData['SearchText'])) $query.=" AND (ProductName LIKE '%{$postData['SearchText']}%' OR ProductId IN(SELECT ProductId FROM productchilds WHERE ProductName LIKE '%{$postData['SearchText']}%'))";
        return $query;
    }

    public function getInfoByOrder($orderId){
        $retVal = array();
        $products = $this->getByQuery('SELECT p.ProductName AS ProductName , p.BarCode AS BarCode, pc.ProductName AS ProductName1, pc.BarCode AS BarCode1, op.Quantity
                                        FROM products p, productchilds pc RIGHT JOIN orderproducts op  ON op.ProductChildId = pc.ProductChildId
                                        WHERE op.OrderId = ?  AND op.ProductId = p.ProductId', array($orderId));
        foreach($products as $p){
            $retVal[] = array(
                'ProductName' => $p['ProductName'] . (empty($p['ProductName1']) ? '' : " ({$p['ProductName1']})"),
                'BarCode' => empty($p['BarCode1']) ? $p['BarCode'] : $p['BarCode1'],
                'Quantity' => $p['Quantity']
            );
        }
        return $retVal;
    }

    public function getInfoByStoreCirculation($storeCirculationId){
        $retVal = array();
        $products = $this->getByQuery('SELECT p.ProductName AS ProductName , p.BarCode AS BarCode, pc.ProductName AS ProductName1, pc.BarCode AS BarCode1, sp.Quantity
                                        FROM products p, productchilds pc RIGHT JOIN storecirculationproducts sp  ON sp.ProductChildId = pc.ProductChildId
                                        WHERE sp.StoreCirculationId = ?  AND sp.ProductId = p.ProductId', array($storeCirculationId));
        foreach($products as $p){
            $retVal[] = array(
                'ProductName' => $p['ProductName'] . (empty($p['ProductName1']) ? '' : " ({$p['ProductName1']})"),
                'BarCode' => empty($p['BarCode1']) ? $p['BarCode'] : $p['BarCode1'],
                'Quantity' => $p['Quantity']
            );
        }
        return $retVal;
    }

    public function getInfoByReturnGood($returnGoodId){
        $retVal = array();
        $products = $this->getByQuery('SELECT p.ProductName AS ProductName , p.BarCode AS BarCode, pc.ProductName AS ProductName1, pc.BarCode AS BarCode1, rgp.Quantity
                                        FROM products p, productchilds pc RIGHT JOIN returngoodproducts rgp  ON rgp.ProductChildId = pc.ProductChildId
                                        WHERE rgp.ReturnGoodId = ?  AND rgp.ProductId = p.ProductId', array($returnGoodId));
        foreach($products as $p){
            $retVal[] = array(
                'ProductName' => $p['ProductName'] . (empty($p['ProductName1']) ? '' : " ({$p['ProductName1']})"),
                'BarCode' => empty($p['BarCode1']) ? $p['BarCode'] : $p['BarCode1'],
                'Quantity' => $p['Quantity']
            );
        }
        return $retVal;
    }

    public function update($postData, $productId = 0, $images = array(), $productSEO  = array(), $cateIds1 = array(), $cateIds2 = array(), $tagNames = array(), $productChilds = array()){
        $this->load->model('Mfiles');
        $this->load->model('Mitemmetadatas');
        $this->load->model('Mtags');
        $itemTypeId = 3;
        $isUpdate = $productId > 0;
        $this->db->trans_begin();
        $productId = $this->save($postData, $productId, array('UpdateUserId', 'UpdateDateTime'));
        if($productId > 0){
            if($isUpdate){
                $this->db->delete('itemfiles', array('ItemId' => $productId, 'ItemTypeId' => $itemTypeId));
                $this->db->delete('categoryitems', array('ItemId' => $productId, 'ItemTypeId' => $itemTypeId));
                $this->db->delete('itemtags', array('ItemId' => $productId, 'ItemTypeId' => $itemTypeId));
                $this->db->delete('productchilds', array('ProductId' => $productId));
            }
            if(!empty($images)){
                $itemFiles = array();
                foreach($images as $img){
                    $fileId = $this->Mfiles->getFileId($postData['ProductName'], $img, 1);
                    if($fileId > 0) {
                        $itemFiles[] = array(
                            'ItemId' => $productId,
                            'ItemTypeId' => $itemTypeId,
                            'FileId' => $fileId
                        );
                    }
                }
                if(!empty($itemFiles)) $this->db->insert_batch('itemfiles', $itemFiles);
            }
            if(!empty($productSEO)){
                $productSEO['ItemId'] = $productId;
                $itemMetadataId = 0;
                if($isUpdate) $itemMetadataId = $this->Mitemmetadatas->getFieldValue(array('ItemId' => $productId, 'ItemTypeId' => $itemTypeId), 'ItemMetadataId', 0);
                $this->Mitemmetadatas->save($productSEO, $itemMetadataId);
            }
            $categoryItems = array();
            if(!empty($cateIds1)){
                foreach($cateIds1 as $cateId){
                    $categoryItems[] = array(
                        'CategoryId' => $cateId,
                        'ItemId' => $productId,
                        'ItemTypeId' => $itemTypeId
                    );
                }
            }
            if(!empty($cateIds2)){
                foreach($cateIds2 as $cateId){
                    $categoryItems[] = array(
                        'CategoryId' => $cateId,
                        'ItemId' => $productId,
                        'ItemTypeId' => $itemTypeId
                    );
                }
            }
            if(!empty($categoryItems)) $this->db->insert_batch('categoryitems', $categoryItems);
            if(!empty($tagNames)){
                $itemTags = array();
                foreach($tagNames as $tagName){
                    $tagId = $this->Mtags->getTagId($tagName, $itemTypeId);
                    if($tagId > 0){
                        $itemTags[] = array(
                            'ItemId' => $productId,
                            'ItemTypeId' => $itemTypeId,
                            'TagId' => $tagId
                        );
                    }
                }
                if(!empty($itemTags)) $this->db->insert_batch('itemtags', $itemTags);
            }
            if(!empty($productChilds)){
                $productChildInserts = array();
                foreach($productChilds as $pc){
                    $pc['ProductId'] = $productId;
                    $productChildInserts[] = $pc;
                }
                $this->db->insert_batch('productchilds', $productChildInserts);
            }
        }
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return 0;
        }
        else{
            $this->db->trans_commit();
            return $productId;
        }
    }

    public function changeStatusBatch($productIds, $statusId, $user){
        $crDateTime = getCurentDateTime();
        $comment = $statusId > 0 ? ($user['FullName'].' thay đổi trạng thái sản phẩm về '.$this->Mconstants->productStatus[$statusId]) : ($user['FullName'].' xóa sản phẩm');
        $this->db->trans_begin();
        $this->db->query('UPDATE products SET ProductStatusId = ? WHERE ProductId IN('.implode(',', $productIds).')', array($statusId));
        $actionLogs = array();
        foreach($productIds as $productId){
            $actionLogs[] = array(
                'ItemId' => $productId,
                'ItemTypeId' => 3,
                'ActionTypeId' => $statusId > 0 ? 2 : 3,
                'Comment' => $comment,
                'CrUserId' => $user['UserId'],
                'CrDateTime' => $crDateTime
            );
        }
        if(!empty($actionLogs)) $this->db->insert_batch('actionlogs', $actionLogs);
        if ($this->db->trans_status() === false){
            $this->db->trans_rollback();
            return false;
        }
        else{
            $this->db->trans_commit();
            return true;
        }
    }

    public function getProductName($productId, $productChildId = 0, $barCode = ''){
        if($productId > 0) return $this->getFieldValue(array('ProductId' => $productId), 'ProductName');
        else{
            $this->load->model('Mproductchilds');
            if($productChildId > 0) {
                $pc = $this->Mproductchilds->get($productChildId, true, '', 'ProductId, ProductName');
                if($pc) return $this->getFieldValue(array('ProductId' => $pc['ProductId']), 'ProductName') . ' (' . $pc['ProductName'] . ')';
            }
            elseif(!empty($barCode)){
                $productName = $this->getFieldValue(array('BarCode' => $barCode), 'ProductName');
                if(!empty($productName)) return $productName;
                $pc = $this->Mproductchilds->getBy(array('BarCode' => $barCode), true, '', 'ProductId, ProductName');
                if($pc) return $this->getFieldValue(array('ProductId' => $pc['ProductId']), 'ProductName') . ' (' . $pc['ProductName'] . ')';
            }
        }
        return '';
    }
}