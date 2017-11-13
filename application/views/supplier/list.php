<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php $this->load->view('includes/breadcrumb'); ?>
            <section class="content">
                <div class="box box-default">
                    <?php sectionTitleHtml('Tìm kiếm'); ?>
                    <div class="box-body row-margin">
                        <?php echo form_open('supplier'); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" name="SupplierCode" class="form-control" value="<?php echo set_value('SupplierCode'); ?>" placeholder="Mã Nhà Cung cấp">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="SupplierName" class="form-control" value="<?php echo set_value('SupplierName'); ?>" placeholder="Tên Nhà Cung cấp">
                            </div>
                            <div class="col-sm-3">
                                <?php $this->Mconstants->selectConstants('itemStatus', 'ItemStatusId', set_value('ItemStatusId'), true, 'Trạng thái'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" name="ContactName" class="form-control" value="<?php echo set_value('ContactName'); ?>" placeholder="Tên người liên hệ">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="ContactPhone" class="form-control" value="<?php echo set_value('ContactPhone'); ?>" placeholder="SĐT người liên hệ">
                            </div>
                            <div class="col-sm-3">
                                <?php $this->Mconstants->selectConstants('supplierTypes', 'SupplierTypeId', set_value('SupplierTypeId'), true, 'Loại nhà cung cấp', ' select2'); ?>
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" name="submit" class="btn btn-primary" value="Tìm kiếm">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="box box-success">
                    <?php sectionTitleHtml($title); ?>
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>Mã số thuế</th>
                                <th>Cấp hoá đơn</th>
                                <th>Liên hệ</th>
                                <th>Trạng thái</th>
                                <th>Ghi chú</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodySupplier">
                            <?php $i = 0;
                            $status = $this->Mconstants->itemStatus;
                            $labelCss = $this->Mconstants->labelCss;
                            foreach($listSuppliers as $s){
                                $i++; ?>
                                <tr id="supplier_<?php echo $s['SupplierId']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><a href="<?php echo base_url('supplier/edit/'.$s['SupplierId']); ?>"><?php echo $s['SupplierCode']; ?></a></td>
                                    <td><?php echo $s['SupplierName']; ?></td>
                                    <td><?php echo $s['TaxCode']; ?></td>
                                    <td>
                                        <?php if($s['HasBill'] == 2) echo '<span class="label label-success">Có</span>';
                                        else if ($s['HasBill'] == 1) echo '<span class="label label-default">Không</span>'; ?>
                                    </td>
                                    <td>
                                        <?php foreach($listSupplierContacts as $sc){
                                            if($s['SupplierId'] == $sc['SupplierId']) echo "<p>{$sc['PositionName']} - {$sc['ContactName']} - {$sc['ContactPhone']}</p>";
                                        } ?>
                                    </td>
                                    <td id="statusName_<?php echo $s['SupplierId']; ?>"><span class="<?php echo $labelCss[$s['ItemStatusId']]; ?>"><?php echo $status[$s['ItemStatusId']]; ?></span></td>
                                    <td><?php echo $s['Comment']; ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $s['SupplierId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                        <div class="btn-group" id="btnGroup_<?php echo $s['SupplierId']; ?>">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-check"></i><span class="caret"></span> </button>
                                            <ul class="dropdown-menu">
                                                <?php foreach($status as $j => $v){ ?>
                                                    <li><a href="javascript:void(0)" class="link_status" data-id="<?php echo $s['SupplierId']; ?>" data-status="<?php echo $j; ?>"><?php echo $v; ?></a></li>
                                                <?php }  ?>
                                            </ul>
                                        </div>
                                        <input type="text" hidden="hidden" id="statusId_<?php echo $s['SupplierId']; ?>" value="<?php echo $s['ItemStatusId']; ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="changeStatusUrl" value="<?php echo base_url('supplier/changeStatus'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>