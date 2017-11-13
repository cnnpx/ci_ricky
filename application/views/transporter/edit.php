<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <?php if($transporterId > 0){ ?><li><button class="btn btn-primary submit">Lưu</button></li><?php } ?>
                    <li><a href="<?php echo base_url('transporter'); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php $this->load->view('includes/notice'); ?>
                <?php if($transporterId > 0){ ?>
                    <?php echo form_open('transporter/update', array('id' => 'transporterForm')); ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Mã nhà Vận chuyển <span class="required">*</span></label>
                                <input type="text" id="transporterCode" class="form-control hmdrequired" value="<?php echo $transporter['TransporterCode']; ?>" data-field="Mã nhà Vận chuyển">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Tên nhà Vận chuyển <span class="required">*</span></label>
                                <input type="text" id="transporterName" class="form-control hmdrequired" value="<?php echo $transporter['TransporterName']; ?>" data-field="Tên nhà Vận chuyển">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">COD</label><br/>
                                <div class="radio-group">
                                    <span class="item"><input type="radio" name="HasCOD" class="iCheckRadio" value="2"<?php if($transporter['HasCOD'] == 2) echo ' checked'; ?>> Có</span>
                                    <span class="item"><input type="radio" name="HasCOD" class="iCheckRadio" value="1"<?php if($transporter['HasCOD'] == 1) echo ' checked'; ?>> Không</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Trạng thái</label>
                                <?php $this->Mconstants->selectConstants('itemStatus', 'ItemStatusId', $transporter['ItemStatusId']); ?>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="control-label">Ghi chú</label>
                                <input type="text" id="comment" class="form-control" value="<?php echo $transporter['Comment']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Phụ trách cơ sở</label>
                                <div class="checkbox-group">
                                    <?php foreach($listStores as $s){ ?>
                                        <p><input type="checkbox" class="cbStore" value="<?php echo $s['StoreId']; ?>"<?php if(in_array($s['StoreId'], $storeIds)) echo ' checked'; ?>> <?php echo $s['StoreName']; ?></p>
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
                                            <?php foreach($listTransporterContacts as $tc){ ?>
                                                <tr>
                                                    <td><input type="text" class="form-control contactName" value="<?php echo $tc['ContactName']; ?>"></td>
                                                    <td><input type="text" class="form-control contactPhone" value="<?php echo $tc['ContactPhone']; ?>"></td>
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
                    <ul class="list-inline pull-right" style="margin-right: 10px;">
                        <li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li>
                        <li><a href="<?php echo base_url('transporter'); ?>" id="transporterListUrl" class="btn btn-default">Hủy</a></li>
                        <input type="text" id="transporterId" hidden="hidden" value="<?php echo $transporterId; ?>">
                    </ul>
                    <?php echo form_close(); ?>
                <?php } ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>