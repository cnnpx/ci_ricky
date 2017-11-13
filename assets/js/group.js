$(document).ready(function(){
    $("#tbodyGroup").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#groupId').val(id);
        $('input#groupName').val($('td#groupName_' + id).text());
        scrollTo('input#groupName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#groupForm').trigger("reset");
        return false;
    });
    $("#tbodyGroup").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deleteGroupUrl').val(),
                data: {
                    GroupId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#group_' + id).remove();
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
        if (validateEmpty('#groupForm')) {
            var form = $('#groupForm');
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
                            var html = '<tr id="group_' + data.GroupId + '">';
                            html += '<td id="groupName_' + data.GroupId + '">' + data.GroupName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.GroupId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.GroupId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '<a href="' + $('input#groupActionUrl').val() + data.GroupId + '" target="_blank" title="Cấp quyền"><i class="fa fa-unlock"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyGroup').prepend(html);
                        }
                        else $('td#groupName_' + data.GroupId).text(data.GroupName);
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