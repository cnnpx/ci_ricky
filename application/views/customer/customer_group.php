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
                                <th>Nhóm Khách hàng</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyCustomerGroup">
                            <?php
                            foreach($listCustomerGroups as $cg){ ?>
                                <tr id="customerGroup_<?php echo $cg['CustomerGroupId']; ?>">
                                    <td id="customerGroupName_<?php echo $cg['CustomerGroupId']; ?>"><?php echo $cg['CustomerGroupName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $cg['CustomerGroupId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $cg['CustomerGroupId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('customergroup/update', array('id' => 'customerGroupForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="customerGroupName" name="CustomerGroupName" value="" data-field="Nhóm Khách hàng"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="CustomerGroupId" id="customerGroupId" value="0" hidden="hidden">
                                    <input type="text" id="deleteCustomerGroupUrl" value="<?php echo base_url('customergroup/delete'); ?>" hidden="hidden">
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