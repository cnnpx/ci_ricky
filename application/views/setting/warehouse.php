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
                                <th>Kho</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyWarehouse">
                            <?php
                            foreach($listWarehouses as $w){ ?>
                                <tr id="warehouse_<?php echo $w['WarehouseId']; ?>">
                                    <td id="warehouseName_<?php echo $w['WarehouseId']; ?>"><?php echo $w['WarehouseName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $w['WarehouseId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $w['WarehouseId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('warehouse/update', array('id' => 'warehouseForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="warehouseName" name="WarehouseName" value="" data-field="Kho"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="WarehouseId" id="warehouseId" value="0" hidden="hidden">
                                    <input type="text" id="deleteWarehouseUrl" value="<?php echo base_url('warehouse/delete'); ?>" hidden="hidden">
                                    <input type="text" hidden="hidden" id="updateWarehouse" value="<?php echo $updateWarehouse ? 1 : 0; ?>">
                                    <input type="text" hidden="hidden" id="deleteWarehouse" value="<?php echo $deleteWarehouse ? 1 : 0; ?>">
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