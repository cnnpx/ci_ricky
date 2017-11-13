$(document).ready(function() {
    $("#tbodyArticle").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')){
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#changeStatusUrl').val(),
                data: {
                    ArticleId: id,
                    StatusId: 0
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#article_' + id).remove();
                    showNotification(json.message, json.code);
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
    $("#tbodyArticle").on("click", "a.link_status", function(){
        var id = $(this).attr('data-id');
        var statusId = $(this).attr('data-status');
        if(statusId != $('input#statusId_' + id).val()) {
            $.ajax({
                type: "POST",
                url: $('input#changeStatusUrl').val(),
                data: {
                    ArticleId: id,
                    StatusId: statusId
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if (json.code == 1){
                        $('td#statusName_' + id).html(json.data.StatusName);
                        $('input#statusId_' + id).val(statusId);
                    }
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        $('#btnGroup_' + id).removeClass('open');
        return false;
    });
});