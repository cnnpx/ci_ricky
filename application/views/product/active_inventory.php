<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
            </section>
            <section class="content">
                <div class="box box-success">
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Barcode</th>
                                <th>Cơ sở</th>
                                <th>Số lượng</th>
                                <th>Ghi chú</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tbodyInventory">
                            <?php $products = array();
                            $productChilds = array();
                            foreach($listInventoríes as $p){
                                if(!isset($products[$p['ProductId']])) $products[$p['ProductId']] = $this->Mproducts->get($p['ProductId'], true, '', 'ProductName, BarCode');
                                if($p['ProductChildId'] > 0 && !isset($productChilds[$p['ProductChildId']])) $productChilds[$p['ProductChildId']] = $this->Mproductchilds->get($p['ProductChildId'], true, '', 'ProductName, BarCode'); ?>
                                <tr id="trItem_<?php echo $p['ProductId']; ?>_<?php echo $p['ProductChildId']; ?>">
                                    <td><a href="<?php echo base_url('product/edit/'.$p['ProductId']); ?>">
                                        <?php if($p['ProductChildId'] > 0) echo $products[$p['ProductId']]['ProductName'] . ' (' . $productChilds[$p['ProductChildId']]['ProductName'] . ')';
                                        else echo $products[$p['ProductId']]['ProductName']; ?>
                                    </td>
                                    <td>
                                        <?php if($p['ProductChildId'] > 0) echo $productChilds[$p['ProductChildId']]['BarCode'];
                                        else echo $products[$p['ProductId']]['BarCode']; ?>
                                    </td>
                                    <td><?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreId_'.$p['ProductId'].'_'.$p['ProductChildId'], $p['StoreId'], false, '', ' storeId', ' data-product="'.$p['ProductId'].'" data-child="'.$p['ProductChildId'].'"'); ?></td>
                                    <td class="tdQuantity" data-product="<?php echo $p['ProductId']; ?>" data-child="<?php echo $p['ProductChildId']; ?>">0</td>
                                    <td><input class="form-control" id="comment_<?php echo $p['ProductId']; ?>_<?php echo $p['ProductChildId']; ?>" value="<?php echo $p['Comment']; ?>"></td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-flat <?php echo $p['InventoryTypeId'] == 1 ? 'btn-primary' : 'btn-default'; ?>" data-id="1">Cộng thêm</button>
                                                <button type="button" class="btn btn-flat <?php echo $p['InventoryTypeId'] == 2 ? 'btn-primary' : 'btn-default'; ?>" data-id="2">Set</button>
                                            </div>
                                            <input type="text" class="form-control quantity" id="quantity_<?php echo $p['ProductId']; ?>_<?php echo $p['ProductChildId']; ?>" value="<?php echo priceFormat($p['Quantity']); ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="list-inline">
                                            <li><button type="button" class="btn btn-sm btn-info btnUpdateQuantity" data-id="<?php echo $p['InventoryId']; ?>" data-status="2" data-product="<?php echo $p['ProductId']; ?>" data-child="<?php echo $p['ProductChildId']; ?>">Duyệt</button></li>
                                            <li><button type="button" class="btn btn-sm btn-danger btnUpdateQuantity" data-id="<?php echo $p['InventoryId']; ?>" data-status="3" data-product="<?php echo $p['ProductId']; ?>" data-child="<?php echo $p['ProductChildId']; ?>">Không duyệt</button></li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="getCurentQuantityUrl" value="<?php echo base_url('api/product/getCurentQuantity'); ?>">
                    <input type="text" hidden="hidden" id="updateInventoryUrl" value="<?php echo base_url('api/product/updateInventory'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>