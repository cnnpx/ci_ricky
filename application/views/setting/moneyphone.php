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
                                <th>Máy nạp tiền</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyMoneyPhone">
                            <?php
                            foreach($listMoneyPhones as $ms){ ?>
                                <tr id="moneyPhone_<?php echo $ms['MoneyPhoneId']; ?>">
                                    <td id="moneyPhoneName_<?php echo $ms['MoneyPhoneId']; ?>"><?php echo $ms['MoneyPhoneName']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_edit" data-id="<?php echo $ms['MoneyPhoneId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $ms['MoneyPhoneId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <?php echo form_open('moneyphone/update', array('id' => 'moneyPhoneForm')); ?>
                                <td><input type="text" class="form-control hmdrequired" id="moneyPhoneName" name="MoneyPhoneName" value="" data-field="Máy nạp tiền"></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" id="link_update" title="Cập nhật"><i class="fa fa-save"></i></a>
                                    <a href="javascript:void(0)" id="link_cancel" title="Thôi"><i class="fa fa-times"></i></a>
                                    <input type="text" name="MoneyPhoneId" id="moneyPhoneId" value="0" hidden="hidden">
                                    <input type="text" id="deleteMoneyPhoneUrl" value="<?php echo base_url('moneyphone/delete'); ?>" hidden="hidden">
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