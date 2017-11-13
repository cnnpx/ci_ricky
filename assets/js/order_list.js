$(document).ready(function () {
    actionItemAndSearch({
        ItemName: 'Đơn hàng',
        extendFunction: function(itemIds, actionCode){
            if(actionCode.indexOf('verify_order-') >= 0) {
                actionCode = actionCode.split('-');
                if (actionCode.length == 2) {
                    var verifyStatusId = parseInt(actionCode[1]);
                    $.ajax({
                        type: "POST",
                        url: $('input#changeVerifyStatusBatchUrl').val(),
                        data: {
                            OrderIds: JSON.stringify(itemIds),
                            VerifyStatusId: verifyStatusId
                        },
                        success: function (response) {
                            var json = $.parseJSON(response);
                            showNotification(json.message, json.code);
                            if (json.code == 1){
                                var i;
                                if(verifyStatusId == 2){
                                    for (i = 0; i < itemIds.length; i++){
                                        if($('td#orderCode_' + itemIds[i] + ' i.fa-check').length == 0) $('td#orderCode_' + itemIds[i]).append('<i class="fa fa-check tooltip1 active" title="Đã xác thực"></i>');
                                    }
                                    $('#tbodyOrder i.fa-check').tooltip();
                                }
                                else{
                                    for (i = 0; i < itemIds.length; i++) $('td#orderCode_' + itemIds[i] + ' i.fa-check').remove();
                                }
                            }
                        },
                        error: function (response) {
                            showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                        }
                    });
                }
            }
        }
    });
    $('#tbodyOrder i.tooltip1').tooltip();
});