$(document).ready(function(){
    $('#aExpandCost').click(function(){
        var tr = $('.trCost');
        tr.toggleClass('active1');
        if(tr.first().hasClass('active1')){
            tr.show();
            $(this).text('Thu gọn');
        }
        else{
            tr.hide();
            $(this).text('Mở rộng');
        }
    });
    $('input.iCheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
    if($('#tbodyProduct tr').length > 0) calcPrice(0);
    var tags = [];
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
    $('input.tagName').each(function () {
        $('input#tags').addTag($(this).val());
    });
    $('.submit').click(function(){
        $.ajax({
            type: "POST",
            url: $('#transportForm').attr('action'),
            data: {
                TransportId: $('input#transportId').val(),
                TransportCode: $('input#transportCode').val(),
                OrderId: $('input#orderId').val(),
                CustomerId: $('input#customerId').val(),
                TransportUserId: 0,
                TransportStatusId: $('select#transportStatusId').val(),
                TransportTypeId: $('select#transportTypeId').val(),
                TransporterId: $('select#transporterId').val(),
                StoreId: $('select#storeId').val(),
                Tracking: $('input#tracking').val().trim(),
                Weight: $('input#weight').val().trim(),
                CODCost: replaceCost($('input#CODCost').val(), true),
                Comment: $('#comment').val().trim(),
                CancerReasonId: 0,
                CancerReasonText: '',

                CustomerName: $('input#customerName').val().trim(),
                Email: $('input#customerEmail').val().trim(),
                PhoneNumber: $('input#customerPhone').val().trim(),
                Address: $('input#customerAddress').val().trim(),
                ProvinceId: $('select#provinceId').val(),
                DistrictId: $('select#districtId').val(),

                TagNames: JSON.stringify(tags)
            },
            success: function (response) {
                var json = $.parseJSON(response);
                showNotification(json.message, json.code);
                if (json.code == 1) redirect(true, '');
            },
            error: function (response) {
                showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
            }
        });
        return false;
    });
});

function calcPrice(sumCost){
    if(sumCost == 0) {
        $('#tbodyProduct tr').each(function () {
            sumCost += replaceCost($(this).find('input.sumPrice').val(), true);
        });
        $('input#sumCost').val(formatDecimal(sumCost.toString()));
    }
    var VATCost = Math.ceil(sumCost * parseInt($('input#VATPercent').val()) / 100);
    $('input#VATCost').val(formatDecimal(VATCost.toString()));
    var serviceCost = 0;
    $('.trService').each(function(){
        serviceCost += replaceCost($(this).find('input.cost').val(), true);
    });
    var expandCost = serviceCost + replaceCost($('input#transportCost').val(), true) - replaceCost($('input#discount').val(), true) - replaceCost($('input#preCost').val(), true);
    if($('input#isLendBack').val() == '1'){
        var collectCost = sumCost + expandCost;
        $('input#collectCost').val(formatDecimal(collectCost.toString()));
    }
    var CODCost = sumCost + VATCost + expandCost - replaceCost($('input#lendBackCost').val(), true);
    $('input#CODCost').val(formatDecimal(CODCost.toString()));
}