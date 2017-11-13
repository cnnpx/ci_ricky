<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><button class="btn btn-primary submit">Lưu</button></li>
                    <li><a href="<?php echo base_url('customer'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php echo form_open('api/customer/update', array('id' => 'customerForm')); ?>
                <div class="box box-default padding15">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin chung</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Loại khách hàng</label>
                                    <?php $this->Mconstants->selectConstants('customerTypes', 'CustomerTypeId'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"><span id="lableName">Họ tên</span> <span class="required">*</span></label>
                                    <input type="text" id="fullName" class="form-control hmdrequired" value="" data-field="Họ Tên">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Số điện thoại <span class="required">*</span></label>
                                    <input type="text" id="phoneNumber" class="form-control hmdrequired" value="" data-field="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Ngày sinh </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control datepicker" id="birthDay" value="" autocomplete="off" data-field="Ngày sinh">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Email </label>
                                    <input type="text" id="email" class="form-control " value="" data-field="Email">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Giới tính</label>
                                    <?php $this->Mconstants->selectConstants('genders', 'GenderId'); ?>
                                </div>
                            </div>
                        </div>
                        <div id="divCompany" style="display: none;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Chức vụ </label>
                                        <input type="text" id="positionName" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tên công ty </label>
                                        <input type="text" id="companyName" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Mã số thuế </label>
                                        <input type="text" id="taxCode" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-default padding15">
                    <div class="box-header with-border">
                        <h3 class="box-title">Địa chỉ</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">Địa chỉ </label>
                            <input type="text" id="address" class="form-control" value="" data-field="Địa chỉ">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="control-label">Tỉnh / Thành </label>
                                <?php $this->Mconstants->selectObject($listProvinces, 'ProvinceId', 'ProvinceName', 'ProvinceId', 0, false, '', ' select2'); ?>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label">Quận/ Huyện</label>
                                <?php echo $this->Mdistricts->selectHtml(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-default padding15">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tag</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Ghi chú </label>
                                        <input type="text" id="comment" class="form-control " value="" data-field="Ghi chú">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nhóm khách hàng </label>
                                        <?php $this->Mconstants->selectObject($listCustomersGroups, 'CustomerGroupId', 'CustomerGroupName', 'CustomerGroupId', 0, true, '--', ' select2'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Nhãn (cách nhau bởi dấu phẩy)</label>
                                        <input type="text" class="form-control" id="tags">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Thêm các nhãn đã có</label>
                                        <ul class="list-inline" id="ulTagExist">
                                            <?php foreach($listTags as $t){ ?>
                                                <li><a href="javascript:void(0)"><?php echo $t['TagName']; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="box box-default padding15">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cài đặt nâng cao</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Nhân viên chăm sóc chính </label>
                                    <?php $this->Mconstants->selectObject($listUsers, 'UserId', 'FullName', 'CareStaffId', 0, true, '--', ' select2'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Chiết khấu giá </label>
                                    <?php $this->Mconstants->selectConstants('discountType', 'DiscountTypeId', 0, true, '--'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Kì hạn thanh toán </label>
                                    <?php $this->Mconstants->selectConstants('paymentTime', 'PaymentTimeId', 0, true, '--'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li>
                    <li><a href="<?php echo base_url('customer'); ?>" id="customerListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="customerId" value="0">
                    <input type="text" hidden="hidden" id="customerTypeId" value="1">
                    <input type="text" hidden="hidden" id="statusId" value="2">
                    <input type="text" hidden="hidden" id="facebook" value="">
                </ul>
                <?php echo form_close(); ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>