$(document).ready(function(){
    $("#tbodyCustomerGroup").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#customerGroupId').val(id);
        $('input#customerGroupName').val($('td#customerGroupName_' + id).text());
        scrollTo('input#customerGroupName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#customerGroupForm').trigger("reset");
        return false;
    });
    $("#tbodyCustomerGroup").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deleteCustomerGroupUrl').val(),
                data: {
                    CustomerGroupId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#customerGroup_' + id).remove();
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
        if (validateEmpty('#customerGroupForm')) {
            var form = $('#customerGroupForm');
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
                            var html = '<tr id="customerGroup_' + data.CustomerCustomerGroupId + '">';
                            html += '<td id="customerGroupName_' + data.CustomerGroupId + '">' + data.CustomerGroupName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.CustomerGroupId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.CustomerGroupId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyCustomerGroup').prepend(html);
                        }
                        else $('td#customerGroupName_' + data.CustomerGroupId).text(data.CustomerGroupName);
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