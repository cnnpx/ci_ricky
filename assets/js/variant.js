$(document).ready(function(){
    $("#tbodyVariant").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#variantId').val(id);
        $('input#variantName').val($('td#variantName_' + id).text());
        scrollTo('input#variantName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#variantForm').trigger("reset");
        return false;
    });
    $("#tbodyVariant").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deleteVariantUrl').val(),
                data: {
                    VariantId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#variant_' + id).remove();
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
        if (validateEmpty('#variantForm')) {
            var form = $('#variantForm');
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1){
                        form.trigger("reset");
                        var data = json.data;
                        if(data.IsAdd == 1){
                            var html = '<tr id="variant_' + data.VariantId + '">';
                            html += '<td id="variantName_' + data.VariantId + '">' + data.VariantName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.VariantId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.VariantId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyVariant').prepend(html);
                        }
                        else $('td#variantName_' + data.VariantId).text(data.VariantName);
                    }
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
});