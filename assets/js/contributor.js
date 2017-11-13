/**
 * Created by Luffy on 8/1/2017.
 */
$(document).ready(function(){
    if($('.datepicker').length > 0) {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    }
    $(document).on('submit','#contributorsForm',function (){
        if(validateEmpty('#contributorsForm')) {
            var form = $('#contributorsForm');
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: {
                    ContributorId  : $('input#contributorId').val(),
                    ContributorName : $('input#contributorName').val().trim(),
                    ContributorPhone: $('input#contributorPhone').val().trim(),
                    BirthDay    : $('input#birthDay').val(),
                    Address     : $('input#address').val(),
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1) redirect(false, $('input#contributorEditUrl').val());
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
    $("#tbodyContributor").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')){
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#changeStatusUrl').val(),
                data: {
                    ContributorId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#contributor_' + id).remove();
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