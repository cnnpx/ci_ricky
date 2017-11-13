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
                            <input type="text" id="supplierCode" class="form-control hmdrequired" value="" data-field="Mã nhà Cung cấp">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Tên nhà Cung cấp <span class="required">*</span></label>
                            <input type="text" id="supplierName" class="form-control hmdrequired" value="" data-field="Tên nhà Cung cấp">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Loại</label><br/>
                            <div class="radio-group">
                                <span class="item"><input type="radio" name="SupplierType" class="stype" value="1" checked> Công ty</span>
                                <span class="item"><input type="radio" name="SupplierType" class="stype" value="2"> Cá nhân</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Trạng thái</label>
                            <?php $this->Mconstants->selectConstants('itemStatus', 'ItemStatusId'); ?>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="control-label">Ghi chú</label>
                            <input type="text" id="comment" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div id="forCompany">
                            <div class="form-group">
                                <label class="control-label">Mã số thuế </label>
                                <input type="text" id="taxCode" class="form-control" value="" data-field="Mã số thuế">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Cấp hoá đơn</label>
                                <div class="radio-group">
                                    <span class="item"><input type="radio" name="hasBill" class="hasBill" value="2" checked> Có</span>
                                    <span class="item"><input type="radio" name="hasBill" class="hasBill" value="1"> Không</span>
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
                                        <tr>
                                            <td><input type="text" class="form-control positionName" value=""></td>
                                            <td><input type="text" class="form-control contactName" value=""></td>
                                            <td><input type="text" class="form-control contactPhone" value=""></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-right">
                    <input type="text" id="supplierId" hidden="hidden" value="0">
                     <input type="text" id="sType" hidden="hidden" value="1">
                    <input type="text" id="hasBill" hidden="hidden" value="2">
                    <input type="text" hidden="hidden" id="supplierEditUrl" value="<?php echo base_url('supplier/edit'); ?>">
                    <input class="btn btn-primary" id="submit" type="submit" name="submit" value="Cập nhật">
                </div>
                <?php echo form_close(); ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>