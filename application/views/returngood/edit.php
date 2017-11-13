<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <?php if($canEdit){ ?><li><button class="btn btn-primary submit">Lưu</button></li><?php } ?>
                    <li><a href="<?php echo base_url('returngood'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php $this->load->view('includes/notice'); ?>
                <?php if($returnGoodId > 0){ ?>
                <?php echo form_open('api/returngood/update', array('id' => 'returnGoodForm')); ?>
                <div class="row">
                    <div class="col-sm-8 no-padding">
                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Chi tiết Đơn hàng</h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive no-padding divTable">
                                    <table class="table table-hover table-bordered">
                                        <thead class="theadNormal">
                                        <tr>
                                            <th style="width: 100px;">Ảnh</th>
                                            <th>Sản phẩm</th>
                                            <th style="width: 100px;">Số lượng</th>
                                            <th style="width: 100px;">Đơn giá</th>
                                            <th style="width: 100px;">Tổng tiền</th>
                                            <th style="width: 5px;"></th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbodyProduct">
                                        <?php $products = array();
                                        $productChilds = array();
                                        foreach($listReturnGoodProducts as $rgp){
                                            if(!isset($products[$rgp['ProductId']])) $products[$rgp['ProductId']] = $this->Mproducts->get($rgp['ProductId'], true, '', 'ProductName, ProductImage, Price');
                                            $productName = $products[$rgp['ProductId']]['ProductName'];
                                            $productImage = $products[$rgp['ProductId']]['ProductImage'];
                                            $price = $products[$rgp['ProductId']]['Price'];
                                            if($rgp['ProductChildId'] > 0){
                                                if(!isset($productChilds[$rgp['ProductChildId']])) $productChilds[$rgp['ProductChildId']] = $this->Mproductchilds->get($rgp['ProductChildId'], true, '', 'ProductName, ProductImage, Price');
                                                $productName .= '<br/>(' . $productChilds[$rgp['ProductChildId']]['ProductName'] .')';
                                                $productImage = $productChilds[$rgp['ProductChildId']]['ProductImage'];
                                                $price = $productChilds[$rgp['ProductChildId']]['Price'];
                                            } ?>
                                            <tr data-id="<?php echo $rgp['ProductId']; ?>" data-child="<?php echo $rgp['ProductChildId']; ?>">
                                                <td><img src="<?php echo $productImage; ?>" class="productImg"></td>
                                                <td><?php echo $productName; ?></td>
                                                <td><input class="form-control quantity" value="<?php echo priceFormat($rgp['Quantity']); ?>"></td>
                                                <td class="tdPrice"><span class="spanPrice"><?php echo priceFormat($price); ?></span></td>
                                                <td><input class="form-control sumPrice" disabled value="<?php echo priceFormat($rgp['Quantity'] * $price); ?>"></td>
                                                <td><a href="javascript:void(0)" class="link_delete"><i class="fa fa-times" title="Xóa"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if($canEdit){ ?>
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
                                <?php } ?>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Ghi chú đơn hàng</label>
                                            <textarea class="form-control" rows="3" id="comment"><?php echo $returnGood['Comment']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Nhãn (cách nhau bởi dấu phẩy)</label>
                                            <input type="text" class="form-control" id="tags">
                                        </div>
                                    </div>
                                </div>
                                <?php $this->load->view('includes/action_logs'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Thông tin khách hàng</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label">Họ tên <span class="required">*</span></label>
                                    <input type="text" class="form-control hmdrequired" id="customerName" value="<?php echo $customerAddress ? $customerAddress['CustomerName'] : ''; ?>" data-field="Họ Tên">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" class="form-control" id="customerEmail" value="<?php echo $customerAddress ? $customerAddress['Email'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Số điện thoại <span class="required">*</span></label>
                                    <input type="text" class="form-control hmdrequired" id="customerPhone" value="<?php echo $customerAddress ? $customerAddress['PhoneNumber'] : ''; ?>" data-field="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Địa chỉ <span class="required">*</span></label>
                                    <input type="text" class="form-control hmdrequired" id="customerAddress" value="<?php echo $customerAddress ? $customerAddress['Address'] : ''; ?>" data-field="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tỉnh/ Thành phố</label>
                                    <?php $this->Mconstants->selectObject($listProvinces, 'ProvinceId', 'ProvinceName', 'ProvinceId', $customerAddress ? $customerAddress['ProvinceId'] : 0, false, '', ' select2'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Quận huyện</label>
                                    <?php echo $this->Mdistricts->selectHtml($customerAddress ? $customerAddress['DistrictId'] : 0); ?>
                                </div>
                            </div>
                        </div>
                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Phân loại</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label">Trạng thái</label>
                                    <?php $this->Mconstants->selectConstants('transportStatus', 'TransportStatusId', $returnGood['TransportStatusId']); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Cơ sở nhập hàng</label>
                                    <?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreId', $returnGood['StoreId'], false, '', ' select2'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Phân loại</label>
                                    <div class="radio-group">
                                        <span class="item"><input type="radio" name="ReturnGoodTypeId" class="iCheckRadio" value="1"<?php if($returnGood['ReturnGoodTypeId'] == 1) echo ' checked'; ?>> Hoàn đơn bưu điện</span><br/>
                                        <span class="item"><input type="radio" name="ReturnGoodTypeId" class="iCheckRadio" value="2"<?php if($returnGood['ReturnGoodTypeId'] == 2) echo ' checked'; ?>> Hoàn đơn ngoại thành</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <?php if($canEdit){ ?><li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li><?php } ?>
                    <li><a href="<?php echo base_url('returngood'); ?>" id="returnGoodListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="getProductDetailUrl" value="<?php echo base_url('api/product/get'); ?>">
                    <input type="text" hidden="hidden" id="getCustomerDetailUrl" value="<?php echo base_url('api/customer/get'); ?>">
                    <input type="text" hidden="hidden" id="getListCustomerUrl" value="<?php echo base_url('api/customer/getList'); ?>">
                    <input type="text" hidden="hidden" id="getListProductUrl" value="<?php echo base_url('api/product/getList'); ?>">
                    <input type="text" hidden="hidden" id="returnGoodId" value="<?php  echo $returnGoodId;?>">
                    <input type="text" hidden="hidden" id="customerId" value="<?php echo $returnGood['CustomerId']; ?>">
                    <input type="text" hidden="hidden" id="canEdit" value="<?php echo $canEdit; ?>">
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