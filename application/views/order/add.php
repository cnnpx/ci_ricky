<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><button class="btn btn-primary submit">Lưu</button></li>
                    <li><a href="<?php echo base_url('order'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <style>
                    #tblCost i{cursor: pointer;}
                </style>
                <?php echo form_open('api/order/update', array('id' => 'orderForm')); ?>
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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Ghi chú đơn hàng</label>
                                            <textarea class="form-control" rows="3" id="comment"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Nhãn (cách nhau bởi dấu phẩy)</label>
                                            <input type="text" class="form-control" id="tags">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <table class="table table-bordered no-padding" id="tblCost" style="margin-bottom: 10px;">
                                            <tbody>
                                            <tr>
                                                <td class="first" colspan="2">Tổng tiền sản phẩm</td>
                                                <td><input type="text" value="0" class="form-control" id="sumCost" disabled></td>
                                            </tr>
                                            <tr>
                                                <td class="first" colspan="2">Phí vận chuyển</td>
                                                <td><input type="text" value="0" class="form-control cost" id="transportCost"></td>
                                            </tr>
                                            <tr>
                                                <td class="first" colspan="2">Khuyến mại</td>
                                                <td><input type="text" value="0" class="form-control cost" id="discount"></td>
                                            </tr>
                                            <tr>
                                                <td class="first" colspan="2">Đã thanh toán</td>
                                                <td><input type="text" value="0" class="form-control cost" id="preCost"></td>
                                            </tr>
                                            <tr class="trCost trService" style="display: none;">
                                                <td class="first">Dịch vụ khác <i class="fa fa-plus link_add_service"></i></td>
                                                <td><?php $this->Mconstants->selectObject($listOtherServices, 'OtherServiceId', 'OtherServiceName', 'OtherServiceId_1', 0, true, '-Chọn-'); ?></td>
                                                <td><input type="text" value="0" class="form-control cost"></td>
                                            </tr>
                                            <tr class="trCost" id="trLendBack" style="display: none;">
                                                <td class="first" rowspan="2" style="line-height: 68px;">
                                                    <div class="radio-group">
                                                        <span class="item"><input type="checkbox" class="iCheck" id="cbLendBack" checked> Có công nợ</span>
                                                    </div>
                                                    <input type="text" hidden="hidden" id="isLendBack" value="1">
                                                </td>
                                                <td class="first">Tổng cần thu về</td>
                                                <td><input type="text" value="0" class="form-control" id="collectCost" disabled></td>
                                            </tr>
                                            <tr class="trCost" style="display: none;">
                                                <td class="first">Cho nợ lại</td>
                                                <td><input type="text" value="0" class="form-control cost" id="lendBackCost"></td>
                                            </tr>
                                            <tr class="trCost" style="display: none;">
                                                <td class="first">VAT</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="text" value="0" class="form-control" id="VATPercent">
                                                        <span class="input-group-addon">%</span>
                                                    </div>
                                                </td>
                                                <td><input type="text" value="0" class="form-control" id="VATCost" disabled></td>
                                            </tr>
                                            <tr>
                                                <td class="first">COD</td>
                                                <td class="first">Thanh toán khi giao hàng</td>
                                                <td><input type="text" value="0" class="form-control" id="CODCost" disabled></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p class="pull-right"><a href="javascript:void(0)" id="aExpandCost">Mở rộng</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Khách hàng</h3>
                            </div>
                            <div class="box-body">
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
                                <!--<p><a id="aCustomer" href="javascript:void(0)" target="_blank" class="text-bold" style="font-size: 25px;"></a></p>
                                <p id="customerGroupName"></p>-->
                            </div>
                        </div>
                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Thông tin giao hàng</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool"><i class="fa fa-pencil"></i> Chọn địa chỉ</button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label">Họ tên <span class="required">*</span></label>
                                    <input type="text" class="form-control hmdrequired" id="customerName" data-field="Họ Tên">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" class="form-control" id="customerEmail">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Số điện thoại <span class="required">*</span></label>
                                    <input type="text" class="form-control hmdrequired" id="customerPhone" data-field="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Địa chỉ <span class="required">*</span></label>
                                    <input type="text" class="form-control hmdrequired" id="customerAddress" data-field="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tỉnh/ Thành phố</label>
                                    <?php $this->Mconstants->selectObject($listProvinces, 'ProvinceId', 'ProvinceName', 'ProvinceId', 0, false, '', ' select2'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Quận huyện</label>
                                    <?php echo $this->Mdistricts->selectHtml(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Phân loại</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label">Kênh bán hàng</label>
                                    <?php $this->Mconstants->selectConstants('orderChannels', 'OrderChanelId'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Loại đơn hàng</label>
                                    <?php $this->Mconstants->selectObject($listOrderTypes, 'OrderTypeId', 'OrderTypeName', 'OrderTypeId'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Cách thức giao hàng</label>
                                    <div class="radio-group">
                                        <span class="item"><input type="radio" name="DeliveryTypeId" class="iCheckRadio" value="1" checked> POS</span>
                                        <span class="item"><input type="radio" name="DeliveryTypeId" class="iCheckRadio" value="2"> Từ xa</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Lý do mua hàng</label>
                                    <?php $this->Mconstants->selectObject($listOrderReasons, 'OrderReasonId', 'OrderReasonName', 'OrderReasonId'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li>
                    <li><a href="<?php echo base_url('order'); ?>" id="orderListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="getProductDetailUrl" value="<?php echo base_url('api/product/get'); ?>">
                    <input type="text" hidden="hidden" id="getCustomerDetailUrl" value="<?php echo base_url('api/customer/get'); ?>">
                    <input type="text" hidden="hidden" id="getListCustomerUrl" value="<?php echo base_url('api/customer/getList'); ?>">
                    <input type="text" hidden="hidden" id="getListProductUrl" value="<?php echo base_url('api/product/getList'); ?>">
                    <input type="text" hidden="hidden" id="orderId" value="0">
                    <input type="text" hidden="hidden" id="customerId" value="0">
                    <input type="text" hidden="hidden" id="verifyStatusId" value="1">
                    <input type="text" hidden="hidden" id="canEdit" value="1">
                </ul>
                <?php echo form_close(); ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>