$(document).ready(function () {
    chooseCustomer(function(li){
        var customerId = parseInt(li.attr('data-id'));
        $('input#customerId').val(customerId);
        $('input#customerName').val(li.find('.pCustomerName').text());
        getListOrder(customerId, 0);
    });
    if($('select#moneySourceId').val() == '2') $('#divMoneyPhone').show();
    $('select#moneySourceId').change(function(){
        if($(this).val() == '2') $('#divMoneyPhone').show();
        else{
            $('#divMoneyPhone').hide();
            $('select#moneyPhone').val('0');
        }
    });
    $('#transactionForm').on('keyup', 'input#paidCost', function(){
        var value = $(this).val().trim();
        $(this).val(formatDecimal(value));
    });
    var tags = [];
    var transportTags = [];
    $('input#tags').tagsInput({
        'width': '100%',
        'height': '90px',
        'interactive': true,
        'defaultText': '',
        'onAddTag': function(tag){
            tags.push(tag);
        },
        'onRemoveTag': function(tag){
            var index = tags.indexOf(tag);
            if(index >= 0) tags.splice(index, 1);
        },
        'delimiter': [',', ';'],
        'removeWithBackspace': true,
        'minChars': 0,
        'maxChars': 0
    });
    var transactionId = parseInt($('input#transactionId').val());
    if(transactionId > 0){
        $('input.tagName').each(function () {
            $('input#tags').addTag($(this).val());
        });
        getListOrder($('input#customerId').val(), $('input#orderId1').val());
    }
    $('.submit').click(function(){
        var customerId = parseInt($('input#customerId').val());
        if(customerId == 0){
            showNotification('Vui lòng chọn Khách hàng', 0);
            return false;
        }
        var orderId = parseInt($('select#orderId').val());
        if(orderId == 0){
            showNotification('Vui lòng chọn Đơn hàng', 0);
            return false;
        }
        if($('select#moneySourceId').val() == '2' && $('select#moneyPhoneId').val() == '0'){
            showNotification('Vui lòng chọn Số máy nạp vào', 0);
            return false;
        }
        var paidCost = replaceCost($('input#paidCost').val(), true);
        if(paidCost > 0){
            $.ajax({
                type: "POST",
                url: $('#transactionForm').attr('action'),
                data: {
                    TransactionId: transactionId,
                    CustomerId: customerId,
                    OrderId: orderId,
                    TransactionTypeId: $('select#transactionTypeId').val(),
                    TransactionStatusId: $('#transactionStatusId').val(),
                    StoreId: $('select#storeId').val(),
                    MoneySourceId: $('select#moneySourceId').val(),
                    MoneyPhoneId: $('select#moneyPhoneId').val(),
                    PaidCost: paidCost,
                    Comment: $('#comment').val().trim(),

                    TagNames: JSON.stringify(tags)
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1 ) redirect(false, $('a#transactionListUrl').attr('href'));
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        else showNotification('Số tiền phải lơn hơn 0', 0);
        return false;
    });
});

function getListOrder(customerId, orderId){
    $('select#orderId').html('<option value="0">Chọn đơn hàng</option>');
    $.ajax({
        type: "POST",
        url: $('input#getListOrderUrl').val(),
        data: {
            CustomerId : customerId
        },
        success: function (response) {
            var json = $.parseJSON(response);
            if(json.code == 1){
                var data = json.data;
                var html = '';
                for(var i = 0; i < data.length; i++) html += '<option value="' + data[i].OrderId + '">' + data[i].OrderCode + '</option>';
                $('select#orderId').append(html).val(orderId);
            }
            else showNotification(json.message, json.code);
        },
        error: function (response) {
            showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
        }
    });
}