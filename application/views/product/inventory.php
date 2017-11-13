<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('product/activeInventory'); ?>" class="btn btn-default">Duyệt tồn kho</a></li>
                </ul>
            </section>
            <section class="content">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="ulFilter">
                        <li class="active"><a href="#tab_0" data-id="0" data-toggle="tab" aria-expanded="true">Tất cả sản phẩm</a></li>
                        <?php foreach($listFilters as $f){ ?>
                            <li><a href="#tab_<?php echo $f['FilterId'] ?>" data-id="<?php echo $f['FilterId'] ?>" data-toggle="tab" aria-expanded="false"><?php echo $f['FilterName']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="input-group margin ctrl-filter">
                    <div class="input-group-btn dropdown" id="searchGroup">
                        <button type="button" class="btn btn-success dropdown-toggle transform" data-toggle="dropdown" aria-expanded="false">
                            Điều kiện lọc <span class="fa fa-caret-down"></span>
                        </button>
                    </div>
                    <input type="text" class="form-control" id="itemSearchName">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-flat">Lưu bộ lọc</button>
                    </span>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-flat"><i class="fa fa-times"></i></button>
                    </span>
                </div>
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
                                <th>Cập nhật tồn kho</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyProduct">
                            <?php foreach($listProduct as $p){ ?>
                                <tr id="trItem_<?php echo $p['ProductId']; ?>_0">
                                    <td><a href="<?php echo base_url('product/edit/'.$p['ProductId']); ?>"><?php echo $p['ProductName']; ?></td>
                                    <td><?php echo $p['BarCode'];?></td>
                                    <td><?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreId_'.$p['ProductId'].'_0', 0, true, '-Chọn cơ sở-', ' storeId', ' data-product="'.$p['ProductId'].'" data-child="0"'); ?></td>
                                    <td class="tdQuantity" data-product="<?php echo $p['ProductId']; ?>" data-child="0">0</td>
                                    <td><input class="form-control" id="comment_<?php echo $p['ProductId']; ?>_0" value=""></td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-flat" data-id="1">Cộng thêm</button>
                                                <button type="button" class="btn btn-default btn-flat" data-id="2">Set</button>
                                            </div>
                                            <input type="text" class="form-control quantity" id="quantity_<?php echo $p['ProductId']; ?>_0" value="0">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-info btnUpdateQuantity" data-product="<?php echo $p['ProductId']; ?>" data-child="0">Lưu</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <?php if($p['ProductKindId'] == 2){
                                    $listProductChilds = $this->Mproductchilds->getBy(array('ProductId' => $p['ProductId']));
                                    foreach($listProductChilds as $pc){ ?>
                                        <tr id="trItem_<?php echo $p['ProductId']; ?>_<?php echo $pc['ProductChildId']; ?>">
                                            <td><a href="<?php echo base_url('product/edit/'.$p['ProductId']); ?>"><?php echo $p['ProductName'].' ('.$pc['ProductName'].')'; ?></td>
                                            <td><?php echo $pc['BarCode'];?></td>
                                            <td><?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreId_'.$p['ProductId'].'_'.$pc['ProductChildId'], 0, true, '-Chọn cơ sở-', ' storeId', ' data-product="'.$p['ProductId'].'" data-child="'.$pc['ProductChildId'].'"'); ?></td>
                                            <td class="tdQuantity" data-product="<?php echo $p['ProductId']; ?>" data-child="<?php echo $pc['ProductChildId']; ?>">0</td>
                                            <td><input class="form-control" id="comment_<?php echo $p['ProductId']; ?>_<?php echo $pc['ProductChildId']; ?>" value=""></td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-default btn-flat" data-id="1">Cộng thêm</button>
                                                        <button type="button" class="btn btn-default btn-flat" data-id="2">Set</button>
                                                    </div>
                                                    <input type="text" class="form-control quantity" id="quantity_<?php echo $p['ProductId']; ?>_<?php echo $pc['ProductChildId']; ?>" value="0">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btnUpdateQuantity" data-product="<?php echo $p['ProductId']; ?>" data-child="<?php echo $pc['ProductChildId']; ?>">Lưu</button>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="itemTypeId" value="15">
                    <input type="text" hidden="hidden" id="getCurentQuantityUrl" value="<?php echo base_url('api/product/getCurentQuantity'); ?>">
                    <input type="text" hidden="hidden" id="updateInventoryUrl" value="<?php echo base_url('api/product/updateInventory'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>