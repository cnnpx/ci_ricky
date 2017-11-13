<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <?php if($canEdit){ ?><li><button class="btn btn-primary submit">Lưu</button></li><?php } ?>
                    <li><a href="<?php echo base_url('storecirculation'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php $this->load->view('includes/notice'); ?>
                <?php if($storeCirculationId > 0){ ?>
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
                                        <tbody id="tbodyProduct">
                                        <?php $products = array();
                                        $productChilds = array();
                                        foreach($listStoreCirculationProducts as $cp){
                                            if(!isset($products[$cp['ProductId']])) $products[$cp['ProductId']] = $this->Mproducts->get($cp['ProductId'], true, '', 'ProductName, ProductImage, Price');
                                            $productName = $products[$cp['ProductId']]['ProductName'];
                                            $productImage = $products[$cp['ProductId']]['ProductImage'];
                                            $price = $products[$cp['ProductId']]['Price'];
                                            if($cp['ProductChildId'] > 0){
                                                if(!isset($productChilds[$cp['ProductChildId']])) $productChilds[$cp['ProductChildId']] = $this->Mproductchilds->get($cp['ProductChildId'], true, '', 'ProductName, ProductImage, Price');
                                                $productName .= '<br/>(' . $productChilds[$cp['ProductChildId']]['ProductName'] .')';
                                                $productImage = $productChilds[$cp['ProductChildId']]['ProductImage'];
                                                $price = $productChilds[$cp['ProductChildId']]['Price'];
                                            } ?>
                                            <tr data-id="<?php echo $cp['ProductId']; ?>" data-child="<?php echo $cp['ProductChildId']; ?>">
                                                <td><img src="<?php echo $productImage; ?>" class="productImg"></td>
                                                <td><?php echo $productName; ?></td>
                                                <td><input class="form-control quantity" value="<?php echo priceFormat($cp['Quantity']); ?>"></td>
                                                <td class="tdPrice"><span class="spanPrice"><?php echo priceFormat($price); ?></span></td>
                                                <td><input class="form-control sumPrice" disabled value="<?php echo priceFormat($cp['Quantity'] * $price); ?>"></td>
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
                                            <label class="control-label normal">Ghi chú đơn hàng</label>
                                            <textarea class="form-control" rows="2" id="comment"><?php echo $storeCirculation['Comment']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label normal">Nhãn (cách nhau bởi dấu phẩy)</label>
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
                                <h3 class="box-title">Cơ sở</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label normal">Cơ sở xuất hàng</label>
                                    <?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreSourceId', $storeCirculation['StoreSourceId'], false, '', ' select2'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label normal">Cơ sở nhập hàng</label>
                                    <?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreDestinationId', $storeCirculation['StoreDestinationId'], false, '', ' select2'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label normal">Cách thức giao hàng</label>
                                    <div class="radio-group">
                                        <span class="item"><input type="radio" name="DeliveryTypeId" class="iCheckRadio" value="1"<?php if($storeCirculation['DeliveryTypeId'] == 1) echo ' checked'; ?>> POS</span>
                                        <span class="item"><input type="radio" name="DeliveryTypeId" class="iCheckRadio" value="2"<?php if($storeCirculation['DeliveryTypeId'] == 2) echo ' checked'; ?>> Từ xa</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Trạng thái</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label normal">Trạng thái đơn hàng</label>
                                    <div class="radio-group">
                                        <?php $orderStatus = $this->Mconstants->orderStatus;
                                        foreach($orderStatus as $id => $name){ ?>
                                            <span class="item"><input type="radio" name="OrderStatusId" class="iCheckRadio rdOrderStatusId" value="<?php echo $id; ?>"<?php if($storeCirculation['OrderStatusId'] == $id) echo ' checked'; ?>> <?php echo $name; ?></span><br/>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label normal">Trạng thái duyệt</label>
                                    <div class="radio-group">
                                        <?php $status = $this->Mconstants->status;
                                        foreach($status as $id => $name){ ?>
                                            <span class="item"><input type="radio" name="StatusId" class="iCheckRadio rdStatusId" value="<?php echo $id; ?>"<?php if($storeCirculation['StatusId'] == $id) echo ' checked'; ?>> <?php echo $name; ?></span><br/>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group" id="divCancelReason"<?php if($storeCirculation['StatusId'] != 3) echo ' style="display: none;"'; ?>>
                                    <label class="control-label normal">Lý do hủy bỏ</label>
                                    <input type="text" class="form-control" id="cancelReason" value="<?php echo $storeCirculation['CancelReason']; ?>">
                                </div>
                                <div class="form-group" id="divHandleDate"<?php if($storeCirculation['StatusId'] != 4) echo ' style="display: none;"'; ?>>
                                    <label class="control-label normal">Ngày xử lý lại</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control datepicker" id="handleDate" value="<?php echo ddMMyyyy($storeCirculation['HandleDate']); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <?php if($canEdit){ ?><li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li><?php } ?>
                    <li><a href="<?php echo base_url('storecirculation'); ?>" id="storeCirculationListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="getProductDetailUrl" value="<?php echo base_url('api/product/get'); ?>">
                    <input type="text" hidden="hidden" id="getListProductUrl" value="<?php echo base_url('api/product/getList'); ?>">
                    <input type="text" hidden="hidden" id="canEdit" value="<?php echo $canEdit ? 1 : 0; ?>">
                    <input type="text" hidden="hidden" id="storeCirculationCode" value="<?php echo $storeCirculation['StoreCirculationCode']; ?>">
                    <input type="text" hidden="hidden" id="storeCirculationId" value="<?php echo $storeCirculationId; ?>">
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