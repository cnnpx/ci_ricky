$(document).ready(function(){
    $("#tbodyOrderType").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#orderTypeId').val(id);
        $('input#orderTypeName').val($('td#orderTypeName_' + id).text());
        scrollTo('input#orderTypeName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#orderTypeForm').trigger("reset");
        return false;
    });
    $("#tbodyOrderType").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deleteOrderTypeUrl').val(),
                data: {
                    OrderTypeId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#orderType_' + id).remove();
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
        if (validateEmpty('#orderTypeForm')) {
            var form = $('#orderTypeForm');
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
                            var html = '<tr id="orderType_' + data.OrderTypeId + '">';
                            html += '<td id="orderTypeName_' + data.OrderTypeId + '">' + data.OrderTypeName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.OrderTypeId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.OrderTypeId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyOrderType').prepend(html);
                        }
                        else $('td#orderTypeName_' + data.OrderTypeId).text(data.OrderTypeName);
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