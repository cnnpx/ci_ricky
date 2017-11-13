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
                <?php $this->load->view('includes/notice'); ?>
                <?php if($storeId > 0){ ?>
                <?php echo form_open('store/saveStore', array('id' => 'storeForm')); ?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Tên cơ sở <span class="required">*</span></label>
                            <input type="text" name="StoreName" class="form-control hmdrequired" value="<?php echo $store['StoreName']; ?>" data-field="Tên cơ sở">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Mã cơ sở <span class="required">*</span></label>
                            <input type="text" name="StoreCode" class="form-control hmdrequired" value="<?php echo $store['StoreCode']; ?>" data-field="Mã cơ sở">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Loại</label>
                            <?php $this->Mconstants->selectConstants('storeTypes', 'StoreTypeId', $store['StoreTypeId']); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Tỉnh/ Thành phố</label>
                            <?php $this->Mconstants->selectObject($listProvinces, 'ProvinceId', 'ProvinceName', 'ProvinceId', $store['ProvinceId'], false, '', ' select2'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Quận/ Huyện</label>
                            <?php echo $this->Mdistricts->selectHtml($store['DistrictId']); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Địa chỉ <span class="required">*</span></label>
                            <input type="text" name="Address" class="form-control hmdrequired" value="<?php echo $store['Address']; ?>" data-field="Địa chỉ">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Tình trạng</label>
                            <?php $this->Mconstants->selectConstants('itemStatus', 'ItemStatusId', $store['ItemStatusId']); ?>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label">Ghi chú</label>
                            <input type="text" name="Comment" class="form-control" value="<?php echo $store['Comment']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Người phụ trách</label>
                            <?php $this->Mconstants->selectObject($listUsers, 'UserId', 'FullName', 'HeadUserId', $store['HeadUserId'], false, '', ' select2'); ?>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label">Danh sách Nhân viên</label>
                            <?php $this->Mconstants->selectObject($listUsers, 'UserId', 'FullName', 'UserId', $listUserIds, false, '', ' select2', ' multiple="multiple" data-placeholder="Chọn Nhân viên"'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group text-right">
                    <input type="text" name="StoreId" id="storeId" hidden="hidden" value="<?php echo $storeId; ?>">
                    <input type="text" name="UserIds" id="userIds" hidden="hidden" value="<?php echo json_encode($listUserIds); ?>">
                    <input class="btn btn-primary submit" type="submit" name="submit" value="Cập nhật">
                </div>
                <?php echo form_close(); ?>
                <?php } ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>