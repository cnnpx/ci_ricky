<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('customer/add'); ?>" class="btn btn-primary">Thêm mới</a></li>
                    <li><button class="btn btn-default">Xuất file</button></li>
                    <li><button class="btn btn-default">Xuất file</button></li>
                </ul>
            </section>
            <section class="content">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="ulFilter">
                        <li class="active"><a href="#tab_0" data-id="0" data-toggle="tab" aria-expanded="true">Tất cả khách hàng</a></li>
                        <?php foreach ($listFilters as $f) { ?>
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
                                    <select class="form-control" id="field_select">
                                        <option value="group_money">Số tiền đã mua</option>
                                        <option value="group_order">Số đơn hàng</option>
                                        <option value="group_date">Thời điểm đặt hàng</option>
                                        <option value="group_email">Nhận email quảng cáo</option>
                                        <option value="">Có đơn hàng chưa hoàn tất</option>
                                        <option value="">Tình trạng tài khoản</option>
                                        <option value="">Được tag với</option>
                                        <option value="">Địa chỉ</option>
                                        <option value="">Nhóm khách hàng</option>
                                        <option value="">Tháng sinh</option>
                                    </select>
                                    </select>
                                </div>
                                <div class="form-group  mb10 group_money group_order">
                                    <div class="text_opertor">là</div>
                                    <input class="value_operator" value="is" type="hidden"/>
                                </div>
                                <div class="form-group block-display mb10">
                                    <!-- group_money group_order field đây là các filter được sử dụng tùy chọn này-->
                                    <select class="form-control group_money group_order">
                                        <option value="=">bằng</option>
                                        <option value="<>">khác</option>
                                        <option value="<">nhỏ hơn</option>
                                        <option value=">">lớn hơn</option>
                                    </select>
                                    <select class="form-control group_date">
                                        <option value="">trong tuần vừa qua</option>
                                        <option value="">trong tháng vừa qua</option>
                                        <option value="">trong ba tháng vừa qua</option>
                                        <option value="">trước</option>
                                        <option value="">sau</option>
                                        <option value="">trong ngày hôm nay</option>
                                        <option value="">trong ngày hôm qua</option>
                                    </select>
                                    <select class="form-control group_email">
                                        <option value="">Có</option>
                                        <option value="">Không</option>
                                    </select>
                                </div>
                                <div class="form-group block-display mb10">
                                    <!-- group_money group_order field đây là các filter được sử dụng input này-->
                                    <input class="form-control group_money group_order" type="text">
                                    <input class="form-control group_date datepicker" type="text">
                                </div>
                                <div class="form-group block-display widthauto">
                                    <!-- data-href : Đây là link gọi để filter mỗi trang sẽ có 1 link khác nhau -->
                                    <button id="btn-filter" data-href="<?php echo base_url('/customer/search'); ?>" type="submit" data-toggle="dropdown" class="btn btn-default">Thêm điều kiện lọc</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="itemSearchName">
                    <span class="input-group-btn">
                        <button id="btn-save-filter" disabled="true" type="button" data-toggle="modal" data-target="#save-filter"
                                class="btn btn-disable">Lưu bộ lọc</button>
                    </span>
                    <span class="input-group-btn">
                        <button id="remove-filter" type="button" disabled="true" class="btn btn-disable"><i class="fa fa-times"></i></button>
                    </span>
                </div>
                <div><ul id="container-filters"></ul></div>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="h3Title"><?php echo $title; ?></h3>
                        <select class="form-control input-sm select-action" id="selectAction" style="display: none;">
                            <option value="">Chọn hành động</option>
                            <option value="delete_item">Xóa Khách hàng được chọn</option>
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
                                <th><input type="checkbox" class="iCheckTable" id="checkAll"></th>
                                <th>Tên khách hàng</th>
                                <th>Địa điểm</th>
                                <th>Tổng đơn hàng</th>
                                <th>Đơn hàng gần nhất</th>
                                <th>Tổng tiền</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyCustomer">
                            <?php foreach ($listCustomers as $c) { ?>
                                <tr id="trItem_<?php echo $c['CustomerId']; ?>">
                                    <td><input type="checkbox" class="iCheckTable iCheckItem"
                                               value="<?php echo $c['CustomerId']; ?>"></td>
                                    <td>
                                        <a href="<?php echo base_url('customer/edit/' . $c['CustomerId']); ?>"><?php echo $c['FullName']; ?></a>
                                    </td>
                                    <td><?php echo $this->Mconstants->getObjectValue($listProvinces, 'ProvinceId', $c['ProvinceId'], 'ProvinceName'); ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="6" class="paginate_table">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="deleteItemUrl" value="<?php echo base_url('api/customer/deleteBatch'); ?>">
                    <input type="text" hidden="hidden" id="itemTypeId" value="5">
                    <?php $this->load->view('includes/modal/tag'); ?>
                </div>
            </section>
        </div>
        <!--Popup save filter data-->
        <div class="modal fade" role="dialog" id="save-filter">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 500px;margin: 0px auto">
                    <input type="hidden" name="item_type" id="item-type" value="<?= $itemTypeId ?>"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Bạn muốn lưu tìm kiếm này như thế nào?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb0">
                            <label for="save-new-search" class="next-label">
                                <input type="radio" name="option_save" checked class=" hrv-radio"
                                       id="ra-save-new-filter">
                                Lưu tìm kiếm mới
                            </label>
                        </div>
                        <div class="form-group mb0">
                            <label for="overwrite-saved-search" class="next-label">
                                <input type="radio" class=" hrv-radio" name="option_save"
                                       id="ra-save-exits-filter">
                                Lưu đè lên tìm kiếm đã tồn tại
                            </label>
                        </div>

                        <div class="form-group mt10" id="input-name-new">
                            <label class="next-label" for="new-saved-search-name">Tên</label>
                            <input id="new-save-name" name="name_new" class="form-control" type="text">
                        </div>

                        <div class="form-group mt10 none-display" id="input-name-exits">
                            <label for="new-saved-search-name" class="center-block next-label">Tìm kiếm nào bạn muốn lưu
                                đè?</label>
                            <select class="form-control" id="filter_list_name">
                                <option selected value="">Chưa có gì</option>
                                <?php foreach ($listFilters as $f): ?>
                                    <option value="<?=$f['FilterId']?>"><?=$f['FilterName']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-dismiss="modal">Hủy
                        </button>
                        <button type="button" data-url="<?=base_url('filter/save')?>" class="btn btn-primary" id="btn-save-filter">Lưu</button>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>