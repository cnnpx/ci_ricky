$(document).ready(function() {
    $('input.iCheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
    $(document).on('submit','#userForm',function (){
        if(validateEmpty('#userForm')) {
            var form = $('#userForm');
            var data = form.serialize();
            form.find('input, button').prop("disabled", true);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: form.attr('action'),
                data: data,
                success: function (response) {
                    var json = response;// $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1) redirect(false, $('input#dashboardUrl').val());
                    else form.find('input, button').prop("disabled", false);
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                    form.find('input, button').prop("disabled", false);
                }
            });
        }
        return false;
    });
});