<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller{

    public function changeStatusBatch(){
        $user = $this->session->userdata('user');
        if($user){
            $productIds = json_decode(trim($this->input->post('ItemIds')), true);
            $statusId = $this->input->post('StatusId');
            if(!empty($productIds) && $statusId >= 0){
                $this->load->model('Mproducts');
                $flag = $this->Mproducts->changeStatusBatch($productIds, $statusId, $user);
                if($flag) {
                    $msg = 'Xóa sản phẩm thành công';
                    $statusName = '';
                    if ($statusId > 0) {
                        $msg = 'Thay đổi trạng thái thành công';
                        $statusName = '<span class="' . $this->Mconstants->labelCss[$statusId] . '">' . $this->Mconstants->productStatus[$statusId] . '</span>';
                    }
                    echo json_encode(array('code' => 1, 'message' => $msg, 'data' => $statusName));
                }
                else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function update(){
        $user = $this->session->userdata('user');
        if ($user) {
            $postData = $this->arrayFromPost(array('ProductName', 'ProductSlug', 'ProductDesc', 'ProductTypeId', 'ProductStatusId', 'ProductKindId', 'VATStatusId', 'ProductDisplayTypeId', 'ProductLevelId', 'ParentProductId', 'SupplierId', 'Quantity', 'IsContactPrice', 'Price', 'OldPrice', 'ProductImage', 'BarCode', 'Sku', 'Weight', 'IsManageExtraWarehouse', 'FormalStatus', 'UsageStatus', 'AccessoryStatus', 'GuaranteeMonth'));
            $productId = $this->input->post('ProductId');
            $crDateTime = getCurentDateTime();
            if($productId > 0){
                $postData['UpdateUserId'] = $user['UserId'];
                $postData['UpdateDateTime'] = $crDateTime;
            }
            else{
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = $crDateTime;
                $publishDateTime = trim($this->input->post('PublishDateTime'));
                if(!empty($publishDateTime)) $postData['PublishDateTime'] = $publishDateTime;
                else $postData['PublishDateTime'] = $crDateTime;
            }
            $productSEO = $this->arrayFromPost(array('TitleSEO', 'MetaDesc', 'Canonical', 'IsRobotIndex', 'IsRobotFollow', 'IsOnSitemap'));
            $productSEO['ItemTypeId'] = 3;
            if(empty($postData['ProductSlug'])){
                $postData['ProductSlug'] = makeSlug($postData['ProductName']);
                $productSEO['Canonical'] = $postData['ProductSlug'];
            }
            else{
                $postData['ProductSlug'] = makeSlug($postData['ProductSlug']);
                $productSEO['Canonical'] = $postData['ProductSlug'];
            }
            //$postData['ProductDesc'] = replaceFileUrl($postData['ProductDesc'], IMAGE_PATH, '/hmd/');
            if(empty($productSEO['TitleSEO'])) $productSEO['TitleSEO'] = $postData['ProductName'];
            $postData['ProductImage'] = replaceFileUrl($postData['ProductImage']);
            $images = json_decode(replaceFileUrl(trim($this->input->post('Images'))), true);
            $cateIds1 = json_decode(trim($this->input->post('CateIds1')), true);
            $cateIds2 = json_decode(trim($this->input->post('CateIds2')), true);
            $tagNames = json_decode(trim($this->input->post('TagNames')), true);
            $productChilds = array();
            if($postData['ProductKindId'] == 2) {
                $variants = json_decode(trim($this->input->post('Variants')), true);
                $variantOptions = json_decode(trim($this->input->post('VariantOptions')), true);
                unset($variants[0]);
                $variantId1 = $variantId2 = $variantId3 = 0;
                $variantValues1 = $variantValues2 = $variantValues3 = array();
                $i = 0;
                foreach($variants as $variantId => $variantValues){
                    $i++;
                    if($i == 1){
                        $variantId1 = $variantId;
                        $variantValues1 = $variantValues;
                    }
                    elseif($i == 2){
                        $variantId2 = $variantId;
                        $variantValues2 = $variantValues;
                    }
                    elseif($i == 3){
                        $variantId3 = $variantId;
                        $variantValues3 = $variantValues;
                    }
                }
                $variantCount = count($variants);
                foreach($variantOptions as $variantOption){
                    $variantValues = explode('-', $variantOption['VariantValue']);
                    $variantOption['ProductName'] = $variantOption['VariantValue'];
                    $variantOption['ProductImage'] = replaceFileUrl($variantOption['ProductImage']);
                    unset($variantOption['VariantValue']);
                    $variantOption['VATStatusId'] = $postData['VATStatusId'];
                    if(count($variantValues) == $variantCount){
                        $i = 0;
                        foreach($variantValues as $variantValue){
                            $variantValue = trim($variantValue);
                            $i++;
                            if($i == 1){
                                $variantOption['VariantValue1']  = $variantValue;
                                if(in_array($variantValue, $variantValues1)) $variantOption['VariantId1'] = $variantId1;
                                elseif(in_array($variantValue, $variantValues2)) $variantOption['VariantId1'] = $variantId2;
                                elseif(in_array($variantValue, $variantValues3)) $variantOption['VariantId1'] = $variantId3;
                            }
                            elseif($i == 2){
                                $variantOption['VariantValue2']  = $variantValue;
                                if(in_array($variantValue, $variantValues1)) $variantOption['VariantId2'] = $variantId1;
                                elseif(in_array($variantValue, $variantValues2)) $variantOption['VariantId2'] = $variantId2;
                                elseif(in_array($variantValue, $variantValues3)) $variantOption['VariantId2'] = $variantId3;
                            }
                            elseif($i == 3){
                                $variantOption['VariantValue3']  = $variantValue;
                                if(in_array($variantValue, $variantValues1)) $variantOption['VariantId3'] = $variantId1;
                                elseif(in_array($variantValue, $variantValues2)) $variantOption['VariantId3'] = $variantId2;
                                elseif(in_array($variantValue, $variantValues3)) $variantOption['VariantId3'] = $variantId3;
                            }
                        }
                    }
                    $productChilds[] = $variantOption;
                }
            }
            elseif($postData['ProductKindId'] == 3) $productChilds = json_decode(trim($this->input->post('VariantOptions')), true);
            $this->load->model('Mproducts');
            $productId = $this->Mproducts->update($postData, $productId, $images, $productSEO, $cateIds1, $cateIds2, $tagNames, $productChilds);
            if($productId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật sản phẩm thành công", 'data' => $productId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function get(){
        $user = $this->session->userdata('user');
        if($user) {
            $ids = explode('-', $this->input->post('ids'));
            $count = count($ids);
            if ($count == 1) {
                $productId = intval($ids[0]);
                if ($productId > 0) {
                    $this->loadModel(array('Mproducts', 'Mproductchilds'));
                    $product = $this->Mproducts->get($productId);
                    if ($product) {
                        $listProductChilds = array();
                        if ($product['ProductKindId'] == 2) $listProductChilds = $this->Mproductchilds->getBy(array('ProductId' => $product['ProductId']));
                        echo json_encode(array('code' => 1, 'data' => array('Product' => $product, 'ProductChild' => $listProductChilds, 'TypeId' => 1)));
                    }
                    else echo json_encode(array('code' => 0, 'message' => "Không tìm thấy sản phẩm"));
                }
                else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            elseif ($count == 2) {
                $productId = intval($ids[0]);
                $productChildId = intval($ids[1]);
                if ($productId > 0 && $productChildId > 0) {
                    $this->loadModel(array('Mproducts', 'Mproductchilds'));
                    $product = $this->Mproducts->get($productId);
                    $productChild = $this->Mproductchilds->get($productChildId);
                    if ($product && $productChild) echo json_encode(array('code' => 1, 'data' => array('Product' => $product, 'ProductChild' => $productChild), 'TypeId' => 2));
                    else echo json_encode(array('code' => 0, 'message' => "Không tìm thấy sản phẩm"));
                } else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function getList(){
        $user = $this->session->userdata('user');
        if($user) {
            $pageId = trim($this->input->post('PageId'));
            $limit = trim($this->input->post('Limit'));
            if ($pageId > 0 && $limit > 0) {
                $postData = $this->arrayFromPost(array('SearchText', 'CategoryId'));
                $this->loadModel(array('Mproducts', 'Mproductchilds'));
                $data = array();
                $listProducts = $this->Mproducts->search($postData, $limit, $pageId);
                foreach ($listProducts as $p) {
                    if ($p['ProductKindId'] == 2) $listProductChilds = $this->Mproductchilds->getBy(array('ProductId' => $p['ProductId']));
                    else $listProductChilds = array();
                    $p['Childs'] = $listProductChilds;
                    $data[] = $p;
                }
                echo json_encode(array('code' => 1, 'data' => $data));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function updateInventory(){
        $user = $this->session->userdata('user');
        if($user){
            $postData = $this->arrayFromPost(array('ProductId', 'ProductChildId', 'Quantity', 'InventoryTypeId', 'StoreId', 'StatusId', 'Comment'));
            $postData['Quantity'] = replacePrice($postData['Quantity']);
            $inventoryId = $this->input->post('InventoryId');
            if($inventoryId > 0){
                $postData['UpdateUserId'] = $user['UserId'];
                $postData['UpdateDateTime'] = getCurentDateTime();
            }
            else{
                $postData['CrUserId'] = $user['UserId'];
                $postData['CrDateTime'] = getCurentDateTime();
            }
            $this->load->model('Minventories');
            $inventoryId = $this->Minventories->update($postData, $inventoryId);
            if($inventoryId > 0) echo json_encode(array('code' => 1, 'message' => 'Cập nhật tồn kho thành công', 'data' => $inventoryId));
            else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function getCurentQuantity(){
        $retVal = 0;
        $user = $this->session->userdata('user');
        $postData = $this->arrayFromPost(array('ProductId', 'ProductChildId', 'StoreId'));
        if($user && $postData['ProductId'] > 0 && $postData['ProductChildId'] >= 0 && $postData['StoreId'] > 0){
            $this->load->model('Mproductquantity');
            $postData['IsLast'] = 1;
            $retVal = $this->Mproductquantity->getFieldValue($postData, 'Quantity', 0);
        }
        echo $retVal;
    }

    //mobile
    public function getInfo(){
        header('Content-Type: application/json');
        $barCode = trim($this->input->post('BarCode'));
        if(!empty($barCode)){
            $this->loadModel(array('Mproducts', 'Mproductchilds'));
            $flag = false;
            $productChild = $this->Mproductchilds->getBy(array('BarCode' => $barCode), true);
            if($productChild){
                $flag = true;
                $product = $this->Mproducts->get($productChild['ProductId']);
                $data = array(
                    'ProductName' => $product['ProductName'].' ('.$productChild['ProductName'].')',
                    'BarCode' => $barCode,
                    'Quantity' => $productChild['Quantity'],
                    'message' => 'Lấy thông tin sản phẩm thành công'
                );
                echo json_encode(array('code' => 1, 'message' => "Lấy thông tin sản phẩm thành công", 'data' => $data));
            }
            else{
                $product = $this->Mproducts->getBy(array('BarCode' => $barCode), true);
                if($product){
                    $flag = true;
                    $data = array(
                        'ProductName' => $product['ProductName'],
                        'BarCode' => $barCode,
                        'Quantity' => $product['Quantity'],
                        'message' => 'Lấy thông tin sản phẩm thành công'
                    );
                    echo json_encode(array('code' => 1, 'message' => "Lấy thông tin sản phẩm thành công", 'data' => $data));
                }
            }
            if(!$flag) echo json_encode(array('code' => 0, 'message' => "Sản phẩm không tồn tại"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Mã vạch không được bỏ trống"));
    }

    public function warehouse(){ // Nhap kho - Kiem kho
        header('Content-Type: application/json');
        $userId = trim($this->input->post('UserId'));
        $scanName = trim($this->input->post('Name'));
        $scanTypeId = trim($this->input->post('ScanTypeId'));
        $storeId = trim($this->input->post('StoreId'));
        $createdDate = trim($this->input->post('CreatedDate'));
        $products = json_decode(trim($this->input->post('Products')), true);
        if($userId > 0 && $storeId > 0 && !empty($scanName) && $scanTypeId > 0 && !empty($products)){
            $crDateTime = getCurentDateTime();
            if(!empty($createdDate)) $createdDate = ddMMyyyyToDate($createdDate, 'd/m/Y H:i:s', 'Y-m-d H:i:s');
            else $createdDate = $crDateTime;
            $postData = array(
                'ScanName' => $scanName,
                'ScanTypeId' => $scanTypeId,
                'ItemId' => 0,
                'StoreId' => $storeId,
                'ScanDateTime' => $createdDate,
                'CrUserId' => $userId,
                'CrDateTime' => getCurentDateTime()
            );
            $this->load->model('Mscanbarcodes');
            $scanBarCodeId = $this->Mscanbarcodes->update($postData, 0, $products);
            if($scanBarCodeId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật dữ liệu thành công"));
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function genBarCodePackage(){
        header('Content-Type: application/json');
        $barCode = trim($this->input->post('BarCode'));
        $packageCount = trim($this->input->post('PackageCount'));
        if(!empty($barCode) && $packageCount > 0){
            $packageCodes = array();
            if($packageCount == 1) $packageCodes[] = $barCode;
            else{
                for($i = 1; $i <= $packageCount; $i++) $packageCodes[] = $barCode.'_'.$i;
            }
            echo json_encode(array('code' => 1, 'message' => "Sinh mã kiện thành công", 'data' => array('BarCode' => $barCode, 'PackageCodes' => implode(',', $packageCodes))));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }
}