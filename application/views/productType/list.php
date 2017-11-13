<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php $this->load->view('includes/breadcrumb'); ?>
            <section class="content">
                <div class="box box-success">
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mảng kinh doanh</th>
                                <th>Cổ phần</th>
                                <th>Ngày khởi tạo</th>
                                <th>Ngày hoạt động</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyProductTypes">
                            <?php
                            $i = 0;
                            $isShare = $this->Mconstants->isShare;
                            $labelCss = $this->Mconstants->labelCss;
                            foreach($listProductType as $key => $value){
                                $i++;
                                ?>
                                <tr id="producttype_<?php echo $value['ProductTypeId']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td id="producttypeName_<?php echo $value['ProductTypeId']; ?>"><a href="<?php echo base_url('productType/edit/'.$value['ProductTypeId']); ?>"><?php echo $value['ProductTypeName']; ?></td>
                                    <td id="producttypeIsShare_<?php echo $value['ProductTypeId']; ?>"><span class="<?php echo $labelCss[$value['IsShare']]; ?>"><?php echo $isShare[$value['IsShare']]; ?></td>
                                    <td id="producttypeActiveDate_<?php echo $value['ProductTypeId']; ?>"><?php echo date("d-m-Y", strtotime($value['ActiveDate'])); ?></td>
                                    <td id="producttypeCrDateTime_<?php echo $value['ProductTypeId']; ?>"><?php echo date("d-m-Y", strtotime($value['CrDateTime'])); ?></td>
                                    <td class="actions">
                                        <a href="<?php echo base_url('productType/edit/'.$value['ProductTypeId']); ?>" class="link_edit" data-id="<?php echo $value['ProductTypeId']; ?>" title="Sửa"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $value['ProductTypeId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="changeStatusUrl" value="<?php echo base_url('productType/changeStatus'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>