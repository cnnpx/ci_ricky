<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('promotion/add'); ?>" class="btn btn-primary">Tạo khuyến mại</a></li>
                </ul>
            </section>
            <section class="content">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="ulFilter">
                        <li class="active"><a href="#tab_0" data-id="0" data-toggle="tab" aria-expanded="true">Tất cả khuyến mại</a></li>
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
                    <?php $promotionStatus = $this->Mconstants->promotionStatus; ?>
                    <div class="box-header with-bpromotion">
                        <h3 class="box-title" id="h3Title"><?php echo $title; ?></h3>
                        <select class="form-control input-sm select-action" id="selectAction" style="display: none;">
                            <option value="">Chọn hành động</option>
                            <option value="change_status-4">Ngừng khuyến mại (đã chọn)</option>
                            <option value="">Sử dụng khuyến mại (đã chọn)</option>
                            <option value="change_status-0">Xóa khuyến mại (đã chọn)</option>
                        </select>
                        <?php if(isset($paggingHtml)){ ?>
                            <div class="box-tools pull-right">
                                <?php echo $paggingHtml; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bpromotioned">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="iCheckTable" id="checkAll"></th>
                                <th>Mã/ Tên</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                                <th>Số lần sử dụng</th>
                                <th>Bắt đầu/ kết thúc</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyPromotion">
                            <?php $labelCss = $this->Mconstants->labelCss;
                            $promotionTypes = $this->Mconstants->promotionTypes;
                            $discountTypes = $this->Mconstants->discountTypes;
                            $customerNames = array();
                            $productNames = array();
                            $productChildNames = array();
                            foreach($listPromotions as $p){ ?>
                                <tr id="trItem_<?php echo $p['PromotionId']; ?>">
                                    <td><input type="checkbox" class="iCheckTable iCheckItem" value="<?php echo $p['PromotionId']; ?>"></td>
                                    <td><?php echo $p['PromotionName']; ?></td>
                                    <td><span class="<?php echo $labelCss[$p['PromotionTypeId']]; ?>"><?php echo $promotionTypes[$p['PromotionTypeId']]; ?></span></td>
                                    <td><span class="<?php echo $labelCss[$p['PromotionStatusId']]; ?>"><?php echo $promotionStatus[$p['PromotionStatusId']]; ?></span></td>
                                    <td>
                                        <?php if($p['ReduceTypeId'] == 3){
                                            echo 'Miễn phí vận chuyển đối với mức phí vận chuyển nhỏ hơn hoặc bằng '.$p['ReduceNumber'].' VNĐ áp dụng cho ';
                                            if($p['ProvinceId'] > 0) echo $this->Mconstants->getObjectValue($listProvinces, 'ProvinceId', $p['ProvinceId'], 'ProvinceName');
                                            else echo 'tất cả tỉnh thành';
                                        }
                                        else{
                                            echo 'Giảm '.priceFormat($p['ReduceNumber']);
                                            if($p['ReduceTypeId'] == 1) echo ' VNĐ ';
                                            else echo ' % ';
                                            if($p['PromotionItemTypeId'] == 0) echo 'cho tất cả đơn hàng';
                                            elseif($p['PromotionItemTypeId'] == 6) echo 'cho đơn hàng có giá trị từ '.priceFormat($p['MinimumCost']).' VNĐ';
                                            elseif($p['PromotionItemId'] > 0){
                                                if($p['PromotionItemTypeId'] == 1){
                                                    echo 'cho Nhóm sản phẩm '.$this->Mconstants->getObjectValue($listCategories, 'CategoryId', $p['PromotionItemId'], 'CategoryName');
                                                    echo ' ('.$discountTypes[$p['DiscountTypeId']].')';
                                                }
                                                elseif($p['PromotionItemTypeId'] == 11) echo 'cho Nhóm khách hàng '.$this->Mconstants->getObjectValue($listCustomerGroups, 'CustomerGroupId', $p['PromotionItemId'], 'CustomerGroupName');
                                                elseif($p['PromotionItemTypeId'] == 3){
                                                    echo 'cho Sản phẩm ';
                                                    if(!isset($productNames[$p['PromotionItemId']])) $productNames[$p['PromotionItemId']] = $this->Mproducts->getProductName($p['PromotionItemId']);
                                                    echo $productNames[$p['PromotionItemId']].' ('.$discountTypes[$p['DiscountTypeId']].')';
                                                }
                                                elseif($p['PromotionItemTypeId'] == 13){ //sp con
                                                    echo 'cho Sản phẩm ';
                                                    if(!isset($productChildNames[$p['PromotionItemId']])) $productChildNames[$p['PromotionItemId']] = $this->Mproducts->getProductName(0, $p['PromotionItemId']);
                                                    echo $productChildNames[$p['PromotionItemId']];
                                                }
                                                elseif($p['PromotionItemTypeId'] == 5){
                                                    echo 'cho Khách hàng ';
                                                    if(!isset($customerNames[$p['PromotionItemId']])) $customerNames[$p['PromotionItemId']] = $this->Mcustomers->getFieldValue(array('CustomerId' => $p['PromotionItemId']), 'FullName');
                                                    echo $customerNames[$p['PromotionItemId']];
                                                }
                                            }
                                        }
                                        if($p['PromotionTypeId'] == 2 && $p['ProductNumber'] > 0) echo ' (số lượng tối thiểu là '.$p['ProductNumber'].')'; ?>
                                    </td>
                                    <td>0/ <?php echo $p['NumberUse'] > 0 ? $p['NumberUse'] : '∞' ?></td>
                                    <td>
                                        <p>Bắt đâu: <span><?php echo ddMMyyyy($p['BeginDate']); ?></span></p>
                                        <p>Kết thúc: <span><?php echo empty($p['EndDate']) ? '--' : ddMMyyyy($p['EndDate']); ?></span></p>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="changeItemStatusUrl" value="<?php echo base_url('promotion/changeStatusBatch'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>