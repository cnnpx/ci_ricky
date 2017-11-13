<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><button class="btn btn-primary submit">Lưu</button></li>
                    <li><a href="<?php echo base_url('promotion'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <style>
                    #tblCost i{cursor: pointer;}
                </style>
                <?php echo form_open('promotion/update', array('id' => 'promotionForm')); ?>
                <div class="row">
                    <div class="col-sm-8 no-padding">
                        <div class="box box-default padding15">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label normal" style="width: 100%;" id="lbPromotionName">Mã khuyến mãi <span class="required">*</span><a href="javascript:void(0)" id="aGenPromotionName" class="pull-right">Tạo mã tự động</a></label>
                                    <input type="text" class="form-control hmdrequired" id="promotionName" value="" data-field="Mã khuyến mãi">
                                </div>
                            </div>
                        </div>
                        <div class="box box-default padding15" style="margin-top: -20px;">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label normal">Chọn chương trình khuyến mãi</label>
                                            <?php $this->Mconstants->selectConstants('promotionTypes', 'PromotionTypeId'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 divPromotionTypeId divPromotionTypeId_1">
                                        <div class="form-group">
                                            <label class="control-label normal">Số lần sử dụng của mã khuyến mãi</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control cost" id="numberUse" value="∞" disabled style="width: 100px;">
                                                <span class="input-group-addon" style="float: left;border: none;">
                                                    <span class="item"><input type="checkbox" id="cbUnlimit" class="iCheck" checked> Không giới hạn</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group divPromotionTypeId divPromotionTypeId_1">
                                    <span class="item"><input type="checkbox" id="cbIsSharePromotion" class="iCheck"> Cho phép sử dụng chung với chương trình khuyến mãi</span>
                                </div>
                            </div>
                        </div>
                        <div class="box box-default padding15" style="margin-top: -20px;">
                            <div class="box-header">
                                <h3 class="box-title">Loại khuyến mại</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label normal">Loại giảm</label>
                                            <?php $this->Mconstants->selectConstants('reduceTypes', 'ReduceTypeId'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label normal" id="lbReduceNumber">Giá trị giảm</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control cost" id="reduceNumber" value="0">
                                                <span class="input-group-addon" id="spanCurrency">VNĐ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label normal">Áp dụng cho</label>
                                            <select class="form-control" id="promotionItemTypeId">
                                                <option value="0" class="promotionItemId_1">Tất cả đơn hàng</option>
                                                <option value="6" class="promotionItemId_1">Trị giá đơn hàng từ</option>
                                                <option value="1">Nhóm sản phẩm</option>
                                                <option value="3">Sản phẩm</option>
                                                <option value="11" class="promotionItemId_1">Nhóm khách hàng</option>
                                                <option value="5" class="promotionItemId_1">Khách hàng</option>
                                            </select>
                                            <?php $this->Mconstants->selectObject($listProvinces, 'ProvinceId', 'ProvinceName', 'ProvinceId', 0, true, 'Tất cả tỉnh thành', '', ' style="display: none;"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 divPromotionItemTypeId divPromotionItemTypeId_6" style="display: none;">
                                        <div class="input-group">
                                            <input type="text" class="form-control cost" id="minimumCost" value="0">
                                            <span class="input-group-addon">VNĐ</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 divPromotionItemTypeId divPromotionItemTypeId_1 divPromotionItemTypeId_11" style="display: none;">
                                        <div class="form-group">
                                            <select class="form-control" id="promotionItemId">
                                                <option value="0">Chọn</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 divPromotionItemTypeId divPromotionItemTypeId_5" style="display: none;">
                                        <div class="box-search-advance customer">
                                            <div>
                                                <input type="text" class="form-control textbox-advancesearch" id="txtSearchCustomer" placeholder="Tìm khách hàng">
                                            </div>
                                            <div class="panel panel-default" id="panelCustomer">
                                                <div class="panel-body">
                                                    <div class="list-search-data">
                                                        <div class="search-loading" style="display: none;">Đang tìm kiếm...</div>
                                                        <ul id="ulListCustomers"></ul>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                    <div class="btn-group pull-right">
                                                        <button type="button" class="btn btn-default" id="btnPrevCustomer"><i class="fa fa-chevron-left"></i></button>
                                                        <button type="button" class="btn btn-default" id="btnNextCustomer"><i class="fa fa-chevron-right"></i></button>
                                                        <input type="text" hidden="hidden" id="pageIdCustomer" value="1">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 divPromotionItemTypeId divPromotionItemTypeId_3" style="display: none;margin-bottom: 15px;">
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
                                    <div class="col-sm-4 divPromotionItemTypeId divPromotionItemTypeId_3 divPromotionItemTypeId_5" style="display: none;">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="itemName" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 divPromotionItemTypeId divPromotionItemTypeId_1 divPromotionItemTypeId_3" style="display: none;">
                                        <?php $this->Mconstants->selectConstants('discountTypes', 'DiscountTypeId', 1); ?>
                                    </div>
                                    <div class="col-sm-4 divPromotionTypeId divPromotionTypeId_2" style="display: none;">
                                        <div class="form-group">
                                            <label class="control-label normal">Số lượng sản phẩm áp dụng</label>
                                            <input type="text" class="form-control cost" id="productNumber" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box box-default padding15">
                            <div class="box-header">
                                <h3 class="box-title">Thời gian áp dụng</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label normal">Bắt đầu khuyến mãi <span class="required">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control datepicker hmdrequired" id="beginDate" value="<?php echo date('d/m/Y'); ?>" autocomplete="off" data-field="Bắt đầu khuyến mãi">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label normal">Hết hạn khuyến mãi</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control datepicker" id="endDate" value="" disabled autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="item"><input type="checkbox" id="cbEndDate" class="iCheck" checked> Không bao giờ hết hạn</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li>
                    <li><a href="<?php echo base_url('promotion'); ?>" id="promotionListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="getListCustomerUrl" value="<?php echo base_url('api/customer/getList'); ?>">
                    <input type="text" hidden="hidden" id="getListProductUrl" value="<?php echo base_url('api/product/getList'); ?>">
                    <?php $this->Mconstants->selectObject($listCustomerGroups, 'CustomerGroupId', 'CustomerGroupName', 'CustomerGroupId', 0, true, '-Tất cả nhóm khách hàng-', '', ' style="display: none;"'); ?>
                    <?php $this->Mconstants->selectObject($listCategories, 'CategoryId', 'CategoryName', 'CategoryIdHidden', 0, true, '-Tất cả nhóm sản phẩm-', '', ' style="display: none;"'); ?>
                    <input type="text" hidden="hidden" id="promotionId" value="0">
                    <input type="text" hidden="hidden" id="promotionStatusId" value="3">
                    <input type="text" hidden="hidden" id="customerId" value="0">
                    <input type="text" hidden="hidden" id="productId" value="0">
                    <input type="text" hidden="hidden" id="productChildId" value="0">
                </ul>
                <?php echo form_close(); ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>