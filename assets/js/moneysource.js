$(document).ready(function(){
    $("#tbodyMoneySource").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#moneySourceId').val(id);
        $('input#moneySourceName').val($('td#moneySourceName_' + id).text());
        scrollTo('input#moneySourceName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#moneySourceForm').trigger("reset");
        return false;
    });
    $("#tbodyMoneySource").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deleteMoneySourceUrl').val(),
                data: {
                    MoneySourceId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#moneySource_' + id).remove();
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
        if (validateEmpty('#moneySourceForm')) {
            var form = $('#moneySourceForm');
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
                            var html = '<tr id="moneySource_' + data.MoneySourceId + '">';
                            html += '<td id="moneySourceName_' + data.MoneySourceId + '">' + data.MoneySourceName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.MoneySourceId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.MoneySourceId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyMoneySource').prepend(html);
                        }
                        else $('td#moneySourceName_' + data.MoneySourceId).text(data.MoneySourceName);
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