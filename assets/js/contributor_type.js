/**
 * Created by Luffy on 8/6/2017.
 */
$(document).ready(function(){
    $("#tbodyContributor").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')){
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#changeStatusUrl').val(),
                data: {
                    ContributorTypeId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#contributortype_' + id).remove();
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