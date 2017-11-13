<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <?php if($canEdit){ ?><li><button class="btn btn-primary submit">Lưu</button></li><?php } ?>
                    <li><a href="<?php echo base_url('transaction'); ?>" class="btn btn-default cancel">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php $this->load->view('includes/notice'); ?>
                <?php if($transactionId > 0){ ?>
                <?php echo form_open('api/transaction/update', array('id' => 'transactionForm')); ?>
                <div class="row">
                    <?php if($canEdit){ ?>
                    <div class="col-sm-4">
                        <label class="control-label normal">Tìm kiếm Khách hàng</label>
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
                    <?php } ?>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label normal">Khách hàng đã chọn</label>
                            <input class="form-control" id="customerName" disabled value="<?php echo $customerName; ?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label normal">Đơn hàng <span class="required">*</span></label>
                            <select id="orderId" class="form-control">
                                <option value="0">Chọn đơn hàng</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label normal">Loại phiếu</label>
                            <?php $this->Mconstants->selectConstants('transactionTypes', 'TransactionTypeId', $transaction['TransactionTypeId']); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label normal">Nguồn tiền</label>
                            <?php $this->Mconstants->selectObject($listMoneySources, 'MoneySourceId', 'MoneySourceName', 'MoneySourceId', $transaction['MoneySourceId']); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label normal">Số tiền <span class="required">*</span></label>
                            <input class="form-control" type="text" id="paidCost" value="<?php echo priceFormat($transaction['PaidCost']); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label normal">Trạng thái</label>
                            <?php $this->Mconstants->selectConstants('transactionStatus', 'TransactionStatusId', $transaction['TransactionStatusId']); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label normal">Từ cơ sở</label>
                            <?php $this->Mconstants->selectObject($listStores, 'StoreId', 'StoreName', 'StoreId', $transaction['StoreId'], true, '--Chọn cơ sở--', ' select2'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4" id="divMoneyPhone" style="display: none;">
                        <div class="form-group">
                            <label class="control-label normal">Nạp vào máy <span class="required">*</span></label>
                            <?php $this->Mconstants->selectObject($listMoneyPhones, 'MoneyPhoneId', 'MoneyPhoneName', 'MoneyPhoneId', $transaction['MoneyPhoneId'], true, '-Chọn số máy-'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label normal">Nhãn (cách nhau bởi dấu phẩy)</label>
                            <input type="text" class="form-control" id="tags">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label normal">Ghí chú</label>
                            <textarea rows="3" class="form-control" id="comment"><?php echo $transaction['Comment']; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('includes/action_logs'); ?>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li>
                    <li><a href="<?php echo base_url('transaction'); ?>" id="transactionListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="getListCustomerUrl" value="<?php echo base_url('api/customer/getList'); ?>">
                    <input type="text" hidden="hidden" id="getListOrderUrl" value="<?php echo base_url('api/order/getList01');?>">
                    <input type="text" hidden="hidden" id="transactionId" value="<?php echo $transactionId; ?>">
                    <input type="text" hidden="hidden" id="customerId" value="<?php echo $transaction['CustomerId']; ?>">
                    <input type="text" hidden="hidden" id="orderId1" value="<?php echo $transaction['OrderId']; ?>">
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