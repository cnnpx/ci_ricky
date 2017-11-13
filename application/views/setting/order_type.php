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
                                <th>Loại đơn hàng</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyOrderType">
                            <?php
                            foreach($listOrderTypes as $ot){ ?>
                                <tr id="orderType_<?php echo $ot['OrderTypeId']; ?>">
                                    <td id="orderTypeName_<?php echo $ot['OrderTypeId']; ?>"><?php echo $ot['OrderTypeName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $ot['OrderTypeId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $ot['OrderTypeId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('ordertype/update', array('id' => 'orderTypeForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="orderTypeName" name="OrderTypeName" value="" data-field="Loại đơn hàng"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="OrderTypeId" id="orderTypeId" value="0" hidden="hidden">
                                    <input type="text" id="deleteOrderTypeUrl" value="<?php echo base_url('ordertype/delete'); ?>" hidden="hidden">
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