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
                                <th>Loại vận chuyển</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyTransportType">
                            <?php
                            foreach($listTransportTypes as $ot){ ?>
                                <tr id="transportType_<?php echo $ot['TransportTypeId']; ?>">
                                    <td id="transportTypeName_<?php echo $ot['TransportTypeId']; ?>"><?php echo $ot['TransportTypeName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $ot['TransportTypeId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $ot['TransportTypeId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('transporttype/update', array('id' => 'transportTypeForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="transportTypeName" name="TransportTypeName" value="" data-field="Loại vận chuyển"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="TransportTypeId" id="transportTypeId" value="0" hidden="hidden">
                                    <input type="text" id="deleteTransportTypeIdUrl" value="<?php echo base_url('transporttype/delete'); ?>" hidden="hidden">
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