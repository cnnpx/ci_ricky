<?php $this->load->view('includes/header'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php $this->load->view('includes/breadcrumb'); ?>
        <section class="content">
            <?php
            if ($this->session->flashdata('error')) { //change!
                echo "<div class='alert alert-danger'>";
                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                echo $this->session->flashdata('error');
                echo "</div>";
            }
            ?>
            <?php echo form_open('contributorProductTypes/update',
                array('id' => 'contributorProductTypeForm', 'class' => 'form-horizontal')); ?>
            <div class="row col-sm-offset-1">
                <div class="form-group">
                    <label class="form-label col-sm-2">Cổ phần <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <?php $this->Mconstants->selectObject($listContributors, 'ContributorId', 'ContributorName', 'ContributorId', $contributorType['ContributorId'], false, '', ' select2') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-sm-2">Mảng kinh doanh <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <?php $this->Mconstants->selectObject($listProductTypes, 'ProductTypeId', 'ProductTypeName', 'ProductTypeId', $contributorType['ProductTypeId'], false, '', ' select2') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-sm-2">Số $ đóng góp <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control required" name="Cost" value="<?php echo $contributorType['Cost'] ?>">
                        <div class="error" id="Cost"><?php echo form_error('Cost')?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label col-sm-2">Người tạo</label>
                    <div class="col-sm-8">
                        <?php $this->Mconstants->selectObject($listUsers, 'CrUserId', 'UserName', 'CrUserId', $contributorType['CrUserId'], false, '', ' select2') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" name="ContributorTypeId" value="<?php echo $contributorType['ContributorProductTypeId']?>">
                        <input class="btn btn-primary" id="submit" type="submit" name="submit" value="Cập nhật">
                        <a href="contributorProductTypes" class="btn btn-danger">Hủy bỏ</a>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>
<?php $this->load->view('includes/footer'); ?>
