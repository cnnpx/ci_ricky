$(document).ready(function(){
    $("#tbodyCancelReason").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#cancelReasonId').val(id);
        $('input#cancelReasonName').val($('td#cancelReasonName_' + id).text());
        scrollTo('input#cancelReasonName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#cancelReasonForm').trigger("reset");
        return false;
    });
    $("#tbodyCancelReason").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deleteCancelReasonUrl').val(),
                data: {
                    CancelReasonId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#cancelReason_' + id).remove();
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
        if (validateEmpty('#cancelReasonForm')) {
            var form = $('#cancelReasonForm');
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
                            var html = '<tr id="cancelReason_' + data.CancelReasonId + '">';
                            html += '<td id="cancelReasonName_' + data.CancelReasonId + '">' + data.CancelReasonName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.CancelReasonId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.CancelReasonId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyCancelReason').prepend(html);
                        }
                        else $('td#cancelReasonName_' + data.CancelReasonId).text(data.CancelReasonName);
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