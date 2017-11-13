$(document).ready(function () {
    CKEDITOR.replace('CategoryDesc', {
        language: 'vi',
        toolbar : 'ShortToolbar',
        height: 200
    });
    $('#categoryForm').on('focusout', 'input#categoryName', function(){
        $('input#categorySlug').val(makeSlug($(this).val()));
    });
    $('.submit').click(function(){
        if(validateEmpty('#categoryForm')) {
            /*for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
             }*/
            CKEDITOR.instances['CategoryDesc'].updateElement();
            var form = $('#categoryForm');
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1 && $('input#categoryId').val() == '0') redirect(false, $('a#categoryListUrl').attr('href'));
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
});