<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('category/add/'.$itemTypeId); ?>" class="btn btn-default">Thêm <?php echo $itemTypeName; ?> mới</a></li>
                </ul>
            </section>
            <section class="content">
                <div class="box box-success">
                    <?php $status = $this->Mconstants->status; ?>
                    <div class="box-header with-border">
                        <h3 class="box-title" id="h3Title"><?php echo $title; ?></h3>
                        <select class="form-control input-sm select-action" id="selectAction" style="display: none;">
                            <option value="">Chọn hành động</option>
                            <option value="change_status-0">Xóa chuyên mục đã chọn</option>
                            <?php foreach($status as $i => $v){ ?>
                                <option value="change_status-<?php echo $i; ?>"><?php echo $v; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="iCheckTable" id="checkAll"></th>
                                <th>Thứ tự</th>
                                <th>Chuyên mục</th>
                                <th>Slug</th>
                                <th>Chuyên mục cha</th>
                                <th>Lĩnh vực kinh doanh</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyCategory">
                            <?php $labelCss = $this->Mconstants->labelCss;
                            foreach($listCategories as $c){ ?>
                                <tr id="trItem_<?php echo $c['CategoryId']; ?>">
                                    <td>
                                        <input type="checkbox" class="iCheckTable iCheckItem" value="<?php echo $c['CategoryId']; ?>">
                                        <input type="text" hidden="hidden" id="cateInfo_<?php echo $c['CategoryId']; ?>" value="<?php echo $c['ProductTypeId']; ?>" data-type="<?php echo $c['CategoryTypeId']; ?>" data-parent="<?php echo $c['ParentCategoryId']; ?>">
                                    </td>
                                    <td>
                                        <?php $attrSelect = ' onchange="changeDisplayOrder(this, \'' . $c['CategoryId'] . '\')" data-id="'.$c['CategoryId'].'"';
                                        $this->Mconstants->selectNumber(1, 100, 'DisplayOrder_'.$c['CategoryId'], $c['DisplayOrder'], true, $attrSelect); ?>
                                    </td>
                                    <td><a href="<?php echo base_url('category/edit/'.$c['CategoryId']); ?>"><?php echo $c['CategoryName']; ?></td>
                                    <td><?php echo $c['CategorySlug']; ?></td>
                                    <td><?php if($c['ParentCategoryId'] > 0) echo $this->Mconstants->getObjectValue($listCategories, 'CategoryId', $c['ParentCategoryId'], 'CategoryName'); ?></td>
                                    <td><?php echo $this->Mconstants->getObjectValue($listProductTypes, 'ProductTypeId', $c['ProductTypeId'], 'ProductTypeName'); ?></td>
                                    <td id="statusName_<?php echo $c['CategoryId']; ?>"><span class="<?php echo $labelCss[$c['StatusId']]; ?>"><?php echo $status[$c['StatusId']]; ?></td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="changeItemStatusUrl" value="<?php echo base_url('category/changeStatusBatch'); ?>">
                    <input type="text" hidden="hidden" id="changeDisplayOrderUrl" value="<?php echo base_url('category/changeDisplayOrder'); ?>">
                    <input type="text" hidden="hidden" id="itemTypeId" value="<?php echo $itemTypeId; ?>">
                    <input type="text" hidden="hidden" id="itemTypeName" value="<?php echo $itemTypeName; ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>