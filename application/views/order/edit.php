<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <?php if($canEdit){ ?><li><button class="btn btn-primary submit">Lưu</button></li><?php } ?>
                    <li><a href="<?php echo base_url('order'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <style>
                    .box-other-info{
                        border-top: 1px solid #d2d6de;
                        margin-bottom: 0;
                    }
                </style>
                <?php $this->load->view('includes/notice'); ?>
                <?php if($orderId > 0){ ?>
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
                                        <tbody id="tbodyProduct">
                                        <?php $products = array();
                                        $productChilds = array();
                                        foreach($listOrderProducts as $op){
                                            if(!isset($products[$op['ProductId']])) $products[$op['ProductId']] = $this->Mproducts->get($op['ProductId'], true, '', 'ProductName, ProductImage, Price');
                                            $productName = $products[$op['ProductId']]['ProductName'];
                                            $productImage = $products[$op['ProductId']]['ProductImage'];
                                            $price = $products[$op['ProductId']]['Price'];
                                            if($op['ProductChildId'] > 0){
                                                if(!isset($productChilds[$op['ProductChildId']])) $productChilds[$op['ProductChildId']] = $this->Mproductchilds->get($op['ProductChildId'], true, '', 'ProductName, ProductImage, Price');
                                                $productName .= '<br/>(' . $productChilds[$op['ProductChildId']]['ProductName'] .')';
                                                $productImage = $productChilds[$op['ProductChildId']]['ProductImage'];
                                                $price = $productChilds[$op['ProductChildId']]['Price'];
                                            } ?>
                                            <tr data-id="<?php echo $op['ProductId']; ?>" data-child="<?php echo $op['ProductChildId']; ?>">
                                                <td><img src="<?php echo $productImage; ?>" class="productImg"></td>
                                                <td><?php echo $productName; ?></td>
                                                <td><input class="form-control quantity" value="<?php echo priceFormat($op['Quantity']); ?>"></td>
                                                <td class="tdPrice"><span class="spanPrice"><?php echo priceFormat($price); ?></span></td>
                                                <td><input class="form-control sumPrice" disabled value="<?php echo priceFormat($op['Quantity'] * $price); ?>"></td>
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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Ghi chú đơn hàng</label>
                                            <textarea class="form-control" rows="3" id="comment"><?php echo $order['Comment']; ?></textarea>
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
                                                <td><input type="text" value="<?php echo priceFormat($order['TransportCost']); ?>" class="form-control cost" id="transportCost"></td>
                                            </tr>
                                            <tr>
                                                <td class="first" colspan="2">Khuyến mại</td>
                                                <td><input type="text" value="<?php echo priceFormat($order['Discount']); ?>" class="form-control cost" id="discount"></td>
                                            </tr>
                                            <tr>
                                                <td class="first" colspan="2">Đã thanh toán</td>
                                                <td><input type="text" value="<?php echo priceFormat($order['PreCost']); ?>" class="form-control cost" id="preCost"></td>
                                            </tr>
                                            <?php $i = 0;
                                            foreach($listOrderServices as $os){
                                                $i++; ?>
                                                <tr class="trCost trService" style="display: none;">
                                                    <td class="first">Dịch vụ khác <i class="fa fa-plus <?php echo ($i == 1) ? 'link_add_service' : 'link_delete_service'; ?>"></i></td>
                                                    <td><?php $this->Mconstants->selectObject($listOtherServices, 'OtherServiceId', 'OtherServiceName', 'OtherServiceId_'.$i, $os['OtherServiceId'], true, '-Chọn-'); ?></td>
                                                    <td><input type="text" value="<?php echo priceFormat($os['ServiceCost']); ?>" class="form-control cost"></td>
                                                </tr>
                                            <?php } ?>
                                            <tr class="trCost" id="trLendBack" style="display: none;">
                                                <td class="first" rowspan="2" style="line-height: 68px;">
                                                    <div class="radio-group">
                                                        <span class="item"><input type="checkbox" class="iCheck" id="cbLendBack"<?php if($order['IsLendBack'] == 2) echo ' checked'; ?>> Có công nợ</span>
                                                    </div>
                                                    <input type="text" hidden="hidden" id="isLendBack" value="<?php echo $order['IsLendBack'] - 1; ?>">
                                                </td>
                                                <td class="first">Tổng cần thu về</td>
                                                <td><input type="text" value="0" class="form-control" id="collectCost" disabled></td>
                                            </tr>
                                            <tr class="trCost" style="display: none;">
                                                <td class="first">Cho nợ lại</td>
                                                <td><input type="text" value="<?php echo priceFormat($order['LendBackCost']); ?>" class="form-control cost" id="lendBackCost"></td>
                                            </tr>
                                            <tr class="trCost" style="display: none;">
                                                <td class="first">VAT</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="text" value="<?php echo $order['VATPercent']; ?>" class="form-control" id="VATPercent">
                                                        <span class="input-group-addon">%</span>
                                                    </div>
                                                </td>
                                                <td><input type="text" value="0" class="form-control" id="VATCost" disabled></td>
                                            </tr>
                                            <tr>
                                                <td class="first">COD</td>
                                                <td class="first">Thanh toán khi giao hàng</td>
                                                <td><input type="text" value="<?php echo priceFormat($order['CODCost']); ?>" class="form-control" id="CODCost" disabled></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p class="pull-right"><a href="javascript:void(0)" id="aExpandCost">Mở rộng</a></p>
                                    </div>
                                </div>
                                <div class="box box-default padding15 box-other-info">
                                    <div class="box-body">
                                        <div id="divVerify1"<?php if($order['VerifyStatusId'] == 2) echo ' style="display: none;"'; ?>>
                                            <p class="text-uppercase pull-left"><i class="fa fa-check" style="font-size: 20px;"></i> Chưa xác thực đơn hàng</p>
                                            <button type="button" class="btn btn-primary pull-right" id="btnVerifyOrder">Xác thực</button>
                                        </div>
                                        <div id="divVerify2"<?php if($order['VerifyStatusId'] == 1) echo ' style="display: none;"'; ?>>
                                            <p class="text-uppercase pull-left"><i class="fa fa-check active" style="font-size: 20px;"></i> Đã xác thực đơn hàng</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box box-default padding15 box-other-info">
                                    <div class="box-body">
                                        <p class="text-uppercase pull-left"><i class="fa fa-credit-card" style="font-size: 20px;"></i> Thanh toán chờ xử lý</p>
                                        <button type="button" class="btn btn-primary pull-right">Xác nhận thanh toán</button>
                                    </div>
                                </div>
                                <div class="box box-default padding15 box-other-info">
                                    <div class="box-body">
                                        <div id="divShowTransport1"<?php if($transportId > 0 || $order['DeliveryTypeId'] == 1) echo ' style="display: none;"'; ?>>
                                            <p class="text-uppercase pull-left"><i class="fa fa-truck" style="font-size: 20px;"></i> Giao hàng</p>
                                            <button type="button" id="btnCheckOrder" class="btn btn-primary block-display pull-right">Kiểm tra đơn hàng</button>
                                            <input type="hidden" id="urlCheckOrder" value="<?=base_url("order/checkOrder/$orderId")?>">
                                            <button type="button" class="btn btn-primary pull-right none-display" id="btnTransport">Giao hàng</button>
                                        </div>
                                        <div id="divShowTransport2"<?php if($transportId == 0) echo ' style="display: none;"'; ?>>
                                            <p class="text-uppercase pull-left"><i class="fa fa-check active" style="font-size: 20px;"></i> Xem chi tiết vận chuyển tại <a id="aTransportLink" href="<?php echo base_url('transport/edit'); ?>">đây</a></p>
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
                                <h3 class="box-title">Thông tin giao hàng</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool"><i class="fa fa-pencil"></i> Chọn địa chỉ</button>
                                </div>
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
                                    <label class="control-label">Kênh bán hàng</label>
                                    <?php $this->Mconstants->selectConstants('orderChannels', 'OrderChanelId', $order['OrderChanelId']); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Loại đơn hàng</label>
                                    <?php $this->Mconstants->selectObject($listOrderTypes, 'OrderTypeId', 'OrderTypeName', 'OrderTypeId', $order['OrderTypeId']); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Cách thức giao hàng</label>
                                    <div class="radio-group">
                                        <span class="item"><input type="radio" name="DeliveryTypeId" class="iCheckRadio" value="1"<?php if($order['DeliveryTypeId'] == 1) echo ' checked'; ?>> POS</span>
                                        <span class="item"><input type="radio" name="DeliveryTypeId" class="iCheckRadio" value="2"<?php if($order['DeliveryTypeId'] == 2) echo ' checked'; ?>> Từ xa</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Lý do mua hàng</label>
                                    <?php $this->Mconstants->selectObject($listOrderReasons, 'OrderReasonId', 'OrderReasonName', 'OrderReasonId', $order['OrderReasonId']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <?php if($canEdit){ ?><li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li><?php } ?>
                    <li><a href="<?php echo base_url('order'); ?>" id="orderListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="getProductDetailUrl" value="<?php echo base_url('api/product/get'); ?>">
                    <input type="text" hidden="hidden" id="getCustomerDetailUrl" value="<?php echo base_url('api/customer/get'); ?>">
                    <input type="text" hidden="hidden" id="getListCustomerUrl" value="<?php echo base_url('api/customer/getList'); ?>">
                    <input type="text" hidden="hidden" id="getListProductUrl" value="<?php echo base_url('api/product/getList'); ?>">
                    <input type="text" hidden="hidden" id="updateVerifyOrderUrl" value="<?php echo base_url('api/order/changeVerifyStatusBatch'); ?>">
                    <input type="text" hidden="hidden" id="orderId" value="<?php echo $orderId; ?>">
                    <input type="text" hidden="hidden" id="customerId" value="<?php echo $order['CustomerId']; ?>">
                    <input type="text" hidden="hidden" id="verifyStatusId" value="<?php echo $order['VerifyStatusId']; ?>">
                    <input type="text" hidden="hidden" id="canEdit" value="<?php echo $canEdit ? 1 : 0; ?>">
                    <?php foreach($tagNames as $tagName){ ?>
                        <input type="text" hidden="hidden" class="tagName" value="<?php echo $tagName; ?>">
                    <?php } ?>
                </ul>
                <?php echo form_close(); ?>
                <div class="modal fade" id="modalTransport" tabindex="-1" role="dialog" aria-labelledby="modalTransport">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Giao hàng</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Lấy hàng từ kho</label>
                                            <?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreId', 0, false, '', ' select2'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Tổng khối lượng (kg)</label>
                                            <input type="text" class="form-control cost" id="transportWeight" value="0">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Loại vận chuyển</label>
                                            <?php $this->Mconstants->selectObject($listTransportTypes, 'TransportTypeId', 'TransportTypeName', 'TransportTypeId', 0, false, '', ' select2'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Nhà vận chuyển</label>
                                            <?php $this->Mconstants->selectObject($listTransporters, 'TransporterId', 'TransporterName', 'TransporterId', 0, false, '', ' select2'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Số tiền thu hộ (COD)</label>
                                            <input type="text" class="form-control cost" id="transportCODCost" value="<?php echo priceFormat($order['CODCost']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Mã vận đơn</label>
                                            <input type="text" class="form-control" id="transportTracking" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Tên người nhận</label>
                                            <input type="text" class="form-control hmdrequired" id="customerName1" value="<?php echo $customerAddress ? $customerAddress['CustomerName'] : ''; ?>" data-field="Họ Tên">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Email</label>
                                            <input type="text" class="form-control" id="customerEmail1" value="<?php echo $customerAddress ? $customerAddress['Email'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Số điện thoại <span class="required">*</span></label>
                                            <input type="text" class="form-control hmdrequired" id="customerPhone1" value="<?php echo $customerAddress ? $customerAddress['PhoneNumber'] : ''; ?>" data-field="Số điện thoại">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Chuyển tới địa chỉ</label>
                                            <input type="text" class="form-control" id="customerAddress1" value="<?php echo $customerAddress ? $customerAddress['Address'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Thành phố</label>
                                            <?php $this->Mconstants->selectObject($listProvinces, 'ProvinceId', 'ProvinceName', 'TransportProvinceId', $customerAddress ? $customerAddress['ProvinceId'] : 0, false, '', ' select2'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Quận/ Huyện</label>
                                            <?php echo $this->Mdistricts->selectHtml($customerAddress ? $customerAddress['DistrictId'] : 0, 'TransportDistrictId'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label label-nomal">Ghi chú</label>
                                            <textarea class="form-control" rows="2" id="transportComment"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Nhãn (cách nhau bởi dấu phẩy)</label>
                                            <input type="text" class="form-control" id="transportTags">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                <button type="button" class="btn btn-primary" id="btnAddTransport">Hoàn thành</button>
                                <input type="text" hidden="hidden" id="updateTransportUrl" value="<?php echo base_url('api/transport/update'); ?>">
                                <input type="text" hidden="hidden" id="transportId" value="<?php echo $transportId; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modelCheckOrder" tabindex="-1" role="dialog" aria-labelledby="modelCheckOrder">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Kiểm tra đơn hàng</h4>
                                </div>
                                <div class="modal-body">
                                   <h4>Tình trạng tồn kho</h4>
                                    <div id="productExits">
                                        <h5 class="title"></h5>
                                        <div class="table-responsive no-padding divTable">
                                            <table class="table table-hover table-bordered">
                                                <thead class="theadNormal">
                                                <tr>
                                                    <th style="width: 70%;">Sản phẩm</th>
                                                    <th style="width: 30%;">Số lượng hiện còn</th>
                                                </tr>
                                                </thead>
                                                <tbody id="productExitsTbody"></tbody>
                                            </table>
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>