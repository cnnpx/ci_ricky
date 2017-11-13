<?php $this->load->view('includes/header'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php if($productId > 0){ ?>
                <section class="content-header">
                    <h1><?php echo $title; ?></h1>
                    <ul class="list-inline">
                        <li><button class="btn btn-primary submit">Lưu</button></li>
                        <li><a href="<?php echo base_url('product'); ?>" class="btn btn-default">Hủy</a></li>
                    </ul>
                </section>
                <section class="content">
                    <?php echo form_open('api/product/update', array('id' => 'productForm')); ?>
                    <div class="row">
                        <div class="col-sm-8 no-padding">
                            <div class="box box-default padding15">
                                <div class="form-group">
                                    <label class="control-label">Tên sản phẩm <span class="required">*</span></label>
                                    <input type="text" id="productName" class="form-control hmdrequired" value="<?php echo $product['ProductName']; ?>" data-field="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Mô tả</label>
                                    <textarea name="ProductDesc" class="form-control"><?php echo $product['ProductDesc']; ?></textarea>
                                </div>
                            </div>
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Hình ảnh</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" id="btnUpImage1"><i class="fa fa-upload"></i> Chọn hình</button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <ul class="list-inline" id="ulImages">
                                        <?php foreach($listImages as $img){ ?>
                                            <li><a href="<?php echo IMAGE_PATH.$img; ?>" target="_blank"><img src="<?php echo IMAGE_PATH.$img; ?>"></a><i class="fa fa-times"></i></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Giá sản phẩm</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group"><input type="checkbox" id="cbPrice" class="iCheck"<?php if($product['IsContactPrice'] == 2) echo ' checked'; ?>><span class="spanCheck">Giá liên hệ</span></div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label">Giá bán lẻ</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="price" class="form-control cost" value="<?php echo priceFormat($product['Price']); ?>">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default">VNĐ</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">Giá so sánh</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="oldPrice" class="form-control cost" value="<?php echo priceFormat($product['OldPrice']); ?>">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default">VNĐ</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-header with-border">
                                    <h3 class="box-title">Tồn kho</h3>
                                </div>
                                <div class="box-body row-margin">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label">Sku <span class="required">*</span></label>
                                            <input type="text" id="sku" class="form-control hmdrequired" value="<?php echo $product['Sku']; ?>" data-field="Sku">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">BarCode <span class="required">*</span></label>
                                            <input type="text" id="barCode" class="form-control hmdrequired" value="<?php echo $product['BarCode']; ?>" data-field="BarCode">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label">Bảo hành (tháng)</label>
                                            <input type="text" id="guaranteeMonth" class="form-control" value="<?php echo $product['GuaranteeMonth']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-header with-border">
                                    <h3 class="box-title">Vận Chuyển</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label">Khối lượng (gam) <span class="required">*</span></label>
                                            <input type="text" id="weight" class="form-control cost hmdrequired" value="<?php echo priceFormat($product['Weight']); ?>" data-field="Khối lượng">
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"><br/><input type="checkbox" id="cbWeight" class="iCheck" checked><span class="spanCheck">Có giao hàng</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Tối ưu SEO</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" id="btnSEO"><i class="fa fa-pencil"></i> Chỉnh sửa SEO</button>
                                    </div>
                                </div>
                                <div class="box-body" id="divSEO" style="display: none;">
                                    <div class="form-group">
                                        <label class="control-label" style="width: 100%;">Tiêu đề trang<span class="pull-right"><span id="count1"><?php echo strlen($itemSEO['TitleSEO']); ?></span> / 70 ký tự</span></label>
                                        <input type="text" id="titleSEO" class="form-control" value="<?php echo $itemSEO['TitleSEO']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" style="width: 100%;">Mô tả trang<span class="pull-right"><span id="count2"><?php echo strlen($itemSEO['MetaDesc']); ?></span> / 160 ký tự</span></label>
                                        <textarea rows="3" id="metaDesc" class="form-control"><?php echo $itemSEO['MetaDesc']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Đường dẫn</label>
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default"><?php echo base_url('/'); ?></button>
                                            </div>
                                            <input type="text" id="productSlug" class="form-control" value="<?php echo $product['ProductSlug']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $this->load->view('includes/action_logs'); ?>
                        </div>
                        <div class="col-sm-4">
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Hiển thị</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="checkbox" id="cbWebsite1" class="iCheck" checked>
                                        <span class="spanCheck">Website</span>
                                        <button type="button" class="btn btn-box-tool pull-right" id="btnDate" title="Cài đặt ngày"><i class="fa fa-calendar"></i></button>
                                    </div>
                                    <div class="form-group margin-left-10" id="divWebsite2" style="display: none;"><input type="checkbox" id="cbWebsite2" class="iCheck"><span class="spanCheck">Chỉ ẩn ở danh sách sản phẩm</span></div>
                                    <div class="row" id="divDateTime" style="display: none;">
                                        <div class="col-sm-6 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control datepicker hmdrequired" id="productDate" value="<?php echo ddMMyyyy($product['PublishDateTime']); ?>" autocomplete="off" data-field="Ngày xuất bản">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 no-padding">
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control timepicker hmdrequired" id="productTime" data-field="Giờ xuất bản" value="<?php echo ddMMyyyy($product['PublishDateTime'], 'h:i A'); ?>">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Phân loại</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label">Trạng thái</label>
                                        <div class="radio-group">
                                            <span class="item"><input type="radio" name="ProductStatusId" class="iCheckRadio" value="2"<?php if($product['ProductStatusId'] == 2) echo ' checked'; ?>> Đang Kinh doanh</span><br/>
                                            <span class="item"><input type="radio" name="ProductStatusId" class="iCheckRadio" value="1"<?php if($product['ProductStatusId'] == 1) echo ' checked'; ?>> Tạm dừng Kinh doanh</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Xuất hóa đơn GTGT</label>
                                        <div class="radio-group">
                                            <span class="item"><input type="radio" name="VATStatusId" class="iCheckRadio" value="2"<?php if($product['VATStatusId'] == 2) echo ' checked'; ?>> Có</span><br/>
                                            <span class="item"><input type="radio" name="VATStatusId" class="iCheckRadio" value="1"<?php if($product['VATStatusId'] == 1) echo ' checked'; ?>> Không</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Cấp độ</label>
                                        <div class="radio-group">
                                            <span class="item"><input type="radio" name="ProductLevelId" class="iCheckRadio" value="2"<?php if($product['ProductLevelId'] == 2) echo ' checked'; ?>> Sản phẩm chính</span><br/>
                                            <span class="item"><input type="radio" name="ProductLevelId" class="iCheckRadio" value="1"<?php if($product['ProductLevelId'] == 1) echo ' checked'; ?>> Sản phẩm phụ</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="cbIsManageExtraWarehouse" class="iCheck"<?php if($product['IsManageExtraWarehouse'] == 2) echo ' checked'; ?>><span class="spanCheck">Quản lý vào KHO PHỤ</span>
                                    </div>
                                    <div id="divIsManageExtraWarehouse" style="display: none;">
                                        <div class="form-group">
                                            <label class="control-label">Tình trạng hình thức</label>
                                            <input type="text" id="formalStatus" class="form-control" value="<?php echo $product['FormalStatus']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Ttình trạng sử dụng</label>
                                            <input type="text" id="usageStatus" class="form-control" value="<?php echo $product['UsageStatus']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Tình trạng phụ kiện</label>
                                            <input type="text" id="accessoryStatus" class="form-control" value="<?php echo $product['AccessoryStatus']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Lĩnh vực Kinh doanh</label>
                                        <?php $this->Mconstants->selectObject($listProductTypes, 'ProductTypeId', 'ProductTypeName', 'ProductTypeId', $product['ProductTypeId'], false, '', ' select2') ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Loại sản phẩm</label>
                                        <select class="form-control select2" id="cate2" multiple="multiple" data-placeholder="Chọn loại sản phẩm" style="width: 100%;">
                                            <?php foreach($listCategories as $c){
                                                if($c['ItemTypeId'] == 2){ ?>
                                                    <option value="<?php echo $c['CategoryId']; ?>" data-type="<?php echo $c['ProductTypeId']; ?>"<?php if(in_array($c['CategoryId'], $cateIds)) echo ' selected="selected"'; ?>><?php echo $c['CategoryName']; ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nhà cung cấp</label>
                                        <?php $this->Mconstants->selectObject($listSuppliers, 'SupplierId', 'SupplierName', 'SupplierId', $product['SupplierId'], false, '', ' select2') ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nhóm sản phẩm</label>
                                        <select class="form-control select2" id="cate1" multiple="multiple" data-placeholder="Chọn nhóm sản phẩm" style="width: 100%;">
                                            <?php foreach($listCategories as $c){
                                                if($c['ItemTypeId'] == 1){ ?>
                                                    <option value="<?php echo $c['CategoryId']; ?>" data-type="<?php echo $c['ProductTypeId']; ?>"<?php if(in_array($c['CategoryId'], $cateIds)) echo ' selected="selected"'; ?>><?php echo $c['CategoryName']; ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nhãn</label>
                                        <input type="text" class="form-control" id="tags">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Thêm các nhãn đã có</label>
                                        <ul class="list-inline" id="ulTagExist">
                                            <?php foreach($listTags as $t){ ?>
                                                <li><a href="javascript:void(0)"><?php echo $t['TagName']; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-default padding15">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Hình ảnh chính</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" id="btnUpImage2"><i class="fa fa-upload"></i> Chọn hình</button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <img src="<?php echo IMAGE_PATH.$product['ProductImage']; ?>" style="width: 100%;" id="productImage">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-default row">
                        <div class="box-header with-border">
                            <h3 class="box-title">Sản phẩm có nhiều phiên bản</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" id="btnConfig"><i class="fa fa-plus"></i> Thêm phiên bản</button>
                            </div>
                            <p>Sản phẩm có các phiên bản dựa theo thuộc tính như kích thước hoặc màu sắc ?</p>
                        </div>
                        <div id="divProductConfig"<?php if($product['ProductKindId'] == 1) echo ' style="display: none;"'; ?>>
                            <div class="box-body table-responsive no-padding divTable">
                                <table class="table table-hover table-bordered">
                                    <thead class="theadNormal">
                                    <tr>
                                        <th style="width: 150px;">Thuộc tính</th>
                                        <th>Giá trị thuộc tính (cách nhau bởi dấu phẩy)</th>
                                        <th style="width: 5px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodyVariant">
                                    <?php $i = 0;
                                    if(empty($variants)){
                                        $i = 1; ?>
                                        <tr>
                                            <td>
                                                <select class="form-control variantId" id="variantId_1">
                                                    <?php foreach($listVariants as $v){ ?>
                                                        <option value="<?php echo $v['VariantId']; ?>"><?php echo $v['VariantName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control variantValue" id="variantValue_1"></td>
                                            <td><a href="javascript:void(0)" class="link_delete" data-id="1"><i class="fa fa-times" title="Xóa"></i></a></td>
                                        </tr>
                                    <?php } else{
                                        foreach($variants as $variantId => $variantValues){
                                            $i++;
                                            $variantValueDiffs = array();
                                            foreach($variantValues as $variantValue){
                                                if(!in_array($variantValue, $variantValueDiffs)) $variantValueDiffs[] = $variantValue;
                                            } ?>
                                            <tr>
                                                <td>
                                                    <select class="form-control variantId" id="variantId_<?php echo $i; ?>">
                                                        <?php foreach($listVariants as $v){ ?>
                                                            <option value="<?php echo $v['VariantId']; ?>"<?php if($v['VariantId'] == $variantId) echo ' selected="selected"'; ?>><?php echo $v['VariantName']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control variantValue" id="variantValue_<?php echo $i; ?>"></td>
                                                <td>
                                                    <a href="javascript:void(0)" class="link_delete" data-id="1"><i class="fa fa-times" title="Xóa"></i></a>
                                                    <input type="text" hidden="hidden" id="variantValues_<?php echo $i; ?>" value="<?php echo implode(',', $variantValueDiffs); ?>">
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-info" id="btnAddVariant">Thêm thuộc tính</button>
                                <button type="button" class="btn btn-info pull-right" id="btnInitVariant">Tạo phiên bản</button>
                                <input type="text" hidden="hidden" id="variantNo" value="<?php echo $i; ?>">
                                <?php foreach($listVariants as $v){ ?>
                                    <input type="text" hidden="hidden" class="variant" data-id="<?php echo $v['VariantId']; ?>" value="<?php echo $v['VariantName']; ?>">
                                <?php } ?>
                            </div>
                            <div class="box-body table-responsive no-padding divTable">
                                <table class="table table-hover table-bordered">
                                    <thead class="theadNormal">
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Thuộc tính</th>
                                        <th>Sku</th>
                                        <th>BarCode</th>
                                        <th>Giá bán lẻ</th>
                                        <th>Giá so sánh</th>
                                        <th>Khối lượng</th>
                                        <th>Bảo hành</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodyVariantValue">
                                    <?php foreach($listProductChilds as $pc){ ?>
                                        <tr>
                                            <td><img class="variantImg" src="<?php echo $pc['ProductImage']; ?>"/></td>
                                            <td class="variantValue"><?php echo $pc['ProductName']; ?></td>
                                            <td><input type="text" class="form-control hmdrequired sku" value="<?php echo $pc['Sku']; ?>" data-field="Sku"></td>
                                            <td><input type="text" class="form-control hmdrequired barCode" value="<?php echo $pc['BarCode']; ?>" data-field="BarCode"></td>
                                            <td><input type="text" class="form-control cost hmdrequiredNumber price" value="<?php echo priceFormat($pc['Price']); ?>" data-field="Giá bán lẻ"></td>
                                            <td><input type="text" class="form-control cost hmdrequiredNumber oldPrice" value="<?php echo priceFormat($pc['OldPrice']); ?>" data-field="Giá so sánh"></td>
                                            <td><input type="text" class="form-control cost hmdrequiredNumber weight" value="<?php echo priceFormat($pc['Weight']); ?>" data-field="Khối lượng"></td>
                                            <td><input type="text" class="form-control cost hmdrequiredNumber guaranteeMonth" value="<?php echo $pc['GuaranteeMonth']; ?>" data-field="Bảo hành"></td>
                                            <td><a href="javascript:void(0)" class="link_delete"><i class="fa fa-times" title="Xóa"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <ul class="list-inline pull-right" style="margin-right: 10px;">
                        <li><input class="btn btn-primary submit" type="submit" name="submit" value="Lưu"></li>
                        <li><a href="<?php echo base_url('product'); ?>" id="productListUrl" class="btn btn-default">Hủy</a></li>
                        <input type="text" hidden="hidden" id="productId" value="<?php echo $productId; ?>">
                        <input type="text" hidden="hidden" id="productKindId" value="<?php echo $product['ProductKindId']; ?>">
                        <input type="text" hidden="hidden" id="productDisplayTypeId" value="<?php echo $product['ProductDisplayTypeId']; ?>">
                        <input type="text" hidden="hidden" id="parentProductId" value="<?php echo $product['ParentProductId']; ?>">
                        <?php foreach($tagNames as $tagName){ ?>
                            <input type="text" hidden="hidden" class="tagName" value="<?php echo $tagName; ?>">
                        <?php } ?>
                    </ul>
                    <?php echo form_close(); ?>
                </section>
            <?php } else { ?>
                <section class="content"><?php $this->load->view('includes/notice'); ?></section>
            <?php } ?>
        </div>
    </div>
<?php $this->load->view('includes/footer'); ?>