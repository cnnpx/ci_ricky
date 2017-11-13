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
                                <th>Dịch vụ đơn hàng</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyOtherService">
                            <?php
                            foreach($listOtherServices as $os){ ?>
                                <tr id="otherService_<?php echo $os['OtherServiceId']; ?>">
                                    <td id="otherServiceName_<?php echo $os['OtherServiceId']; ?>"><?php echo $os['OtherServiceName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $os['OtherServiceId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $os['OtherServiceId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('otherservice/update', array('id' => 'otherServiceForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="otherServiceName" name="OtherServiceName" value="" data-field="Dịch vụ đơn hàng"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="OtherServiceId" id="otherServiceId" value="0" hidden="hidden">
                                    <input type="text" id="deleteOtherServiceUrl" value="<?php echo base_url('otherservice/delete'); ?>" hidden="hidden">
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