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
                                <th>Lý do hủy đơn hàng</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyCancelReason">
                            <?php
                            foreach($listCancelReasons as $cr){ ?>
                                <tr id="cancelReason_<?php echo $cr['CancelReasonId']; ?>">
                                    <td id="cancelReasonName_<?php echo $cr['CancelReasonId']; ?>"><?php echo $cr['CancelReasonName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $cr['CancelReasonId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $cr['CancelReasonId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('cancelreason/update', array('id' => 'cancelReasonForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="cancelReasonName" name="CancelReasonName" value="" data-field="Lý do hủy đơn hàng"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="CancelReasonId" id="cancelReasonId" value="0" hidden="hidden">
                                    <input type="text" id="deleteCancelReasonUrl" value="<?php echo base_url('cancelreason/delete'); ?>" hidden="hidden">
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