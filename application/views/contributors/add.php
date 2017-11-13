<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('includes/breadcrumb'); ?>
        <section class="content" style="background: #FFFFFF;margin-top: 10px;">
            <?php echo form_open('contributors/update', array('id' => 'contributorsForm','class' => 'form-horizontal')); ?>
            <div class="row col-sm-offset-1">
                <div class="form-group">
                    <label class="form-label col-sm-2">Tên cổ phần <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="ContributorName" id="contributorName" class="form-control hmdrequired" value="" data-field="Tên cổ phần">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-sm-2">Điện thoại <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="ContributorPhone" id="contributorPhone" class="form-control hmdrequired" value="" data-field="Điện thoại">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-sm-2">Ngày hoạt động <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control hmdrequired datepicker" name="BirthDay" id ="birthDay"autocomplete="off" data-field="Ngày hoạt động">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-sm-2">Địa chỉ</label>
                    <div class="col-sm-8">
                        <input type="text" name="Address" id="address" class="form-control hmdrequired" value="" data-field="Địa chỉ">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="text" id="contributorId" hidden="hidden" value="0">
                        <input type="text" id="contributorEditUrl" hidden="hidden" value=" <?php echo base_url('contributors'); ?>">
                        <input class="btn btn-primary" id="submit" type="submit" name="submit" value="Tạo mới">
                        <a href="contributors" class="btn btn-danger">Hủy bỏ</a>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>
<?php $this->load->view('includes/footer'); ?>
