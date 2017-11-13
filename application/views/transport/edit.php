<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <?php if($canEdit){ ?><li><button class="btn btn-primary submit">Lưu</button></li><?php } ?>
                    <li><a href="<?php echo base_url('transport'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php $this->load->view('includes/notice'); ?>
                <?php if($transportId > 0){ ?>
                <?php echo form_open('api/transport/update', array('id' => 'transportForm')); ?>
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
                                                <td><input class="form-control quantity" disabled value="<?php echo priceFormat($op['Quantity']); ?>"></td>
                                                <td class="tdPrice"><span class="spanPrice"><?php echo priceFormat($price); ?></span></td>
                                                <td><input class="form-control sumPrice" disabled value="<?php echo priceFormat($op['Quantity'] * $price); ?>"></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Ghi chú vận chuyển</label>
                                            <textarea class="form-control" rows="3" id="comment"><?php echo $transport['Comment']; ?></textarea>
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
                                                <td><input type="text" value="<?php echo priceFormat($order['TransportCost']); ?>" class="form-control cost" id="transportCost" disabled></td>
                                            </tr>
                                            <tr>
                                                <td class="first" colspan="2">Khuyến mại</td>
                                                <td><input type="text" value="<?php echo priceFormat($order['Discount']); ?>" class="form-control cost" id="discount" disabled></td>
                                            </tr>
                                            <tr>
                                                <td class="first" colspan="2">Đã thanh toán</td>
                                                <td><input type="text" value="<?php echo priceFormat($order['PreCost']); ?>" class="form-control cost" id="preCost" disabled></td>
                                            </tr>
                                            <?php $i = 0;
                                            foreach($listOrderServices as $os){
                                                $i++; ?>
                                                <tr class="trCost trService" style="display: none;">
                                                    <td class="first">Dịch vụ khác</td>
                                                    <td><?php $this->Mconstants->selectObject($listOtherServices, 'OtherServiceId', 'OtherServiceName', 'OtherServiceId_'.$i, $os['OtherServiceId'], false, '', '', ' disabled'); ?></td>
                                                    <td><input type="text" value="<?php echo priceFormat($os['ServiceCost']); ?>" class="form-control cost" disabled></td>
                                                </tr>
                                            <?php } ?>
                                            <tr class="trCost" id="trLendBack" style="display: none;">
                                                <td class="first" rowspan="2" style="line-height: 68px;">
                                                    <div class="radio-group">
                                                        <span class="item"><input type="checkbox" class="iCheck" disabled id="cbLendBack"<?php if($order['IsLendBack'] == 2) echo ' checked'; ?>> Có công nợ</span>
                                                    </div>
                                                    <input type="text" hidden="hidden" id="isLendBack" value="<?php echo $order['IsLendBack'] - 1; ?>">
                                                </td>
                                                <td class="first">Tổng cần thu về</td>
                                                <td><input type="text" value="0" class="form-control" id="collectCost" disabled></td>
                                            </tr>
                                            <tr class="trCost" style="display: none;">
                                                <td class="first">Cho nợ lại</td>
                                                <td><input type="text" value="<?php echo priceFormat($order['LendBackCost']); ?>" class="form-control cost" id="lendBackCost" disabled></td>
                                            </tr>
                                            <tr class="trCost" style="display: none;">
                                                <td class="first">VAT</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="text" value="<?php echo $order['VATPercent']; ?>" class="form-control" id="VATPercent" disabled>
                                                        <span class="input-group-addon">%</span>
                                                    </div>
                                                </td>
                                                <td><input type="text" value="0" class="form-control" id="VATCost" disabled></td>
                                            </tr>
                                            <tr>
                                                <td class="first">COD</td>
                                                <td class="first">Thanh toán khi giao hàng</td>
                                                <td><input type="text" value="<?php echo priceFormat($transport['CODCost']); ?>" class="form-control" id="CODCost" disabled></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p class="pull-right"><a href="javascript:void(0)" id="aExpandCost">Mở rộng</a></p>
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
                                    <label class="control-label label-nomal">Trạng thái</label>
                                    <?php $this->Mconstants->selectConstants('transportStatus', 'TransportStatusId', $transport['TransportStatusId']); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label label-nomal">Nhà vận chuyển</label>
                                    <?php $this->Mconstants->selectObject($listTransporters, 'TransporterId', 'TransporterName', 'TransporterId', $transport['TransporterId'], false, '', ' select2'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label label-nomal">Loại vận chuyển</label>
                                    <?php $this->Mconstants->selectObject($listTransportTypes, 'TransportTypeId', 'TransportTypeName', 'TransportTypeId', $transport['TransportTypeId'], false, '', ' select2'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label label-nomal">Lấy hàng từ kho</label>
                                    <?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreId', $transport['StoreId'], false, '', ' select2'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label label-nomal">Mã vận đơn</label>
                                    <input type="text" class="form-control" id="tracking" value="<?php echo $transport['Tracking']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label label-nomal">Tổng khối lượng (kg)</label>
                                    <input type="text" class="form-control cost" id="weight" value="<?php echo $transport['Weight']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <?php if($canEdit){ ?><li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li><?php } ?>
                    <li><a href="<?php echo base_url('transport'); ?>" id="transportListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="transportId" value="<?php echo $transportId; ?>">
                    <input type="text" hidden="hidden" id="orderId" value="<?php echo $transport['OrderId']; ?>">
                    <input type="text" hidden="hidden" id="transportCode" value="<?php echo $transport['TransportCode']; ?>">
                    <input type="text" hidden="hidden" id="customerId" value="<?php echo $transport['CustomerId']; ?>">
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