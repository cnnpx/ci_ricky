$(document).ready(function () {
    $('input.iCheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
    $('select#promotionTypeId').change(function(){
        $('.divPromotionTypeId').hide();
        $('select#reduceTypeId').val('1');
        $('#spanCurrency').text('VNĐ');
        $('select#provinceId').val('0').hide();
        $('select#promotionItemTypeId').show();
        $('#lbReduceNumber').text('Giá trị giảm');
        $('input#promotionName').val('');
        $('input#itemName').val('');
        $('input#customerId').val('0');
        $('input#productId').val('0');
        $('input#productChildId').val('0');
        var id = parseInt($(this).val());
        $('.divPromotionTypeId_' + id).show();
        if(id == 1){
            $('select#promotionItemTypeId').val('0');
            $('select#promotionItemTypeId option.promotionItemId_1').show();
            $('.divPromotionItemTypeId').hide();
            $('#lbPromotionName').html('Mã khuyến mãi <span class="required">*</span><a href="javascript:void(0)" id="aGenPromotionName" class="pull-right">Tạo mã tự động</a>');
            $('input#promotionName').attr('data-field', 'Mã khuyến mại');
        }
        else{
            $('select#promotionItemTypeId').val('1');
            $('select#promotionItemId').html($('select#categoryIdHidden').html());
            $('select#promotionItemTypeId option.promotionItemId_1').hide();
            $('.divPromotionItemTypeId').hide();
            $('.divPromotionItemTypeId_1').show();
            $('#lbPromotionName').html('Tên chương trình khuyến mại <span class="required">*</span>');
            $('input#promotionName').attr('data-field', 'Tên chương trình khuyến mại');
        }
    });
    $('select#reduceTypeId').change(function(){
        $('.divPromotionItemTypeId').hide();
        $('.divPromotionTypeId').hide();
        var id = parseInt($(this).val());
        if(id == 1){
            $('#lbReduceNumber').text('Giá trị giảm');
            $('#spanCurrency').text('VNĐ');
            $('select#provinceId').val('0').hide();
            $('select#promotionItemTypeId').show();
            var promotionItemTypeId = $('select#promotionItemTypeId').val();
            $('.divPromotionItemTypeId_' + promotionItemTypeId).show();
            $('.divPromotionTypeId_' + promotionItemTypeId).show();
        }
        else if(id == 2){
            $('#lbReduceNumber').text('Giá trị giảm');
            $('#spanCurrency').text('%');
            $('select#provinceId').val('0').hide();
            $('select#promotionItemTypeId').show();
            var promotionItemTypeId = $('select#promotionItemTypeId').val();
            $('.divPromotionItemTypeId_' + promotionItemTypeId).show();
            $('.divPromotionTypeId_' + promotionItemTypeId).show();
        }
        else if(id == 3){
            $('#lbReduceNumber').text('Đối với mức phí vận chuyển nhỏ hơn hoặc bằng');
            $('#spanCurrency').text('VNĐ');
            $('select#promotionItemTypeId').hide();
            $('select#provinceId').val('0').show();
        }
    });
    $('select#promotionItemTypeId').change(function(){
        $('.divPromotionItemTypeId').hide();
        $('input#itemName').val('');
        $('input#customerId').val('0');
        $('input#productId').val('0');
        $('input#productChildId').val('0');
        var id = parseInt($(this).val());
        if(id == 1) $('select#promotionItemId').html($('select#categoryIdHidden').html());
        else if(id == 11) $('select#promotionItemId').html($('select#customerGroupId').html());
        $('.divPromotionItemTypeId_' + id).show();
    });
    chooseCustomer(function(li){
        $('input#customerId').val(li.attr('data-id'));
        $('input#itemName').val(li.find('.pCustomerName').text());
    });
    chooseProduct();
    $('#tbodyProductSearch').on('click', 'tr', function () {
        $('#panelProduct').removeClass('active');
        $("#panelProduct .panel-body").css("width", "99%");
        $('select#categoryId').val('0');
        var productId = $(this).attr('data-id');
        var childId = $(this).attr('data-child');
        var productName = $(this).find('td:nth-child(2)').text();
        if(childId != '0'){
            $('#tbodyProductSearch tr[data-id="'+productId+'"]').each(function(){
                if($(this).attr('data-child') == '0'){
                    productName = $(this).find('td:nth-child(2)').text() + ' (' + productName + ')';
                    return false;
                }
            });
        }
        $('input#productId').val(productId);
        $('input#productChildId').val(childId);
        $('input#itemName').val(productName);

    });
    $('#promotionForm').on('keyup', 'input.cost', function () {
        var value = $(this).val();
        $(this).val(formatDecimal(value));
    });
    $('input#cbUnlimit').on('ifToggled', function(e){
        if(e.currentTarget.checked) $('input#numberUse').val('∞').prop('disabled', true);
        else $('input#numberUse').val('1').prop('disabled', false);
    });
    $('input#cbEndDate').on('ifToggled', function(e){
        if(e.currentTarget.checked) $('input#endDate').val('').prop('disabled', true);
        else $('input#endDate').val($('input#beginDate').val()).prop('disabled', false);
    });
    $('#lbPromotionName').on('click', '#aGenPromotionName', function(){
        $('input#promotionName').val(randomPassword(10));
    });
    $('.submit').click(function(){
        if(validateEmpty('#promotionForm')) {
            $('.submit').prop('disabled', true);
            //validate
            var validate = true;
            var numberUse = 0;
            var isSharePromotion = 1;
            var productNumber = 0;
            var promotionTypeId = parseInt($('select#promotionTypeId').val());
            if(promotionTypeId == 1){
                if(!($('input#cbUnlimit').parent('div').hasClass('checked'))){
                    numberUse = replaceCost($('input#numberUse').val().trim(), true);
                    if(numberUse <= 0){
                        showNotification('Số lần sử dụng của mã khuyến mãi phải lớn hơn 0', 0);
                        $('input#numberUse').focus();
                        validate = false;
                    }
                }
                if(($('input#cbIsSharePromotion').parent('div').hasClass('checked'))) isSharePromotion = 2;
            }
            else{
                productNumber = replaceCost($('input#productNumber').val().trim(), true);
                if(productNumber <= 0){
                    showNotification('Số lượng sản phẩm áp dụng phải lớn hơn 0', 0);
                    $('input#productNumber').focus();
                    validate = false;
                }
            }
            var beginDate = $('input#beginDate').val().trim();
            var endDate = $('input#endDate').val().trim();
            if(!($('input#cbEndDate').parent('div').hasClass('checked'))){
                if(endDate == '') {
                    showNotification('Hết hạn khuyến mãi không được bỏ trống', 0);
                    $('input#endDate').focus();
                    validate = false;
                }
                else if(!checkDate(beginDate, endDate)){
                    showNotification('Ngày hết hạn không hợp lệ', 0);
                    $('input#endDate').focus();
                    validate = false;
                }
            }
            var reduceTypeId = replaceCost($('select#reduceTypeId').val().trim(), true);
            var reduceNumber = replaceCost($('input#reduceNumber').val().trim(), true);
            if(reduceNumber <= 0){
                showNotification('Giá trị giảm phải lớn hơn 0', 0);
                $('input#reduceNumber').focus();
                validate = false;
            }
            else if(reduceTypeId == 2 && reduceNumber >= 100){
                showNotification('Giá trị giảm phải nhỏ hơn 100%', 0);
                $('input#reduceNumber').focus();
                validate = false;
            }
            var minimumCost = 0;
            var promotionItemTypeId = parseInt($('select#promotionItemTypeId').val());
            if(promotionItemTypeId == 6){
                minimumCost = replaceCost($('input#minimumCost').val().trim(), true);
                if(minimumCost <= 0){
                    showNotification('Trị giá đơn hàng phải lớn hơn 0', 0);
                    $('input#minimumCost').focus();
                    validate = false;
                }
            }
            if(validate){
                var promotionItemId = 0;
                if(promotionItemTypeId == 1 || promotionItemTypeId == 11) promotionItemId = $('select#promotionItemId').val();
                else if(promotionItemTypeId == 5) promotionItemId = $('select#customerId').val();
                else if(promotionItemTypeId == 3){ //sp
                    var productChildId = parseInt($('input#productChildId').val());
                    if(productChildId > 0){
                        promotionItemId = productChildId;
                        promotionItemTypeId = 13;//child product
                    }
                    else promotionItemId = $('input#productId').val();
                }
                $.ajax({
                    type: "POST",
                    url: $('#promotionForm').attr('action'),
                    data: {
                        PromotionId: $('input#promotionId').val(),
                        PromotionName: $('input#promotionName').val().trim(),
                        PromotionTypeId: promotionTypeId,
                        PromotionStatusId: $('input#promotionStatusId').val(),
                        ReduceTypeId: reduceTypeId,
                        BeginDate: beginDate,
                        EndDate: endDate,
                        IsSharePromotion: isSharePromotion,
                        NumberUse: numberUse,
                        ReduceNumber: reduceNumber,
                        MinimumCost: minimumCost,
                        ProvinceId: $('select#provinceId').val(),
                        PromotionItemId: promotionItemId,
                        PromotionItemTypeId: promotionItemTypeId,
                        ProductNumber: productNumber,
                        DiscountTypeId: $('select#discountTypeId').val()
                    },
                    success: function (response) {
                        var json = $.parseJSON(response);
                        showNotification(json.message, json.code);
                        if(json.code == 1) redirect(false, $('a#promotionListUrl').attr('href'));
                        $('.submit').prop('disabled', false);
                    },
                    error: function (response) {
                        showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                        $('.submit').prop('disabled', false);
                    }
                });
            }
            else $('.submit').prop('disabled', false);
        }
        return false;
    });
});

function randomPassword(length) {
    //var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
    var chars = "ABCDEFGHIJKLMNOPQRSTXYZ1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function checkDate(beginDate, endDate){
    beginDate = beginDate.split('/');
    endDate = endDate.split('/');
    if(beginDate.length == 3 && endDate.length == 3){
        if(endDate[2] > beginDate[2]) return true;
        if(endDate[2] < beginDate[2]) return false;
        if(endDate[1] > beginDate[1]) return true;
        if(endDate[1] < beginDate[1]) return false;
        if(endDate[0] > beginDate[0]) return true;
        if(endDate[0] < beginDate[0]) return false;
    }
    return false;
}