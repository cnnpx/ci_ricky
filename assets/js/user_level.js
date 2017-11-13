$(document).ready(function(){
    $("#tbodyUserLevel").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#userLevelId').val(id);
        $('input#userLevelName').val($('td#userLevelName_' + id).text());
        scrollTo('input#userLevelName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#userLevelForm').trigger("reset");
        return false;
    });
    $("#tbodyUserLevel").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deleteUserLevelUrl').val(),
                data: {
                    UserLevelId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#userLevel_' + id).remove();
                    showNotification(json.message, json.code);
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
    $('a#link_update').click(function(){
        if (validateEmpty('#userLevelForm')) {
            var form = $('#userLevelForm');
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    var json = $.parseJSON(response);
                    if(json.code == 1){
                        form.trigger("reset");
                        var data = json.data;
                        if(data.IsAdd == 1){
                            var html = '<tr id="userLevel_' + data.UserLevelId + '">';
                            html += '<td id="userLevelName_' + data.UserLevelId + '">' + data.UserLevelName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.UserLevelId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.UserLevelId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyUserLevel').prepend(html);
                        }
                        else $('td#userLevelName_' + data.UserLevelId).text(data.UserLevelName);
                    }
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