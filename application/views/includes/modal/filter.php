<div class="modal fade" role="dialog" id="save-filter">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 500px;margin: 0px auto">
            <input type="hidden" name="item_type" id="item-type" value="<?= $itemTypeId ?>"/>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Bạn muốn lưu tìm kiếm này như thế nào?</h4>
            </div>
            <div class="modal-body">
                <div class="form-group mb0">
                    <label for="save-new-search" class="next-label">
                        <input type="radio" name="option_save" checked class=" hrv-radio"
                               id="ra-save-new-filter">
                        Lưu tìm kiếm mới
                    </label>
                </div>
                <div class="form-group mb0">
                    <label for="overwrite-saved-search" class="next-label">
                        <input type="radio" class=" hrv-radio" name="option_save"
                               id="ra-save-exits-filter">
                        Lưu đè lên tìm kiếm đã tồn tại
                    </label>
                </div>

                <div class="form-group mt10" id="input-name-new">
                    <label class="next-label" for="new-saved-search-name">Tên</label>
                    <input id="new-save-name" name="name_new" class="form-control" type="text">
                </div>

                <div class="form-group mt10 none-display" id="input-name-exits">
                    <label for="new-saved-search-name" class="center-block next-label">Tìm kiếm nào bạn muốn lưu
                        đè?</label>
                    <select class="form-control" id="filter_list_name">
                        <option selected value="">Chưa có gì</option>
                        <?php foreach ($listFilters as $f): ?>
                            <option value="<?=$f['FilterId']?>"><?=$f['FilterName']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-toggle="modal" data-dismiss="modal">Hủy
                </button>
                <button type="button" data-url="<?=base_url('filter/save')?>" class="btn btn-primary" id="btn-save-filter">Lưu</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>