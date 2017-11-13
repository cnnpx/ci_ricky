<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><button class="btn btn-primary submit">Lưu</button></li>
                    <li><a href="<?php echo base_url('category/'.$itemTypeId); ?>" class="btn btn-default">Hủy</a></li>
                </ul>
            </section>
            <section class="content">
                <?php echo form_open('category/update', array('id' => 'categoryForm')); ?>
                <div class="row">
                    <div class="col-sm-8 no-padding">
                        <div class="box box-default padding15">
                            <div class="form-group">
                                <label class="control-label normal">Tên Chuyên mục <span class="required">*</span></label>
                                <input type="text" name="CategoryName" class="form-control hmdrequired" id="categoryName" value="" data-field="Tên Chuyên mục">
                            </div>
                            <div class="form-group">
                                <label class="control-label normal">Đường dẫn</label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default"><?php echo base_url('/'); ?></button>
                                    </div>
                                    <input type="text" name="CategorySlug" class="form-control" id="categorySlug" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label normal">Mô tả</label>
                                <textarea name="CategoryDesc" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box box-default padding15">
                            <div class="box-header with-border">
                                <h3 class="box-title">Phân loại</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label normal">Thứ tự</label>
                                    <?php $this->Mconstants->selectNumber(1, 100, 'DisplayOrder', 1, true); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label normal">Chuyên mục cha</label>
                                    <?php $this->Mconstants->selectObject($listCategories, 'CategoryId', 'CategoryName', 'ParentCategoryId', 0, true, '-Chọn chuyên mục-', ' select2') ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label normal">Trạng thái</label>
                                    <?php $this->Mconstants->selectConstants('status', 'StatusId'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label normal">Lĩnh vực Kinh doanh</label>
                                    <?php $this->Mconstants->selectObject($listProductTypes, 'ProductTypeId', 'ProductTypeName', 'ProductTypeId', 0, false, '', ' select2') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-inline pull-right" style="margin-right: 10px;">
                    <li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li>
                    <li><a href="<?php echo base_url('category/'.$itemTypeId); ?>" id="categoryListUrl" class="btn btn-default">Hủy</a></li>
                    <input type="text" hidden="hidden" id="categoryId" name="CategoryId" value="0">
                    <input type="text" hidden="hidden" name="ItemTypeId" value="<?php echo $itemTypeId; ?>">
                    <input type="text" hidden="hidden" name="CategoryTypeId" value="1">
                </ul>
                <?php echo form_close(); ?>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>