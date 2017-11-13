$(document).ready(function(){
    $("#tbodyPart").on("click", "a.link_edit", function(){
        var id = $(this).attr('data-id');
        $('input#partId').val(id);
        $('input#partName').val($('td#partName_' + id).text());
        scrollTo('input#partName');
        return false;
    });
    $('a#link_cancel').click(function(){
        $('#partForm').trigger("reset");
        return false;
    });
    $("#tbodyPart").on("click", "a.link_delete", function(){
        if (confirm('Bạn có thực sự muốn xóa ?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $('input#deletePartUrl').val(),
                data: {
                    PartId: id
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) $('tr#part_' + id).remove();
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
        if (validateEmpty('#partForm')) {
            var form = $('#partForm');
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
                            var html = '<tr id="part_' + data.PartId + '">';
                            html += '<td id="partName_' + data.PartId + '">' + data.PartName + '</td>';
                            html += '<td class="actions">' +
                                '<a href="javascript:void(0)" class="link_edit" data-id="' + data.PartId + '" title="Sửa"><i class="fa fa-pencil"></i></a>' +
                                '<a href="javascript:void(0)" class="link_delete" data-id="' + data.PartId + '" title="Xóa"><i class="fa fa-trash-o"></i></a>' +
                                '</td>';
                            html += '</tr>';
                            $('#tbodyPart').prepend(html);
                        }
                        else $('td#partName_' + data.PartId).text(data.PartName);
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