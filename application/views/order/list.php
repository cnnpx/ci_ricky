<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('order/add'); ?>" class="btn btn-primary">Tạo đơn hàng</a></li>
                    <li><button class="btn btn-default">Xuất dữ liệu</button></li>
                </ul>
            </section>
            <section class="content">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="ulFilter">
                        <li class="active"><a href="#tab_0" data-id="0" data-toggle="tab" aria-expanded="true">Tất cả đơn hàng hàng</a></li>
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
                        <div class="dropdown-menu mt10 pos-arrow-dropdown animate-scale-dropdown" role="menu">
                            <label class="next-label"><span>Hiển thị tất cả đơn hàng theo</span>:</label>
                            <form class="form-inline">
                                <div class="form-group block-display mb10" role="presentation">
                                    <select class="form-control">
                                        <option value="">Trạng thái đơn hàng</option>
                                        <option value="">Trạng thái thanh toán</option>
                                        <option value="">Trạng thái giao hàng</option>
                                        <option value="">Tag</option>
                                        <option value="">Thời điểm đặt hàng</option>
                                        <option value="">Kênh bán hàng</option>
                                        <option value="">Trạng thái COD</option>
                                        <option value="">Nhà vận chuyển</option>
                                        <option value="">Trạng thái xác thực</option>
                                        <option value="">Phương thức thanh toán</option>
                                        <option value="">Người tạo</option>
                                        <option value="">Phương thức vận chuyển</option>
                                    </select>
                                </div>
                                <span class="text-operator-font">là</span>
                                <div class="form-group block-display mb10">
                                    <select class="form-control">
                                        <option value="">Hủy</option>
                                        <option value="">Mới</option>
                                        <option value="">Lưu trữ</option>
                                    </select>
                                </div>
                                <div class="form-group block-display widthauto">
                                    <button type="submit" data-toggle="dropdown" class="btn btn-default">Thêm điều kiện lọc</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="itemSearchName">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-flat">Lưu bộ lọc</button>
                    </span>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-flat"><i class="fa fa-times"></i></button>
                    </span>
                </div>
               <!--  <ul class="list-inline" id="conditionList">
                    <li>KH vip <i class="fa fa-times"></i></li>
                    <li>KH vip <i class="fa fa-times"></i></li>
                    <li>KH vip <i class="fa fa-times"></i></li>
                </ul> -->
                <div class="box box-success">
                    <?php $orderStatus = $this->Mconstants->orderStatus; ?>
                    <div class="box-header with-border">
                        <h3 class="box-title" id="h3Title"><?php echo $title; ?></h3>
                        <select class="form-control input-sm select-action" id="selectAction" style="display: none;">
                            <option value="">Chọn hành động</option>
                            <option value="change_status-0">Xóa đơn hàng đã chọn</option>
                            <option value="">----------</option>
                            <?php foreach($orderStatus as $i => $v){ ?>
                                <option value="change_status-<?php echo $i; ?>"><?php echo $v; ?></option>
                            <?php } ?>
                            <option value="">----------</option>
                            <option value="verify_order-2">Xác thực đơn hàng</option>
                            <option value="verify_order-1">Bỏ xác thực đơn hàng</option>
                            <option value="">----------</option>
                            <option value="add_tags">Thêm nhãn</option>
                            <option value="delete_tags">Bỏ nhãn</option>
                        </select>
                        <?php if(isset($paggingHtml)){ ?>
                            <div class="box-tools pull-right">
                                <?php echo $paggingHtml; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <style>
                        #tbodyOrder i{
                            cursor: pointer;
                            margin-left: 3px;
                        }
                    </style>
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="iCheckTable" id="checkAll"></th>
                                <th>Mã</th>
                                <th>Ngày đặt</th>
                                <th>Khách hàng</th>
                                <th>Trạng thái</th>
                                <th>Giao hàng</th>
                                <th>Thanh toán</th>
                                <th>COD</th>
                                <th>Tổng tiền</th>
                                <th>Kênh</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyOrder">
                            <?php $labelCss = $this->Mconstants->labelCss;
                            $orderChannels = $this->Mconstants->orderChannels;
                            $paymentStatus = $this->Mconstants->paymentStatus;
                            foreach($listOrders as $o){ ?>
                                <tr id="trItem_<?php echo $o['OrderId']; ?>">
                                    <td><input type="checkbox" class="iCheckTable iCheckItem" value="<?php echo $o['OrderId']; ?>"></td>
                                    <td id="orderCode_<?php echo $o['OrderId']; ?>">
                                        <a href="<?php echo base_url('order/edit/'.$o['OrderId']); ?>"><?php echo $o['OrderCode']; ?></a>
                                        <?php if(!empty($o['Comment'])) echo '<i class="fa fa-list-alt tooltip1" title="'.$o['Comment'].'"></i>';
                                        if($o['VerifyStatusId'] == 2) echo '<i class="fa fa-check tooltip1 active" title="Đã xác thực"></i>'; ?>
                                    </td>
                                    <td><?php echo ddMMyyyy($o['CrDateTime'], 'd/m/Y H:i'); ?></td>
                                    <td><a href="<?php echo base_url('customer/edit/'.$o['CustomerId']); ?>"><?php echo $this->Mconstants->getObjectValue($listCustomers, 'CustomerId', $o['CustomerId'], 'FullName'); ?></a></td>
                                    <td id="statusName_<?php echo $o['OrderId']; ?>"><span class="<?php echo $labelCss[$o['OrderStatusId']]; ?>"><?php echo $orderStatus[$o['OrderStatusId']]; ?></span></td>
                                    <td></td>
                                    <td><span class="<?php echo $labelCss[$o['PaymentStatusId']]; ?>"><?php echo $paymentStatus[$o['PaymentStatusId']]; ?></span></td>
                                    <td>
                                        <?php if($o['CODStatusId'] == 2) echo '<span class="label label-success">Có</span>';
                                        else echo '<span class="label label-default">Không</span>'; ?>
                                    </td>
                                    <td>0</td>
                                    <td><span class="<?php echo $labelCss[$o['OrderChanelId']]; ?>"><?php echo $orderChannels[$o['OrderChanelId']]; ?></span></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="changeItemStatusUrl" value="<?php echo base_url('api/order/changeStatusBatchWeb'); ?>">
                    <input type="text" hidden="hidden" id="changeVerifyStatusBatchUrl" value="<?php echo base_url('api/order/changeVerifyStatusBatch'); ?>">
                    <input type="text" hidden="hidden" id="itemTypeId" value="6">
                    <?php $this->load->view('includes/modal/tag'); ?>
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>