$(document).ready(function(){
    $('#checkAll, #unCheckAll, #btnUpdate').hide();
    $('input.iCheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
    $('#checkAll').click(function(){
        $('input.iCheck').iCheck('check');
        $(this).hide();
        $('#unCheckAll').show();
        return false;
    });
    $('#unCheckAll').click(function(){
        $('input.iCheck').iCheck('uncheck');
        $(this).hide();
        $('#checkAll').show();
        return false;
    });
    getActions(parseInt($('select#groupId').val()));
    $('select#groupId').change(function(){
        $('input.iCheck').iCheck('uncheck');
        getActions(parseInt($(this).val()));
    });
    $('#btnUpdate').click(function(){
        var groupId = parseInt($('select#groupId').val());
        if(groupId > 0){
            var actionIds = [];
            $('.icheckbox_square-blue').each(function(){
                if($(this).hasClass('checked')) actionIds.push($(this).find('input.iCheck').val());
            });
            $.ajax({
                type: "POST",
                url: $('input#updateGroupActionUrl').val(),
                data: {
                    GroupId: groupId,
                    ActionIds: JSON.stringify(actionIds)
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
    })
});

function getActions(groupId){
    if(groupId > 0){
        $('#checkAll, #unCheckAll, #btnUpdate').show();
        $.ajax({
            type: "POST",
            url: $('input#getActionUrl').val(),
            data: {
                GroupId: groupId
            },
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.code == 1){
                    var data = json.data;
                    for(var i = 0; i < data.length; i++) $('input#cbAction_' + data[i].ActionId).iCheck('check');
                }
                else showNotification(json.message, json.code);
            },
            error: function (response) {
                showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
            }
        });
    }
    else $('#checkAll, #unCheckAll, #btnUpdate').hide();
}