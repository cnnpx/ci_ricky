<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><button class="btn btn-primary submit">Lưu</button></li>
                    <li><a href="<?php echo base_url('store'); ?>" id="storeListUrl" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php echo form_open('store/saveStore', array('id' => 'storeForm')); ?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Tên cơ sở <span class="required">*</span></label>
                            <input type="text" name="StoreName" class="form-control hmdrequired" value="" data-field="Tên cơ sở">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Mã cơ sở <span class="required">*</span></label>
                            <input type="text" name="StoreCode" class="form-control hmdrequired" value="" data-field="Mã cơ sở">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Loại</label>
                            <?php $this->Mconstants->selectConstants('storeTypes', 'StoreTypeId'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Tỉnh/ Thành phố</label>
                            <?php $this->Mconstants->selectObject($listProvinces, 'ProvinceId', 'ProvinceName', 'ProvinceId', 0, false, '', ' select2'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Quận/ Huyện</label>
                            <?php echo $this->Mdistricts->selectHtml(); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Địa chỉ <span class="required">*</span></label>
                            <input type="text" name="Address" class="form-control hmdrequired" value="" data-field="Địa chỉ">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Tình trạng</label>
                            <?php $this->Mconstants->selectConstants('itemStatus', 'ItemStatusId'); ?>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label">Ghi chú</label>
                            <input type="text" name="Comment" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Người phụ trách</label>
                            <?php $this->Mconstants->selectObject($listUsers, 'UserId', 'FullName', 'HeadUserId', 0, true, '--Chọn nhân viên--', ' select2'); ?>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label">Danh sách Nhân viên</label>
                            <?php $this->Mconstants->selectObject($listUsers, 'UserId', 'FullName', 'UserId', 0, false, '', ' select2', ' multiple="multiple" data-placeholder="Chọn Nhân viên"'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group text-right">
                    <input type="text" name="StoreId" id="storeId" hidden="hidden" value="0">
                    <input type="text" name="UserIds" id="userIds" hidden="hidden" value="">
                    <input class="btn btn-primary submit" type="submit" name="submit" value="Cập nhật">
                </div>
                <?php echo form_close(); ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>