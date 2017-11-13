<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('includes/breadcrumb'); ?>
        <section class="content" style="background: #FFFFFF;margin-top: 10px;">
            <?php $this->load->view('includes/notice'); ?>
            <?php if($productTypeId > 0){ ?>
            <?php echo form_open('ProductType/update', array('id' => 'productTypeForm','class' => 'form-horizontal')); ?>
            <div class="row col-sm-offset-1">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tên mảng kinh doanh <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="ProductTypeName" id="productTypeName" class="form-control hmdrequired" value="<?php echo  $producttype['ProductTypeName']; ?>" data-field="Tên mảng kinh doanh">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Cổ phần</label>
                        <div class="col-sm-8">
                        <?php $this->Mconstants->selectConstants('isShare', 'IsShare',$producttype['IsShare']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Ngày hoạt động <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                <input type="text" class="form-control hmdrequired datepicker" id ="activeDate" name="ActiveDate " value="<?php echo date("d/m/Y", strtotime($producttype['ActiveDate'])); ?>" autocomplete="off" data-field="Ngày hoạt động">
                            </div>
                        </div>
                    </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="text" id="productTypeId" hidden="hidden" value="<?php echo $producttype['ProductTypeId']; ?>">
                        <input type="text" id="productTypeEditUrl" hidden="hidden" value="<?php echo base_url('productType/edit'); ?>">
                        <input class="btn btn-primary" id="submit" type="submit" name="submit" value="Cập nhật">
                        <a href="productType" class="btn btn-danger">Hủy bỏ</a>
                    </div>
                </div>
            </div>
    <?php echo form_close(); ?>
    <?php } ?>
    </section>
</div>
</div>
<?php $this->load->view('includes/footer'); ?>
