<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <?php if($canCancle){ ?><li><button class="btn btn-primary submit">Lưu</button></li><?php } ?>
                    <li><a href="<?php echo base_url('import'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php $this->load->view('includes/notice'); ?>
                <?php if($importId > 0){ ?>
                    <?php echo form_open('import/update', array('id' => 'importForm')); ?>
                    <div class="row">
                        <div class="col-sm-8 no-padding">
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Sảm phẩm mới</h3>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive no-padding divTable">
                                        <table class="table table-hover table-bordered">
                                            <thead class="theadNormal">
                                            <tr>
                                                <th style="width: 100px;">Ảnh</th>
                                                <th>Sản phẩm</th>
                                                <th style="width: 150px;">Mã sản phẩm</th>
                                                <th style="width: 150px;">Số lượng</th>
                                                <th style="width: 5px;"></th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbodyProduct">
                                            <?php
                                                $products = array();
                                                $productChilds = array();
                                                foreach ($listImportProduct as $ip){
                                                    if(!isset($products[$ip['ProductId']]))
                                                        $products[$ip['ProductId']] = $this->Mproducts->get($ip['ProductId'], true, '', 'ProductName, ProductImage, ProductCode');
                                                    $productName = $products[$ip['ProductId']]['ProductName'];
                                                    $productImage = $products[$ip['ProductId']]['ProductImage'];
                                                    $code = $products[$ip['ProductId']]['ProductCode'];
                                                    if($ip['ProductChildId'] > 0){
                                                        if(!isset($productChilds[$ip['ProductChildId']])) $productChilds[$ip['ProductChildId']] = $this->Mproductchilds->get($ip['ProductChildId'], true, '', 'ProductName, ProductImage, Price');
                                                        $productName .= '<br/>(' . $productChilds[$ip['ProductChildId']]['ProductName'] .')';
                                                        $productImage = $productChilds[$ip['ProductChildId']]['ProductImage'];
                                                        $code = $productChilds[$ip['ProductChildId']]['Price'];
                                                    } ?>
                                                    <tr data-id="<?php echo $ip['ProductId']; ?>" data-child="<?php echo $ip['ProductChildId']; ?>">
                                                        <td><img src="<?php echo $productImage; ?>" class="productImg"></td>
                                                        <td><?php echo $productName; ?></td>
                                                        <td><?php echo $code; ?></td>
                                                        <td><input class="form-control quantity" value="<?php echo priceFormat($ip['Quantity']); ?>"></td>
                                                        <td><a href="javascript:void(0)" class="link_delete"><i class="fa fa-times" title="Xóa"></i></a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="border-top-title-main">
                                        <div class="clearfix">
                                            <div class="box-search-advance product">
                                                <div>
                                                    <input type="text" class="form-control textbox-advancesearch" id="txtSearchProduct" placeholder="Tìm kiếm sản phẩm">
                                                </div>
                                                <div class="panel panel-default" id="panelProduct">
                                                    <div class="panel-body" style="width:100%;">
                                                        <div class="list-search-data">
                                                            <div class="search-loading" style="display: none;">Đang tìm kiếm...</div>
                                                            <div>
                                                                <div class="form-group pull-right" style="width: 300px;">
                                                                    <?php $this->Mconstants->selectObject($listCategories, 'CategoryId', 'CategoryName', 'CategoryId', 0, true, 'Nhóm sản phẩm', ' select2'); ?>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="table-responsive no-padding divTable">
                                                                <table class="table table-hover table-bordered">
                                                                    <thead class="theadNormal">
                                                                    <tr>
                                                                        <th style="width: 100px;">Ảnh</th>
                                                                        <th>Sản phẩm</th>
                                                                        <th style="width: 100px;">Mã sản phẩm</th>
                                                                        <th style="width: 100px;">Giá bán</th>
                                                                        <th style="width: 100px;">Bảo hành</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="tbodyProductSearch"></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        <div class="btn-group pull-right">
                                                            <button type="button" class="btn btn-default" id="btnPrevProduct"><i class="fa fa-chevron-left"></i></button>
                                                            <button type="button" class="btn btn-default" id="btnNextProduct"><i class="fa fa-chevron-right"></i></button>
                                                            <input type="text" hidden="hidden" id="pageIdProduct" value="1">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Ghi chú phiếu nhập kho</label>
                                                <textarea class="form-control" rows="2" id="comment"><?php echo $import['Comment']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Nhãn (cách nhau bởi dấu phẩy)</label>
                                                <input type="text" class="form-control" id="tags">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $this->load->view('includes/action_logs'); ?>
                        </div>

                        <div class="col-sm-4">
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Nhà cung cấp</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php $this->Mconstants->selectObject($listSuppliers, 'SupplierId', 'SupplierName', 'SupplierId',  $import['SupplierId'], false, '', ' select2'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Người giao hàng</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label">Họ tên <span class="required">*</span></label>
                                        <input type="text" class="form-control hmdrequired" id="deliverName" value="<?php echo $import['DeliverName']; ?>" data-field="Họ Tên">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Số điện thoại <span class="required">*</span></label>
                                        <input type="text" class="form-control hmdrequired" id="deliverPhone" value="<?php echo $import['DeliverPhone']; ?>" data-field="Số điện thoại">
                                    </div>
                                </div>
                            </div>
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Cơ sở nhập</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreId',  $import['StoreId'], false, '', ' select2'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Trạng thái</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php $this->Mconstants->selectConstants('status', 'StatusId', $import['StatusId']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-inline pull-right" style="margin-right: 10px;">
                        <?php if($canCancle){ ?><li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li><?php } ?>
                        <li><a href="<?php echo base_url('import'); ?>" id="importListUrl" class="btn btn-default">Hủy</a></li>
                        <input type="text" hidden="hidden" id="getProductDetailUrl" value="<?php echo base_url('api/product/get'); ?>">
                        <input type="text" hidden="hidden" id="getCustomerDetailUrl" value="<?php echo base_url('api/customer/get'); ?>">
                        <input type="text" hidden="hidden" id="getListCustomerUrl" value="<?php echo base_url('api/customer/getList'); ?>">
                        <input type="text" hidden="hidden" id="getListProductUrl" value="<?php echo base_url('api/product/getList'); ?>">
                        <input type="text" hidden="hidden" id="importId" value="<?php echo $importId; ?>">
                        <input type="text" hidden="hidden" id="importCode" value="<?php echo $import['ImportCode']; ?>">
                        <?php foreach($tagNames as $tagName){ ?>
                            <input type="text" hidden="hidden" class="tagName" value="<?php echo $tagName; ?>">
                        <?php } ?>
                    </ul>
                    <?php echo form_close(); ?>
                <?php } ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>