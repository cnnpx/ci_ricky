/**
 * Created by Luffy on 7/25/2017.
 */
$(document).ready(function(){
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
    $(document).on('submit','#productTypeForm',function (){
        if(validateEmpty('#productTypeForm')) {
            var form = $('#productTypeForm');
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: {
                    ProductTypeId  : $('input#productTypeId').val(),
                    ProductTypeName: $('input#productTypeName').val().trim(),
                    IsShare        : $('select#isShare').val(),
                    ActiveDate     : $('input#activeDate').val()
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1) redirect(false, $('input#productTypeEditUrl').val());
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
    $("#tbodyProductTypes").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')){
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#changeStatusUrl').val(),
                data: {
                    ProductTypeId: id,
                    SttausId: 0
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#producttype_' + id).remove();
                    showNotification(json.message, json.code);
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });

});