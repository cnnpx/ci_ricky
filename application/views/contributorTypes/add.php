<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('includes/breadcrumb'); ?>
        <section class="content" style="background: #FFFFFF;margin-top: 10px;">
            <?php
                if ($this->session->flashdata('error')) { //change!
                    echo "<div class='alert alert-danger'>";
                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    echo $this->session->flashdata('error');
                    echo "</div>";
                }
            ?>
            <?php echo form_open('contributorProductTypes/store',
                array('id' => 'contributorProductTypeForm', 'class' => 'form-horizontal')); ?>
            <div class="row col-sm-offset-1">
                <div class="form-group">
                    <label class="form-label col-sm-2">Cổ phần <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <select name="ContributorId" class="form-control required" id="ContributorId">
                            <option value="">Chọn cổ phần</option>
                            <?php foreach ($listContributors as $contributor) { ?>
                                <option value="<?php echo $contributor['ContributorId']; ?>">
                                    <?php echo $contributor['ContributorName']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-sm-2">Mảng kinh doanh <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <select name="ProductTypeId" class="form-control required" id="ProductTypeId">
                            <option value="">Chọn mảng kinh doanh</option>
                            <?php foreach ($listProductTypes as $producttype) { ?>
                                <option value="<?php echo $producttype['ProductTypeId']; ?>">
                                    <?php echo $producttype['ProductTypeName']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-sm-2">Số $ đóng góp <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control required" name="Cost" value="<?php echo set_value('Cost')?>">
                        <div class="error" id="Cost"><?php echo form_error('Cost')?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-sm-2">Người tạo</label>
                    <div class="col-sm-8">
                        <select name="CrUserId" class="form-control" id="CrUserId">
                            <option value="">Chọn người tạo</option>
                            <?php foreach ($listUsers as $user) { ?>
                                <option value="<?php echo $user['UserId']; ?>">
                                    <?php echo $user['FullName']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input class="btn btn-primary" id="submit" type="submit" name="submit" value="Tạo mới">
                        <a href="contributorProductTypes" class="btn btn-danger">Hủy bỏ</a>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>
<?php $this->load->view('includes/footer'); ?>
