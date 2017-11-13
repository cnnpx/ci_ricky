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
                                <th>Nguồn tiền</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyMoneySource">
                            <?php
                            foreach($listMoneySources as $ms){ ?>
                                <tr id="moneySource_<?php echo $ms['MoneySourceId']; ?>">
                                    <td id="moneySourceName_<?php echo $ms['MoneySourceId']; ?>"><?php echo $ms['MoneySourceName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $ms['MoneySourceId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $ms['MoneySourceId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('moneysource/update', array('id' => 'moneySourceForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="moneySourceName" name="MoneySourceName" value="" data-field="Nguồn tiền"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="MoneySourceId" id="moneySourceId" value="0" hidden="hidden">
                                    <input type="text" id="deleteMoneySourceUrl" value="<?php echo base_url('moneysource/delete'); ?>" hidden="hidden">
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