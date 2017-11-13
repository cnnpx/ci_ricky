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
                                <th>Bộ phận</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyPart">
                            <?php
                            foreach($listParts as $p){ ?>
                                <tr id="part_<?php echo $p['PartId']; ?>">
                                    <td id="partName_<?php echo $p['PartId']; ?>"><?php echo $p['PartName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $p['PartId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $p['PartId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('part/update', array('id' => 'partForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="partName" name="PartName" value="" data-field="Bộ phận"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="PartId" id="partId" value="0" hidden="hidden">
                                    <input type="text" id="deletePartUrl" value="<?php echo base_url('part/delete'); ?>" hidden="hidden">
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