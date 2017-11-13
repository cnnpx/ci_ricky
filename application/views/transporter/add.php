<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><button class="btn btn-primary submit">Lưu</button></li>
                    <li><a href="<?php echo base_url('transporter'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php echo form_open('transporter/update', array('id' => 'transporterForm')); ?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Mã nhà Vận chuyển <span class="required">*</span></label>
                            <input type="text" id="transporterCode" class="form-control hmdrequired" value="" data-field="Mã nhà Vận chuyển">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Tên nhà Vận chuyển <span class="required">*</span></label>
                            <input type="text" id="transporterName" class="form-control hmdrequired" value="" data-field="Tên nhà Vận chuyển">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">COD</label><br/>
                            <div class="radio-group">
                                <span class="item"><input type="radio" name="HasCOD" class="iCheckRadio" value="2" checked> Có</span>
                                <span class="item"><input type="radio" name="HasCOD" class="iCheckRadio" value="1"> Không</span>
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
                        <div class="form-group">
                            <label class="control-label">Phụ trách cơ sở</label>
                            <div class="checkbox-group">
                                <?php foreach($listStores as $s){ ?>
                                    <p><input type="checkbox" class="cbStore" value="<?php echo $s['StoreId']; ?>"> <?php echo $s['StoreName']; ?></p>
                                <?php } ?>
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
                                            <th>Tên</th>
                                            <th>Số điện thoại</th>
                                            <th><a href="javascript:void(0)" id="add_contact" title="Thêm"><i class="fa fa-plus"></i></a></th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbodyContact">
                                        <tr>
                                            <td><input type="text" class="form-control contactName" value=""></td>
                                            <td><input type="text" class="form-control contactPhone" value=""></td>
                                            <td><a href="javascript:void(0)" class="link_delete" title="Xóa"><i class="fa fa-times"></i></a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li>
                    <li><a href="<?php echo base_url('transporter'); ?>" id="transporterListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" id="transporterId" hidden="hidden" value="0">
                </ul>
                <?php echo form_close(); ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>