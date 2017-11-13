<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php $this->load->view('includes/breadcrumb'); ?>
            <section class="content">
                <?php
                    if ($this->session->flashdata('success')) { //change!
                        echo "<div class='alert alert-success'>";
                        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                        echo $this->session->flashdata('success');
                        echo "</div>";
                    }
                ?>
                <div class="row">
                    <div class="col-sm-3">
                        <a href="contributorProductTypes/add" class="btn btn-primary">Tạo mới</a>
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
                                <th>Cổ phần</th>
                                <th>Mảng kinh doanh</th>
                                <th>Số $ đóng góp</th>
                                <th>Người tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyContributor">
                            <?php
	                            $i = 0;
	                            foreach($listContributorProductTypes as $key => $value){
                                $i++;
                            ?>
                                <tr id="contributortype_<?php echo $value['ContributorProductTypeId']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><a href="<?php echo base_url('contributorProductTypes/edit/'.$value['ContributorProductTypeId']); ?>"><?php echo $value['ContributorName']; ?></td>
                                    <td><?php echo $value['ProductTypeName']; ?></td>
                                    <td><?php echo $value['Cost']; ?></td>
                                    <td><?php echo $value['UserName']; ?></td>
                                    <td class="actions">
                                        <a href="<?php echo base_url('contributorProductTypes/edit/'.$value['ContributorProductTypeId']); ?>" class="link_edit" data-id="<?php echo $value['ContributorProductTypeId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $value['ContributorProductTypeId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="changeStatusUrl" value="<?php echo base_url('contributorProductTypes/delete'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>