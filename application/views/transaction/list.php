<?php $this->load->view('includes/header'); ?>
<script>
    var paginate = <?=$paginate?>;
</script>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('transaction/add'); ?>" class="btn btn-primary">Thêm mới</a></li>
                </ul>
            </section>
            <section class="content">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="ulFilter" >
                        <li class="active"><a href="#tab_0" data-id="0" data-toggle="tab" aria-expanded="true">Tất cả phiếu</a></li>
                        <?php foreach ($listFilters as $f) { ?>
                            <li><a href="#tab_<?php echo $f['FilterId'] ?>" data-id="<?php echo $f['FilterId'] ?>" data-toggle="tab" aria-expanded="false"><?php echo $f['FilterName']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php $transactionTypes = $this->Mconstants->transactionTypes;
                $transactionStatus = $this->Mconstants->transactionStatus; ?>
                <div class="input-group margin ctrl-filter no-padding">
                    <div class="input-group-btn dropdown" id="searchGroup">
                        <button type="button" class="btn btn-success dropdown-toggle transform" data-toggle="dropdown" aria-expanded="false">
                            Điều kiện lọc <span class="fa fa-caret-down"></span>
                        </button>
                        <div class="dropdown-menu mt10 pos-arrow-dropdown animate-scale-dropdown" role="menu">
                            <label class="next-label"><span>Hiển thị tất cả đơn hàng theo</span>:</label>
                            <form class="form-inline">
                                <div class="form-group block-display mb10" role="presentation">
                                    <select class="form-control" id="field_select">
                                        <option value="group_money">Số tiền</option>
                                        <option value="group_email">Địa chỉ email</option>
                                        <option value="group_date">Thời điểm tạo phiếu</option>
                                        <option value="group_ac_datetime">Thời điểm nhân việc xác nhận</option>
                                        <option value="group_admin_datetime">Thời điểm quản lý xác nhận</option>
                                        <option value="group_status_trans">Trạng thái phiếu</option>
                                        <option value="group_type_trans">Loại phiếu</option>
                                        <option value="group_store">Cơ sở</option>
                                        <option value="group_moneysource">Nguồn tiền</option>
                                        <option value="group_order">Đơn hàng</option>
                                    </select>
                                    </select>
                                </div>
                                <div class="form-group mb10 group_email none-display">
                                    <div class="text_opertor">là</div>
                                    <input class="value_operator" value="like" type="hidden"/>
                                </div>
                                <div class="form-group mb10 group_store none-display">
                                    <div class="text_opertor">ở</div>
                                    <input class="value_operator" value="=" type="hidden"/>
                                </div>
                                <div class="form-group mb10 group_order group_status_trans group_type_trans group_moneysource none-display ">
                                    <div class="text_opertor">là</div>
                                    <input class="value_operator" value="=" type="hidden"/>
                                </div>
                                <div class="form-group block-display mb10">
                                    <!-- group_money group_order field đây là các filter được sử dụng tùy chọn này-->
                                    <select class="form-control group_money block-display">
                                        <option value="=">bằng</option>
                                        <option value="<>">khác</option>
                                        <option value="<">nhỏ hơn</option>
                                        <option value=">">lớn hơn</option>
                                    </select>
                                    <select class="form-control group_status_trans none-display">
                                        <?php foreach($transactionStatus as $key => $statusName) :?>
                                            <option value="<?=$key?>"><?=$statusName?></option>
                                        <?php endforeach;?>
                                    </select>

                                    <select class="form-control group_moneysource none-display">
                                        <?php foreach($listMoneySources as $key => $moneySource) :?>
                                            <option value="<?=$moneySource['MoneySourceId']?>"><?=$moneySource['MoneySourceName']?></option>
                                        <?php endforeach;?>
                                    </select>

                                    <select class="form-control group_type_trans none-display">
                                        <?php foreach($transactionTypes as $key => $typeName) :?>
                                            <option value="<?php echo $key; ?>"><?php echo $typeName?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <select class="form-control group_date group_ac_datetime group_admin_datetime none-display">
                                        <option value="between">trong khoảng</option>
                                        <option value="<">trước</option>
                                        <option value="=">bằng</option>
                                        <option value=">">sau</option>
                                    </select>
                                    <select class="form-control group_store none-display">
                                        <?php foreach($listStores as $store) :?>
                                            <option value="<?php echo $store['StoreId']; ?>"><?php echo $store['StoreName']; ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group block-display mb10">
                                    <!-- group_money group_order field đây là các filter được sử dụng input này-->
                                    <input class="form-control group_money group_email group_order" type="text">
                                    <input class="form-control datepicker group_date group_ac_datetime group_admin_datetime none-display" placeholder="Nhập thời gian bắt đầu" type="text" id="timeStart">
                                    <input class="form-control datepicker group_date group_ac_datetime group_admin_datetime none-display" placeholder="Nhập thời gian kết thúc" type="text" id="timeEnd">
                                </div>
                                <div class="form-group block-display widthauto">
                                    <!-- data-href : Đây là link gọi để filter mỗi trang sẽ có 1 link khác nhau -->
                                    <button id="btn-filter" data-href="<?php echo base_url('api/transaction/search'); ?>" type="submit" data-toggle="dropdown" class="btn btn-default">Thêm điều kiện lọc</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="itemSearchName">
                    <span class="input-group-btn">
                        <button id="btn-popup-filter" disabled type="button" data-toggle="modal" data-target="#save-filter" class="btn btn-disable">Lưu bộ lọc</button>
                    </span>
                    <span class="input-group-btn">
                        <button id="remove-filter" type="button" disabled class="btn btn-disable"><i class="fa fa-times"></i></button>
                    </span>
                </div>
                <div>
                    <ul id="container-filters"></ul>
                </div>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="h3Title"><?php echo $title; ?></h3>
                        <select class="form-control input-sm select-action" id="selectAction" style="display: none;">
                            <option value="">Chọn hành động</option>
                            <option value="delete_item">Xóa phiếu được chọn</option>
                            <option value="add_tags">Thêm nhãn</option>
                            <option value="delete_tags">Bỏ nhãn</option>
                        </select>
                        <?php if (isset($paggingHtml)) { ?>
                            <div class="box-tools pull-right">
                                <?php echo $paggingHtml; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered" id="table-data">
                            <thead>
                            <tr>
                                <th><input type="checkbox" value="0" class="iCheckTable" id="checkAll"></th>
                                <th>Mã</th>
                                <th>Khách hàng</th>
                                <th>Loại phiếu</th>
                                <th>Đơn hàng</th>
                                <th>Nguồn tiền</th>
                                <th>Số tiền</th>
                                <th>Cơ sở</th>
                                <th>Máy nhận tiền</th>
                                <th>Trạng thái</th>
                                <th>Người tạo</th>
                                <th>Thời gian tạo</th>
                                <!--<th>Nhân viên duyệt</th>
                                <th>Quản lý duyệt</th>-->
                                <th>Ghi chú</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyTransaction">
                            <?php $labelCss = $this->Mconstants->labelCss;
                            $customerNames = array();
                            $orderCodes = array();
                            foreach ($listTransactions as $t){
                                if(!isset($customerNames[$t['CustomerId']])) $customerNames[$t['CustomerId']] = $this->Mcustomers->getFieldValue(array('CustomerId' => $t['CustomerId']), 'FullName');
                                if($t['OrderId'] > 0 && !isset($orderCodes[$t['OrderId']])) $orderCodes[$t['OrderId']] = $this->Morders->getFieldValue(array('OrderId' => $t['OrderId']), 'OrderCode'); ?>
                                <tr class="trItem" id="trItem_<?=$t['TransactionId']?>">
                                    <td><input type="checkbox" class="iCheckTable iCheckItem" value="<?php echo $t['TransactionId']; ?>"></td>
                                    <td><a href="<?php echo base_url('transaction/edit/'.$t['TransactionId'])?>">#<?php echo $t['TransactionId']; ?></a></td>
                                    <td><a href="<?php echo base_url('customer/edit/'.$t['CustomerId'])?>" target="_blank"><?php echo $customerNames[$t['CustomerId']]; ?></a></td>
                                    <td><span class="<?php echo $labelCss[$t['TransactionTypeId']]; ?>"><?php echo $transactionTypes[$t['TransactionTypeId']]; ?></td>
                                    <td><a target="_blank" href="<?php echo base_url('order/edit/'.$t['OrderId']); ?>"><?php if($t['OrderId'] > 0) echo $orderCodes[$t['OrderId']]; ?></a></td>
                                    <td><?php echo $this->Mconstants->getObjectValue($listMoneySources, 'MoneySourceId', $t['MoneySourceId'], 'MoneySourceName'); ?></td>
                                    <td><?php echo priceFormat($t['PaidCost']); ?></td>
                                    <td><?php echo $this->Mconstants->getObjectValue($listStores, 'StoreId', $t['StoreId'], 'StoreName'); ?></td>
                                    <td><?php echo $this->Mconstants->getObjectValue($listMoneyPhones, 'MoneyPhoneId', $t['MoneyPhoneId'], 'MoneyPhoneName'); ?></td>
                                    <td><span class="<?php echo $labelCss[$t['TransactionStatusId']]; ?>"><?php echo $transactionStatus[$t['TransactionStatusId']]?></span></td>
                                    <td><?php echo $this->Mconstants->getObjectValue($listUsers, 'UserId', $t['CrUserId'], 'FullName'); ?></td>
                                    <td><?php echo date('Y-m-d',strtotime($t['CrDateTime'])); ?></td>
                                    <!--<td><?php //echo $this->Mconstants->getObjectValue($listUsers, 'UserId', $t['AccountantUserId'], 'FullName'); ?></td>
                                    <td><?php //echo $this->Mconstants->getObjectValue($listUsers, 'UserId', $t['AdminUserId'], 'FullName'); ?></td>-->
                                    <td><?php echo $this->Mhelpers->wordLimit($t['Comment']); ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="14" class="paginate_table"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="deleteItemUrl" value="<?php echo base_url('api/transaction/deleteBatch'); ?>">
                    <input type="text" hidden="hidden" id="urlIndex" value="<?php echo base_url('transaction'); ?>">
                    <input type="text" hidden="hidden" id="urlLoadTab" value="<?php echo base_url('api/transaction/search')?>">
                    <input type="text" hidden="hidden" id="itemTypeId" value="<?php echo $itemTypeId; ?>">
                    <input type="hidden" value="<?=base_url('transaction/edit')?>" id="urlEditTransaction">
                    <input type="hidden" value="<?=base_url('customer/edit')?>" id="urlEditCustomer">
                    <input type="hidden" value="<?=base_url('order/edit')?>" id="urlEditOrder">
                    <?php $this->load->view('includes/modal/tag'); ?>
                    <?php $this->load->view('includes/modal/filter'); ?>
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>