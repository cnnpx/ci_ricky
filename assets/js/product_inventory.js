$(document).ready(function(){
    actionItemAndSearch({
        ItemName: 'Tồn kho',
        extendFunction: function(itemIds, actionCode){}
    });
    $('#tbodyProduct .btn-flat').click(function(){
        $('#tbodyProduct .btn-flat').removeClass('btn-primary').addClass('btn-default');
        $(this).removeClass('btn-default').addClass('btn-primary');
    });
    $('tbody').on('keyup', 'input.quantity', function(){
        var value = $(this).val();
        $(this).val(formatDecimal(value));
    });
    $('#tbodyProduct').on('click', '.btnUpdateQuantity', function(){
        updateInventory($(this).attr('data-product'), $(this).attr('data-child'), 0, 1);
    });
    $('.tdQuantity').each(function(){
        var id = $(this).attr('data-product');
        var childId = $(this).attr('data-child');
        var storeId = parseInt($('select#storeId_' + id + '_' + childId).val());
        if(storeId > 0) getQuantity(id, childId, storeId);
    });
    $('select.storeId').change(function(){
        var id = $(this).attr('data-product');
        var childId = $(this).attr('data-child');
        var storeId = parseInt($(this).val());
        if(storeId > 0) getQuantity(id, childId, storeId);
    });

    $('#tbodyInventory .btn-flat').click(function(){
        $(this).parent().find('.btn').removeClass('btn-primary').addClass('btn-default');
        $(this).removeClass('btn-default').addClass('btn-primary');
    });
    $('#tbodyInventory').on('click', '.btnUpdateQuantity', function(){
        updateInventory($(this).attr('data-product'), $(this).attr('data-child'), $(this).attr('data-id'), $(this).attr('data-status'));
    });
});

function getQuantity(id, childId, storeId){
    $.ajax({
        type: "POST",
        url: $('input#getCurentQuantityUrl').val(),
        data: {
            ProductId: id,
            ProductChildId: childId,
            StoreId: storeId
        },
        success: function (response) {
            console.log(response);
            $('.tdQuantity[data-product="' + id + '"][data-child="' + childId + '"]').text(response);
        },
        error: function (response) {

        }
    });
}

function updateInventory(id, childId, inventoryId, statusId){
    if($('#trItem_' + id + '_' + childId + ' .btn-primary').length > 0) {
        var quantity = replaceCost($('input#quantity_' + id + '_' + childId).val(), true);
        var inventoryTypeId = parseInt($('#trItem_' + id + '_' + childId + ' .btn-primary').attr('data-id'));
        if(inventoryTypeId == 2 && quantity < 0){
            showNotification('Số lượng nhập phải lớn hơn 0', 0);
            return false;
        }
        if(inventoryTypeId == 1 && quantity == 0){
            showNotification('Số lượng nhập phải khác 0', 0);
            return false;
        }
        var storeId = parseInt($('select#storeId_' + id + '_' + childId).val());
        if(storeId > 0){
            $.ajax({
                type: "POST",
                url: $('input#updateInventoryUrl').val(),
                data: {
                    InventoryId: inventoryId,
                    ProductId: id,
                    ProductChildId: childId,
                    Quantity: quantity,
                    InventoryTypeId: inventoryTypeId,
                    StoreId: storeId,
                    StatusId: statusId,
                    Comment: $('input#comment_' + id + '_' + childId).val().trim()
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(statusId == 1) {
                        $('input#quantity_' + id + '_' + childId).val('0');
                        $('input#comment_' + id + '_' + childId).val('');
                        $('#trItem_' + id + '_' + childId + ' .btn-flat').removeClass('btn-primary').addClass('btn-default');
                    }
                    else $('#trItem_' + id + '_' + childId).remove();
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        else showNotification('Vui lòng chọn kho nhập', 0);
    }
    else showNotification('Vui lòng chọn kiểu Cộng thêm hoặc Set', 0);
}