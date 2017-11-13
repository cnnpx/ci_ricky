$(document).ready(function(){
    $("#tbodyOtherService").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#otherServiceId').val(id);
        $('input#otherServiceName').val($('td#otherServiceName_' + id).text());
        scrollTo('input#otherServiceName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#otherServiceForm').trigger("reset");
        return false;
    });
    $("#tbodyOtherService").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deleteOtherServiceUrl').val(),
                data: {
                    OtherServiceId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#otherService_' + id).remove();
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
        if (validateEmpty('#otherServiceForm')) {
            var form = $('#otherServiceForm');
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
                            var html = '<tr id="otherService_' + data.OtherServiceId + '">';
                            html += '<td id="otherServiceName_' + data.OtherServiceId + '">' + data.OtherServiceName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.OtherServiceId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.OtherServiceId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyOtherService').prepend(html);
                        }
                        else $('td#otherServiceName_' + data.OtherServiceId).text(data.OtherServiceName);
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