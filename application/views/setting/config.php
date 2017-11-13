<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php $this->load->view('includes/breadcrumb'); ?>
            <section class="content">
                <?php $this->load->view('includes/notice'); ?>
                <div class="box box-success">
                    <?php echo form_open('config/update'); ?>
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th style="width: 20%;">Tên cấu hình</th>
                                <th>Giá trị</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;
                            foreach($listConfigs as $c){
                                $i++; ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $c['ConfigName']; ?></td>
                                    <td>
                                        <input type="text" name="config_<?php echo $c['ConfigId']; ?>" class="form-control" value="<?php echo $c['ConfigValue']; ?>" required>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Cập nhật</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>