$(document).ready(function(){
    province();
    $('.submit').click(function(){
        if(validateEmpty('#storeForm')) {
            if($('#headUserId option:selected').val() == 0){
                showNotification('Vui lòng chọn Người phụ trách', 0);
                $('select#headUserId').focus();
                return false;
            }
            var userIds = JSON.stringify($('select#userId').val());
            if(userIds == null || userIds == 'null'){
                showNotification('Chưa chọn Nhân viên', 0);
                $('select#userId').focus();
                return false;
            }
            $('input#userIds').val(userIds);
            var form = $('#storeForm');
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1 ) redirect(false, $('a#storeListUrl').attr('href'));
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });

    $("#tbodyStore").on("click", "a.link_delete", function(){
        if($('input#deleteStore').val() == '1') {
            if (confirm('Bạn có thực sự muốn xóa ?')){
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "POST",
                    url: $('input#changeStatusUrl').val(),
                    data: {
                        StoreId: id,
                        StoreStatusId: 0
                    },
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json.code == 1) $('tr#store_' + id).remove();
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

    $("#tbodyStore").on("click", "a.link_status", function(){
        if($('input#changeStatus').val() == '1'){
            var id = $(this).attr('data-id');
            var statusId = $(this).attr('data-status');
            if(statusId != $('input#statusId_' + id).val()) {
                $.ajax({
                    type: "POST",
                    url: $('input#changeStatusUrl').val(),
                    data: {
                        StoreId: id,
                        StoreStatusId: statusId
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
        else showNotification('Bạn không có quyền cập nhật trạng thái Cơ sở', 0);
        $('#btnGroup_' + id).removeClass('open');
        return false;
    });
});