<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><button class="btn btn-primary submit">Lưu</button></li>
                    <li><a href="<?php echo base_url('storecirculation'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php echo form_open('api/storecirculation/update', array('id' => 'storeCirculationForm')); ?>
                <div class="row">
                    <div class="col-sm-8 no-padding">
                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Danh sách Sản phẩm</h3>
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
                                        <tbody id="tbodyProduct"></tbody>
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
                                            <label class="control-label">Ghi chú đơn hàng</label>
                                            <textarea class="form-control" rows="2" id="comment"></textarea>
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
                    </div>
                    <div class="col-sm-4">
                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Cơ sở</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label">Cơ sở xuất hàng</label>
                                    <?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreSourceId', 0, true, '--Chọn cơ sở--', ' select2'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Cơ sở nhập hàng</label>
                                    <?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreDestinationId', 0, true, '--Chọn cơ sở--', ' select2'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Cách thức giao hàng</label>
                                    <div class="radio-group">
                                        <span class="item"><input type="radio" name="DeliveryTypeId" class="iCheckRadio" value="1" checked> POS</span>
                                        <span class="item"><input type="radio" name="DeliveryTypeId" class="iCheckRadio" value="2"> Từ xa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li>
                    <li><a href="<?php echo base_url('storecirculation'); ?>" id="storeCirculationListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="getProductDetailUrl" value="<?php echo base_url('api/product/get'); ?>">
                    <input type="text" hidden="hidden" id="getListProductUrl" value="<?php echo base_url('api/product/getList'); ?>">
                    <input type="text" hidden="hidden" id="orderStatusId" value="3">
                    <input type="text" hidden="hidden" id="statusId" value="1">
                    <input type="text" hidden="hidden" id="storeCirculationCode" value="">
                    <input type="text" hidden="hidden" id="cancelReason" value="">
                    <input type="text" hidden="hidden" id="handleDate" value="">
                    <input type="text" hidden="hidden" id="storeCirculationId" value="0">
                </ul>
                <?php echo form_close(); ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>