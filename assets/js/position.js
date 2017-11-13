$(document).ready(function(){
    $("#tbodyPosition").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#positionId').val(id);
        $('input#positionName').val($('td#positionName_' + id).text());
        scrollTo('input#positionName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#positionForm').trigger("reset");
        return false;
    });
    $("#tbodyPosition").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deletePositionUrl').val(),
                data: {
                    PositionId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#position_' + id).remove();
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
        if (validateEmpty('#positionForm')) {
            var form = $('#positionForm');
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
                            var html = '<tr id="position_' + data.PositionId + '">';
                            html += '<td id="positionName_' + data.PositionId + '">' + data.PositionName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.PositionId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.PositionId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyPosition').prepend(html);
                        }
                        else $('td#positionName_' + data.PositionId).text(data.PositionName);
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