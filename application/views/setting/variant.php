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
                                <th>Thuộc tính</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyVariant">
                            <?php
                            foreach($listVariants as $v){ ?>
                                <tr id="variant_<?php echo $v['VariantId']; ?>">
                                    <td id="variantName_<?php echo $v['VariantId']; ?>"><?php echo $v['VariantName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $v['VariantId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $v['VariantId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('variant/update', array('id' => 'variantForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="variantName" name="VariantName" value="" data-field="Thuộc tính"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="VariantId" id="variantId" value="0" hidden="hidden">
                                    <input type="text" id="deleteVariantUrl" value="<?php echo base_url('variant/delete'); ?>" hidden="hidden">
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