$(document).ready(function(){
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
    $('input.iCheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
    $('.chooseImage').click(function(){
        var finder = new CKFinder();
        finder.resourceType = 'Users';
        finder.selectActionFunction = function(fileUrl) {
            $('input#avatar').val(fileUrl);
            $('img#imgAvatar').attr('src', fileUrl);
        };
        finder.popup();
    });
    $('a#generatorPass').click(function(){
        var pass = randomIntFromInterval(100000000, 999999999);
        $('input#newPass').val(pass);
        $('input#rePass').val(pass);
        return false;
    });
    $(document).on('submit','#userForm',function (){
        if(validateEmpty('#userForm')) {
            if ($('input#newPass').val() != $('input#rePass').val()) {
                showNotification('Mật khẩu không trùng', 0);
                return false;
            }
            if($('input#userName').length > 0 && $('input#userName').val().trim().indexOf(' ') >= 0){
                showNotification('Tên đăng nhập không được có khoảng trằng', 0);
                $('input#userName').focus();
                return false;
            }
            var form = $('#userForm');
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1 && $('input#userId').val() == '0') redirect(false, $('input#userEditUrl').val() + '/' + json.data);
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
});

function randomIntFromInterval(min,max){
    return Math.floor(Math.random()*(max-min+1)+min);
}