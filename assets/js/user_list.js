$(document).ready(function() {
    $("#tbodyUser").on("click", "a.link_delete", function(){
        if($('input#deleteUser').val() == '1') {
            if (confirm('Bạn có thực sự muốn xóa ?')){
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: $('input#changeStatusUrl').val(),
                    data: {
                        UserId: id,
                        StatusId: 0
                    },
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json.code == 1) $('tr#user_' + id).remove();
                        showNotification(json.message, json.code);
                    },
                    error: function (response) {
                        showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                    }
                });
            }
        }
        else showNotification('Bạn không có quyền xóa Nhân viên', 0);
        return false;
    });
    $("#tbodyUser").on("click", "a.link_status", function(){
        if($('input#changeStatus').val() == '1'){
            var id = $(this).attr('data-id');
            var statusId = $(this).attr('data-status');
            if(statusId != $('input#statusId_' + id).val()) {
                $.ajax({
                    type: "POST",
                    url: $('input#changeStatusUrl').val(),
                    data: {
                        UserId: id,
                        StatusId: statusId
                    },
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json.code == 1){
                            $('td#statusName_' + id).html(json.data.StatusName);
                            $('input#statusId_' + id).val(statusId);
                        }
                        showNotification(json.message, json.code);
                    },
                    error: function (response) {
                        showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                    }
                });
            }
        }
        else showNotification('Bạn không có quyền cập nhật trạng thái Nhân viên', 0);
        $('#btnGroup_' + id).removeClass('open');
        return false;
    });
});