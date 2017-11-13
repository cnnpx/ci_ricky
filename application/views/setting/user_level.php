<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php $this->load->view('includes/breadcrumb'); ?>
            <section class="content">
                <div class="box box-success">
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Level (Thâm niên)</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyUserLevel">
                            <?php
                            foreach($listUserLevels as $ul){ ?>
                                <tr id="userLevel_<?php echo $ul['UserLevelId']; ?>">
                                    <td id="userLevelName_<?php echo $ul['UserLevelId']; ?>"><?php echo $ul['UserLevelName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $ul['UserLevelId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $ul['UserLevelId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('userlevel/update', array('id' => 'userLevelForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="userLevelName" name="UserLevelName" value="" data-field="Level (Thâm niên)"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="UserLevelId" id="userLevelId" value="0" hidden="hidden">
                                    <input type="text" id="deleteUserLevelUrl" value="<?php echo base_url('userlevel/delete'); ?>" hidden="hidden">
                                </td>
                                <?php echo form_close(); ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>