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
                                <th>Chức vụ</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyPosition">
                            <?php
                            foreach($listPositions as $p){ ?>
                                <tr id="position_<?php echo $p['PositionId']; ?>">
                                    <td id="positionName_<?php echo $p['PositionId']; ?>"><?php echo $p['PositionName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $p['PositionId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $p['PositionId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('position/update', array('id' => 'positionForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="positionName" name="PositionName" value="" data-field="Chức vụ"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="PositionId" id="positionId" value="0" hidden="hidden">
                                    <input type="text" id="deletePositionUrl" value="<?php echo base_url('position/delete'); ?>" hidden="hidden">
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