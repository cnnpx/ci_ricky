<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php $this->load->view('includes/breadcrumb'); ?>
            <section class="content">
                <div class="row">
                    <div class="col-sm-3">
                        <a href="contributors/add" class="btn btn-primary">Tạo mới</a>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="box box-success">
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên cổ phần</th>
                                <th>SĐT</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyContributor">
                            <?php $i = 0;
                            foreach($listContributors as $u){
                                $i++; ?>
                                <tr id="contributor_<?php echo $u['ContributorId']?>">
                                    <td><?php echo $i; ?></td>
                                    <td><a href="<?php echo base_url('contributors/edit/'.$u['ContributorId']); ?>"><?php echo $u['ContributorName']; ?></a></td>
                                    <td><?php echo $u['ContributorPhone']; ?></td>
                                    <td><?php echo ddMMyyyy($u['BirthDay']); ?></td>
                                    <td><?php echo $u['Address']; ?></td>
                                    <td class="actions">
                                        <a href="<?php echo base_url('contributors/edit/'.$u['ContributorId']); ?>" class="link_edit" data-id="<?php echo $u['ContributorId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $u['ContributorId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="changeStatusUrl" value="<?php echo base_url('contributors/delete'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>