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
                                <th>Lý do mua hàng</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyOrderReason">
                            <?php
                            foreach($listOrderReasons as $or){ ?>
                                <tr id="orderReason_<?php echo $or['OrderReasonId']; ?>">
                                    <td id="orderReasonName_<?php echo $or['OrderReasonId']; ?>"><?php echo $or['OrderReasonName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $or['OrderReasonId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $or['OrderReasonId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('orderreason/update', array('id' => 'orderReasonForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="orderReasonName" name="OrderReasonName" value="" data-field="Lý do mua hàng"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="OrderReasonId" id="orderReasonId" value="0" hidden="hidden">
                                    <input type="text" id="deleteOrderReasonUrl" value="<?php echo base_url('orderreason/delete'); ?>" hidden="hidden">
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