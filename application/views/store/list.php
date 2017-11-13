<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('store/add'); ?>" class="btn btn-default">Thêm cơ sở mới</a></li>
                </ul>
            </section>
            <section class="content">
                <div class="box box-success">
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên cơ sở</th>
                                <th>Mã cơ sở</th>
                                <th>Địa chỉ</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th>Người phụ trách</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyStore">
                            <?php $i = 0;
                            $itemStatus = $this->Mconstants->itemStatus;
                            $storeTypes = $this->Mconstants->storeTypes;
                            $labelCss = $this->Mconstants->labelCss;
                            foreach($listStore as $s){
                                $i++; ?>
                                <tr id="store_<?php echo $s['StoreId']; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><a href="<?php echo base_url('store/edit/'.$s['StoreId']); ?>"><?php echo $s['StoreName']; ?></a></td>
                                    <td><?php echo $s['StoreCode']; ?></td>
                                    <td><?php echo $s['Address'].', '.$this->Mconstants->getObjectValue($listProvinces, 'ProvinceId', $s['ProvinceId'], 'ProvinceName'); ?></td>
                                    <td><?php echo $storeTypes[$s['StoreTypeId']]?></td>
                                    <td id="statusName_<?php echo $s['StoreId']; ?>"><span class="<?php echo $labelCss[$s['ItemStatusId']]; ?>"><?php echo $itemStatus[$s['ItemStatusId']]; ?></span></td>
                                    <td><?php echo $this->Mconstants->getObjectValue($listUsers, 'UserId', $s['HeadUserId'], 'FullName'); ?></td>
                                    <td class="actions">
                                        <a href="javascript:void(0)" class="link_delete" data-id="<?php echo $s['StoreId']; ?>" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                        <div class="btn-group" id="btnGroup_<?php echo $s['StoreId']; ?>">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-check"></i><span class="caret"></span> </button>
                                            <ul class="dropdown-menu">
                                                <?php foreach($itemStatus as $j => $v){ ?>
                                                    <li><a href="javascript:void(0)" class="link_status" data-id="<?php echo $s['StoreId']; ?>" data-status="<?php echo $j; ?>"><?php echo $v; ?></a></li>
                                                <?php }  ?>
                                            </ul>
                                        </div>
                                        <input type="text" hidden="hidden" id="statusId_<?php echo $s['StoreId']; ?>" value="<?php echo $s['ItemStatusId']; ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="deleteStore" value="<?php echo $deleteStore ? 1 : 0; ?>">
                    <input type="text" hidden="hidden" id="changeStatus" value="<?php echo $changeStatus ? 1 : 0; ?>">
                    <input type="text" hidden="hidden" id="changeStatusUrl" value="<?php echo base_url('store/changeStatus'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>