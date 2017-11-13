<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php $this->load->view('includes/breadcrumb'); ?>
            <section class="content">
                <?php echo form_open('api/user/saveUser', array('id' => 'userForm')); ?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Họ và tên <span class="required">*</span></label>
                            <input type="text" name="FullName" class="form-control hmdrequired" value="" data-field="Họ và tên">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Tên đăng nhập <span class="required">*</span></label>
                            <input type="text" name="UserName" id="userName" class="form-control hmdrequired" value="" data-field="Tên đăng nhập">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Di động</label>
                            <input type="text" name="PhoneNumber" id="phoneNumber" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Facebook</label>
                            <input type="text" name="Facebook" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Giới tính</label>
                            <?php $this->Mconstants->selectConstants('genders', 'GenderId'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Trạng thái</label>
                            <?php $this->Mconstants->selectConstants('status', 'StatusId'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Email <span class="required">*</span></label>
                            <input type="text" name="Email" class="form-control hmdrequired" value="" data-field="Email">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Ngày sinh <span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control hmdrequired datepicker" name="BirthDay" value="" autocomplete="off" data-field="Ngày sinh">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Bằng cấp</label>
                            <input type="text" name="DegreeName" class="form-control" value="">
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
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label">Địa chỉ <span class="required">*</span></label>
                            <input type="text" name="Address" class="form-control hmdrequired" value="" data-field="Địa chỉ">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php $avatar = (set_value('Avatar')) ? set_value('Avatar') : NO_IMAGE; ?>
                            <img src="<?php echo USER_PATH.$avatar; ?>" class="chooseImage" id="imgAvatar" style="width: 200px;height: 200px;display: block;">
                            <input type="text" hidden="hidden" name="Avatar" id="avatar" value="<?php echo $avatar; ?>">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Mật khẩu <span class="required">*</span></label>
                                    <input type="text" id="newPass" name="UserPass" class="form-control hmdrequired" value="" data-field="Mật khẩu">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Gõ lại Mật khẩu <span class="required">*</span></label>
                                    <input type="text" id="rePass" class="form-control hmdrequired" value="" data-field="Mật khẩu">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="javascript:void(0)" class="btn btn-default" id="generatorPass">Sinh Mật khẩu</a>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label"><input type="checkbox" name="IsSendPass" class="iCheck" checked="checked"> Gửi mật khẩu vào email</label>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <input type="text" name="UserId" id="userId" hidden="hidden" value="0">
                            <input type="text" id="userEditUrl" hidden="hidden" value="<?php echo base_url('user/edit'); ?>">
                            <input class="btn btn-primary" id="submit" type="submit" name="submit" value="Cập nhật">
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>