<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php $this->load->view('includes/breadcrumb'); ?>
            <section class="content">
                <?php echo form_open('supplier/update', array('id' => 'supplierForm')); ?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Mã nhà Cung cấp <span class="required">*</span></label>
                            <input type="text" id="supplierCode" class="form-control hmdrequired" value="<?php echo $supplier['SupplierCode']; ?>" data-field="Mã nhà Cung cấp">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Tên nhà Cung cấp <span class="required">*</span></label>
                            <input type="text" id="supplierName" class="form-control hmdrequired" value="<?php echo $supplier['SupplierName']; ?>" data-field="Tên nhà Cung cấp">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Loại</label><br/>
                            <div class="radio-group">
                                <span class="item"><input type="radio" name="SupplierType" class="stype" value="1" <?php if($supplier['SupplierTypeId'] == 1) echo ' checked'; ?>> Công ty</span>
                                <span class="item"><input type="radio" name="SupplierType" class="stype" value="2" <?php if($supplier['SupplierTypeId'] == 2) echo ' checked'; ?>> Cá nhân</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">,
                            <label class="control-label">Trạng thái</label>
                            <?php $this->Mconstants->selectConstants('itemStatus', 'ItemStatusId', $supplier['ItemStatusId']); ?>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label">Ghi chú</label>
                            <input type="text" id="comment" class="form-control" value="<?php echo $supplier['Comment']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div id="forCompany" style="display: block;">
                            <div class="form-group">
                                <label class="control-label">Mã số thuế </label>
                                <input type="text" id="taxCode" class="form-control" value="<?php echo $supplier['TaxCode']; ?>" data-field="Mã số thuế">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Cấp hoá đơn</label>
                                <div class="radio-group">
                                    <span class="item"><input type="radio" name="hasBill" class="hasBill" value="2" <?php if($supplier['HasBill'] == 2) echo ' checked'; ?>> Có</span>
                                    <span class="item"><input type="radio" name="hasBill" class="hasBill" value="1" <?php if($supplier['HasBill'] == 1) echo ' checked'; ?>> Không</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label">Liên hệ</label>
                            <div class="box box-default">
                                <div class="box-body table-responsive no-padding divTable">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Chức vụ</th>
                                            <th>Tên</th>
                                            <th>Số điện thoại</th>
                                            <th><a href="javascript:void(0)" id="add_contact" title="Thêm"><i class="fa fa-plus"></i></a></th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbodyContact">
                                        <?php foreach($listSupplierContacts as $sc){ ?>
                                                <tr>
                                                    <td><input type="text" class="form-control positionName" value="<?php echo $sc['PositionName']; ?>"></td>
                                                    <td><input type="text" class="form-control contactName" value="<?php echo $sc['ContactName']; ?>"></td>
                                                    <td><input type="text" class="form-control contactPhone" value="<?php echo $sc['ContactPhone']; ?>"></td>
                                                    <td><a href="javascript:void(0)" class="link_delete" title="Xóa"><i class="fa fa-times"></i></a></td>
                                                </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-right">
                    <input type="text" id="supplierId" hidden="hidden" value="<?php echo $supplier['SupplierId']; ?>">
                     <input type="text" id="sType" hidden="hidden" value="<?php echo $supplier['SupplierTypeId']; ?>">
                    <input type="text" id="hasBill" hidden="hidden" value="<?php echo $supplier['HasBill']; ?>">
                    <input type="text" hidden="hidden" id="supplierEditUrl" value="<?php echo base_url('supplier/edit'); ?>">
                    <input class="btn btn-primary" id="submit" type="submit" name="submit" value="Cập nhật">
                </div>
                <?php echo form_close(); ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>