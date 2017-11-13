<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1><?php echo $title; ?></h1>
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('transporter/add'); ?>" class="btn btn-primary">Thêm mới</a></li>
                </ul>
            </section>
            <section class="content">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="h3Title"><?php echo $title; ?></h3>
                        <select class="form-control input-sm select-action" id="selectAction" style="display: none;">
                            <option value="">Chọn hành động</option>
                            <option value="delete_item">Xóa Nhà Vận chuyển được chọn</option>
                        </select>
                    </div>
                    <div class="box-body table-responsive no-padding divTable">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="iCheckTable" id="checkAll"></th>
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>COD</th>
                                <th>Cơ sở</th>
                                <th>Liên hệ</th>
                                <th>Trạng thái</th>
                                <th>Ghi chú</th>
                            </tr>
                            </thead>
                            <tbody id="tbodyTransporter">
                            <?php $i = 0;
                            $status = $this->Mconstants->itemStatus;
                            $labelCss = $this->Mconstants->labelCss;
                            foreach($listTransporters as $t){
                                $i++; ?>
                                <tr id="trItem_<?php echo $t['TransporterId']; ?>">
                                    <td><input type="checkbox" class="iCheckTable iCheckItem" value="<?php echo $t['TransporterId']; ?>"></td>
                                    <td><a href="<?php echo base_url('transporter/edit/'.$t['TransporterId']); ?>"><?php echo $t['TransporterCode']; ?></a></td>
                                    <td><?php echo $t['TransporterName']; ?></td>
                                    <td>
                                        <?php if($t['HasCOD'] == 1) echo '<span class="label label-success">Có</span>';
                                        else echo '<span class="label label-default">Không</span>'; ?>
                                    </td>
                                    <td>
                                        <?php foreach($listTransporterStores as $ts){
                                            if($t['TransporterId'] == $ts['TransporterId']) echo '<p>' . $this->Mconstants->getObjectValue($listStores, 'StoreId', $ts['StoreId'], 'StoreName') . '</p>';
                                        } ?>
                                    </td>
                                    <td>
                                        <?php foreach($listTransporterContacts as $tc){
                                            if($t['TransporterId'] == $tc['TransporterId']) echo "<p>{$tc['ContactName']} - {$tc['ContactPhone']}</p>";
                                        } ?>
                                    </td>
                                    <td id="statusName_<?php echo $t['TransporterId']; ?>"><span class="<?php echo $labelCss[$t['ItemStatusId']]; ?>"><?php echo $status[$t['ItemStatusId']]; ?></span></td>
                                    <td><?php echo $t['Comment']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" hidden="hidden" id="deleteItemUrl" value="<?php echo base_url('transporter/deleteBatch'); ?>">
                </div>
            </section>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>