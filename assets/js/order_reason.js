$(document).ready(function(){
    $("#tbodyOrderReason").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#orderReasonId').val(id);
        $('input#orderReasonName').val($('td#orderReasonName_' + id).text());
        scrollTo('input#orderReasonName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#orderReasonForm').trigger("reset");
        return false;
    });
    $("#tbodyOrderReason").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deleteOrderReasonUrl').val(),
                data: {
                    OrderReasonId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#orderReason_' + id).remove();
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
        if (validateEmpty('#orderReasonForm')) {
            var form = $('#orderReasonForm');
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
                            var html = '<tr id="orderReason_' + data.OrderReasonId + '">';
                            html += '<td id="orderReasonName_' + data.OrderReasonId + '">' + data.OrderReasonName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.OrderReasonId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.OrderReasonId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyOrderReason').prepend(html);
                        }
                        else $('td#orderReasonName_' + data.OrderReasonId).text(data.OrderReasonName);
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