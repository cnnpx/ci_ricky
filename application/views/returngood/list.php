<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('returngood/add'); ?>" class="btn btn-primary">Tạo Đơn hoàn hàng về</a></li>
                    <li><button class="btn btn-default">Xuất dữ liệu</button></li>
                </ul>
            </section>
            <section class="content">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="ulFilter">
                        <li class="active"><a href="#tab_0" data-id="0" data-toggle="tab" aria-expanded="true">Tất cả Đơn hoàn hàng về</a></li>
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
                <div class="box box-success">
                    <?php $transportStatus = $this->Mconstants->transportStatus; ?>
                    <div class="box-header with-border">
                        <h3 class="box-title" id="h3Title"><?php echo $title; ?></h3>
                        <select class="form-control input-sm select-action" id="selectAction" style="display: none;">
                            <option value="">Chọn hành động</option>
                            <option value="change_status-0">Xóa đơn đã chọn</option>
                            <?php foreach($transportStatus as $i => $v){ ?>
                                  <option value="change_status-<?php echo $i; ?>"><?php echo $v; ?></option>
                            <?php } ?>
                            <option value="add_tags">Thêm nhãn</option>
                            <option value="delete_tags">Bỏ nhãn</option>
                        </select>
                        <?php if(isset($paggingHtml)){ ?>
                            <div class="box-tools pull-right">
                                <?php echo $paggingHtml; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="iCheckTable" id="checkAll"></th>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Cơ sở nhập hàng</th>
                                <th>Trạng thái</th>
                                <th>Loại</th>
                                <th>Ngày tạo</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyReturnGood">
                            <?php  $labelCss = $this->Mconstants->labelCss;
                            $returnGoodTypes = $this->Mconstants->returnGoodTypes;
                            $orderCodes = array();
                            foreach($listReturnGoods as $rg){ ?>
                                <tr id="trItem_<?php echo $rg['ReturnGoodId']; ?>">
                                    <td><input type="checkbox" class="iCheckTable iCheckItem" value="<?php echo $rg['ReturnGoodId']; ?>"></td>
                                    <td><a href="<?php echo base_url('returngood/edit/'.$rg['ReturnGoodId']); ?>"><?php echo $rg['ReturnGoodCode']; ?></a></td>
                                    <td><a href="<?php echo base_url('customer/edit/'.$rg['CustomerId']); ?>"><?php echo $this->Mconstants->getObjectValue($listCustomers, 'CustomerId', $rg['CustomerId'], 'FullName'); ?></a></td>
                                    <td><?php echo $this->Mconstants->getObjectValue($listStores, 'StoreId', $rg['StoreId'], 'StoreName'); ?></td>
                                    <td id="statusName_<?php echo $rg['ReturnGoodId']; ?>"><span class="<?php echo $labelCss[$rg['TransportStatusId']]; ?>"><?php echo $transportStatus[$rg['TransportStatusId']]; ?></span></td>
                                    <td><span class="<?php echo $labelCss[$rg['ReturnGoodTypeId']]; ?>"><?php echo $returnGoodTypes[$rg['ReturnGoodTypeId']]; ?></span></td>
                                    <td><?php echo ddMMyyyy($rg['CrDateTime'], 'd/m/Y H:i:s'); ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="changeItemStatusUrl" value="<?php echo base_url('api/returngood/changeStatusBatch'); ?>">
                    <input type="text" hidden="hidden" id="itemTypeId" value="14">
                    <?php $this->load->view('includes/modal/tag'); ?>
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>