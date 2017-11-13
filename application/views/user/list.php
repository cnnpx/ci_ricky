<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php $this->load->view('includes/breadcrumb'); ?>
            <section class="content">
                <div class="box box-default">
                    <?php sectionTitleHtml('Tìm kiếm'); ?>
                    <div class="box-body row-margin">
                        <?php echo form_open('user/staff'); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" name="UserName" class="form-control" value="<?php echo set_value('UserName'); ?>" placeholder="UserName">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="FullName" class="form-control" value="<?php echo set_value('FullName'); ?>" placeholder="Họ và tên">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="Email" class="form-control" value="<?php echo set_value('Email'); ?>" placeholder="Email">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="PhoneNumber" class="form-control" value="<?php echo set_value('PhoneNumber'); ?>" placeholder="Số điện thoại">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" name="DegreeName" class="form-control" value="<?php echo set_value('DegreeName'); ?>" placeholder="Bằng cấp">
                            </div>
                            <div class="col-sm-3">
                                <?php $this->Mconstants->selectConstants('status', 'StatusId', set_value('StatusId'), true, 'Trạng thái'); ?>
                            </div>
                            <div class="col-sm-3">
                                <?php $this->Mconstants->selectObject($listProvinces, 'ProvinceId', 'ProvinceName', 'ProvinceId', set_value('ProvinceId'), true, 'Tỉnh/ Thành phố', ' select2'); ?>
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Tìm kiếm">
                                <input type="text" hidden="hidden" name="PageId" id="pageId" value="<?php echo set_value('PageId'); ?>">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="box box-success">
                    <?php sectionTitleHtml($title, isset($paggingHtml) ? $paggingHtml : ''); ?>
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Avatar</th>
                                <th>Tên</th>
                                <th>SĐT</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th>Bằng cấp</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyUser">
                            <?php $i = 0;
                            $status = $this->Mconstants->status;
                            $labelCss = $this->Mconstants->labelCss;
                            foreach($listUsers as $u){
                                $i++; ?>
                                <tr id="user_<?php echo $u['UserId']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('user/edit/'.$u['UserId']); ?>"><img class="img-table" src="<?php echo USER_PATH.$u['Avatar']; ?>" alt="<?php echo $u['FullName']; ?>"></a>
                                    </td>
                                    <td><a href="<?php echo base_url('user/edit/'.$u['UserId']); ?>"><?php echo $u['FullName']; ?></a></td>
                                    <td><?php echo $u['PhoneNumber']; ?></td>
                                    <td><?php echo ddMMyyyy($u['BirthDay']); ?></td>
                                    <td><?php echo $u['Address']; ?></td>
                                    <td><?php echo $u['DegreeName']; ?></td>
                                    <td id="statusName_<?php echo $u['UserId']; ?>"><span class="<?php echo $labelCss[$u['StatusId']]; ?>"><?php echo $status[$u['StatusId']]; ?></span></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $u['UserId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                        <div class="btn-group" id="btnGroup_<?php echo $u['UserId']; ?>">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-check"></i><span class="caret"></span> </button>
                                            <ul class="dropdown-menu">
                                                <?php foreach($status as $j => $v){ ?>
                                                    <li><a href="javascript:void(0)" class="link_status" data-id="<?php echo $u['UserId']; ?>" data-status="<?php echo $j; ?>"><?php echo $v; ?></a></li>
                                                <?php }  ?>
                                            </ul>
                                        </div>
                                        <input type="text" hidden="hidden" id="statusId_<?php echo $u['UserId']; ?>" value="<?php echo $u['StatusId']; ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="deleteUser" value="<?php echo $deleteUser ? 1 : 0; ?>">
                    <input type="text" hidden="hidden" id="changeStatus" value="<?php echo $changeStatus ? 1 : 0; ?>">
                    <input type="text" hidden="hidden" id="changeStatusUrl" value="<?php echo base_url('api/user/changeStatus'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>