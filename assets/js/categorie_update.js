$(document).ready(function () {
    CKEDITOR.replace('CategoryDesc', {
        language: 'vi',
        //toolbar : 'ShortToolbar',
        height: 350
    });

    $('input.submit').click(function(){
        if(validateEmpty('#categorieForm')) {
            var form = $('#categorieForm');
            var categoryDesc = CKEDITOR.instances['CategoryDesc'].getData();
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: {
                        CategoryId: $('input#categorieId').val(),
                        CategoryName: $('input#categorieName').val().trim(),
                        CategorySlug: $('input#categorieSlug').val().trim(),
                        CategoryDesc: categoryDesc,
                        DisplayOrder: $('select#displayOrder').val(),
                        StatusId: $('select#statusId').val(),
                        ItemTypeId: $('select#itemTypeId').val(),
                        ProductTypeId: $('select#productTypeId').val(),
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1 && $('input#categorieId').val() == '0') redirect(false, $('input#categorieEditUrl').val() + '/' + json.data);

                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
});
