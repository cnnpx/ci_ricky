$(document).ready(function(){
    actionItemAndSearch({
        ItemName: $('input#itemTypeName').val(),
        extendFunction: function(itemIds, actionCode){}
    });
});

function changeDisplayOrder(select, categoryId){
    var cateInfo = $('input#cateInfo_' + categoryId);
    $.ajax({
        type: "POST",
        url: $('input#changeDisplayOrderUrl').val(),
        data: {
            CategoryId: categoryId,
            DisplayOrder: select.value,
            ItemTypeId: $('input#itemTypeId').val(),
            ProductTypeId: cateInfo.val(),
            CategoryTypeId: cateInfo.attr('data-type'),
            ParentCategoryId: cateInfo.attr('data-parent')
        },
        success: function (response) {
            var json = $.parseJSON(response);
            showNotification(json.message, json.code);
            if(json.code == 1) redirect(true, '');
        },
        error: function (response) {
            showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
        }
    });
}