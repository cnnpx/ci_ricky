$(document).ready(function(){
    $("#tbodyMoneyPhone").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#moneyPhoneId').val(id);
        $('input#moneyPhoneName').val($('td#moneyPhoneName_' + id).text());
        scrollTo('input#moneyPhoneName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#moneyPhoneForm').trigger("reset");
        return false;
    });
    $("#tbodyMoneyPhone").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deleteMoneyPhoneUrl').val(),
                data: {
                    MoneyPhoneId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#moneyPhone_' + id).remove();
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
        if (validateEmpty('#moneyPhoneForm')) {
            var form = $('#moneyPhoneForm');
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
                            var html = '<tr id="moneyPhone_' + data.MoneyPhoneId + '">';
                            html += '<td id="moneyPhoneName_' + data.MoneyPhoneId + '">' + data.MoneyPhoneName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.MoneyPhoneId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.MoneyPhoneId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyMoneyPhone').prepend(html);
                        }
                        else $('td#moneyPhoneName_' + data.MoneyPhoneId).text(data.MoneyPhoneName);
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