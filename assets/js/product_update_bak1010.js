$(document).ready(function () {
    CKEDITOR.replace('ProductDesc', {
        language: 'vi',
        height: 350
    });
    $('input.iCheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
    $('input.iCheckRadio').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
    $('input.timepicker').timepicker({
        showInputs: false
    });
    $('#productForm').on('focusout', 'input#productName', function(){
        $('input#titleSEO').val($(this).val());
        $('input#productSlug').val(makeSlug($(this).val()));
    });
    $('input#cbWebsite1').on('ifToggled', function(e){
        if(e.currentTarget.checked){
            $('#divWebsite2').hide();
            $('input#cbWebsite2').iCheck('uncheck');
            $('input#productDisplayTypeId').val('1');
        }
        else{
            $('#divWebsite2').show();
            $('input#productDisplayTypeId').val('3');
        }
    });
    $('input#cbWebsite2').on('ifToggled', function(e){
        if(e.currentTarget.checked) $('input#productDisplayTypeId').val('2');
        else $('input#productDisplayTypeId').val('3');
    });
    $('input#cbIsManageExtraWarehouse').on('ifToggled', function(e){
        if(e.currentTarget.checked) $('#divIsManageExtraWarehouse').show();
        else{
            $('input#formalStatus').val('');
            $('input#usageStatus').val('');
            $('input#accessoryStatus').val('');
            $('#divIsManageExtraWarehouse').hide();
        }
    });
    var productDisplayTypeId = parseInt($('input#productDisplayTypeId').val());
    if(productDisplayTypeId == 2){
        $('input#cbWebsite1').iCheck('uncheck');
        $('input#cbWebsite2').iCheck('check');
        $('#divWebsite2').show();
    }
    else if(productDisplayTypeId == 3){
        $('input#cbWebsite1').iCheck('uncheck');
        $('input#cbWebsite2').iCheck('uncheck');
    }
    $('#productForm').on('keyup', 'input.cost', function(){
        var value = $(this).val();
        $(this).val(formatDecimal(value));
    });
    $('#productForm').on('keyup', 'input#titleSEO', function(){
        $('span#count1').text($(this).val().trim().length);
    });
    $('#productForm').on('keyup', '#metaDesc', function(){
        $('span#count2').text($(this).val().trim().length);
    });
    $('#btnSEO').click(function(){
        $('#divSEO').toggle();
    });
    $('#btnDate').click(function(){
        $('#divDateTime').toggle();
    });
    $('#btnUpImage1').click(function(){
        var finder = new CKFinder();
        finder.resourceType = 'Images';
        finder.selectActionFunction = function(fileUrl) {
            $('#ulImages').append('<li><a href="' + fileUrl + '" target="_blank"><img src="' + fileUrl + '"></a><i class="fa fa-times"></i></li>');
        };
        finder.popup();
    });
    $('#btnUpImage2').click(function(){
        var finder = new CKFinder();
        finder.resourceType = 'Images';
        finder.selectActionFunction = function(fileUrl) {
            $('img#productImage').attr('src', fileUrl).show();
        };
        finder.popup();
    });
    var tags = [];
    //https://github.com/xoxco/jQuery-Tags-Input
    $('input#tags').tagsInput({
        'width': '100%',
        'interactive': true,
        'defaultText': '',
        'onAddTag': function(tag){
            tags.push(tag);
        },
        'onRemoveTag': function(tag){
            var index = tags.indexOf(tag);
            if(index >= 0) tags.splice(index, 1);
        },
        /*'onChange': function(tag){
            console.log('change ' + JSON.stringify(tag));
        },*/
        'delimiter': [',', ';'],
        'removeWithBackspace': true,
        'minChars': 0,
        'maxChars': 0
    });
    $('input.tagName').each(function(){
        $('input#tags').addTag($(this).val());
    });
    $('#ulTagExist').on('click', 'a', function(){
        var tag = $(this).text();
        if(!$('input#tags').tagExist(tag)) $('input#tags').addTag(tag);
    });
    //product Config=================================================
    $('#btnConfig').click(function(){
        if($('input#productKindId').val() == '1'){
            $(this).html('<i class="fa fa-minus"></i> Hủy');
            $('#divProductConfig').show();
            $('input#productKindId').val('2');
        }
        else{
            $(this).html('<i class="fa fa-plus"></i> Thêm phiên bản');
            $('#divProductConfig').hide();
            $('input#productKindId').val('1');

        }
    });
    var variantValues = [];
    variantValues[1] = [];
    $('input#variantValue_1').tagsInput({
        'width': '100%',
        'height': '50px',
        'interactive': true,
        'defaultText': '',
        'onAddTag': function (tag) {
            variantValues[1].push(tag);
        },
        'onRemoveTag': function (tag) {
            var index = variantValues[1].indexOf(tag);
            if(index >= 0) variantValues[1].splice(index, 1);
        },
        'delimiter': [',', ';'],
        'removeWithBackspace': true,
        'minChars': 0,
        'maxChars': 0
    });
    if($('input#variantValues_1').length > 0){
        var variantValueStrs = $('input#variantValues_1').val().split(',');
        for(var i = 0; i < variantValueStrs.length; i++) $('input#variantValue_1').addTag(variantValueStrs[i]);
    }
    if($('input#variantValue_2').length > 0){
        variantValues[2] = [];
        $('input#variantValue_2').tagsInput({
            'width': '100%',
            'height': '50px',
            'interactive': true,
            'defaultText': '',
            'onAddTag': function (tag) {
                variantValues[2].push(tag);
            },
            'onRemoveTag': function (tag) {
                var index = variantValues[2].indexOf(tag);
                if(index >= 0) variantValues[2].splice(index, 1);
            },
            'delimiter': [',', ';'],
            'removeWithBackspace': true,
            'minChars': 0,
            'maxChars': 0
        });
        if($('input#variantValues_2').length > 0){
            var variantValueStrs = $('input#variantValues_2').val().split(',');
            for(var i = 0; i < variantValueStrs.length; i++) $('input#variantValue_2').addTag(variantValueStrs[i]);
        }
    }
    if($('input#variantValue_3').length > 0){
        variantValues[3] = [];
        $('input#variantValue_3').tagsInput({
            'width': '100%',
            'height': '50px',
            'interactive': true,
            'defaultText': '',
            'onAddTag': function (tag) {
                variantValues[3].push(tag);
            },
            'onRemoveTag': function (tag) {
                var index = variantValues[3].indexOf(tag);
                if(index >= 0) variantValues[3].splice(index, 1);
            },
            'delimiter': [',', ';'],
            'removeWithBackspace': true,
            'minChars': 0,
            'maxChars': 0
        });
        if($('input#variantValues_3').length > 0){
            var variantValueStrs = $('input#variantValues_3').val().split(',');
            for(var i = 0; i < variantValueStrs.length; i++) $('input#variantValue_3').addTag(variantValueStrs[i]);
        }
    }

    var variants = [];
    $('input.variant').each(function(){
        variants.push({
            VariantId: parseInt($(this).attr('data-id')),
            VariantName: $(this).val()
        });
    });

    $('#btnAddVariant').click(function(){
        var variantIds = [];
        $('#tbodyVariant select.variantId').each(function(){
            variantIds.push(parseInt($(this).val()));
        });
        if(variantIds.length < variants.length){
            var variantLefts = [];
            var flag = false;
            var i = 0;
            for(i = 0; i < variants.length; i++){
                flag = false;
                for(var j = 0; j < variantIds.length; j++){
                    if(variants[i].VariantId == variantIds[j]){
                        flag = true;
                        break;
                    }
                }
                if(!flag) variantLefts.push({
                    VariantId: variants[i].VariantId,
                    VariantName: variants[i].VariantName
                });
            }
            if(variantLefts.length > 0){
                var variantNo = parseInt($('input#variantNo').val()) + 1;
                var html = '<tr><td><select class="form-control variantId" id="variantId_' + variantNo + '">';
                for(i = 0; i< variantLefts.length; i++) html += '<option value="' + variantLefts[i].VariantId + '">' + variantLefts[i].VariantName + '</option>';
                html += '</select></td><td><input type="text" class="form-control variantValue" id="variantValue_' + variantNo + '"></td><td><a href="javascript:void(0)" class="link_delete" data-id="' + variantNo + '"><i class="fa fa-times" title="Xóa"></i></a></td></tr>';
                $('#tbodyVariant').append(html);
                variantValues[variantNo] = [];
                $('input#variantValue_' + variantNo).tagsInput({
                    'width': '100%',
                    'height': '50px',
                    'interactive': true,
                    'defaultText': '',
                    'onAddTag': function (tag) {
                        variantValues[variantNo].push(tag);
                    },
                    'onRemoveTag': function (tag) {
                        var index = variantValues[variantNo].indexOf(tag);
                        if(index >= 0) variantValues[variantNo].splice(index, 1);
                    },
                    'delimiter': [',', ';'],
                    'removeWithBackspace': true,
                    'minChars': 0,
                    'maxChars': 0
                });
                $('input#variantNo').val(variantNo);
            }
        }
    });
    $('#tbodyVariant').on('click', '.link_delete', function(){
        var variantNo = parseInt($(this).attr('data-id'));
        variantValues.splice(variantNo, 1);
        $(this).parent().parent().remove();
        return false;
    });
    $('#btnInitVariant').click(function(){
        if(variantValues.length > 0){
            var variantValues1 = [], variantValues2 = [], variantValues3 = [];
            var variantId = 0;
            var i = 0;
            var flag = true;
            for(var variantNo in variantValues){
                variantId = $('select#variantId_' + variantNo).val();
                if(variantValues[variantNo].length == 0){
                    flag = false;
                    break;
                }
                else{
                    i++;
                    if(i == 1) variantValues1[variantId] = variantValues[variantNo];
                    else if(i == 2) variantValues2[variantId] = variantValues[variantNo];
                    else if(i == 3) variantValues3[variantId] = variantValues[variantNo];
                }
            }
            if(flag){
                var variantId1, variantId2, variantId3, j, k;
                var variantOptions = [];
                for(variantId1 in variantValues1){
                    for(i = 0; i < variantValues1[variantId1].length; i++){
                        if(variantValues2.length > 0){
                            for(variantId2 in variantValues2){
                                for(j = 0; j < variantValues2[variantId2].length; j++){
                                    if(variantValues3.length > 0){
                                        for(variantId3 in variantValues3){
                                            for(k = 0; k < variantValues3[variantId3].length; k++) variantOptions.push(variantValues1[variantId1][i] + ' - ' + variantValues2[variantId2][j] + ' - ' + variantValues3[variantId3][k]);
                                        }
                                    }
                                    else variantOptions.push(variantValues1[variantId1][i] + ' - ' + variantValues2[variantId2][j]);
                                }
                            }
                        }
                        else variantOptions.push(variantValues1[variantId1][i]);
                    }
                }
                var html = '';
                var price = $('input#price').val().trim();
                var oldPrice = $('input#oldPrice').val().trim();
                var weight = $('input#weight').val().trim();
                var guaranteeMonth = $('input#guaranteeMonth').val().trim();
                var variantImg = $('img#productImage').attr('src');
                if(variantImg == '') variantImg = 'assets/uploads/images/logo.png';
                for(i = 0; i < variantOptions.length; i++){
                    html += '<tr><td><img class="variantImg" src="' + variantImg + '"/></td><td class="variantValue">' + variantOptions[i] + '</td>';
                    html += '<td><input type="text" class="form-control hmdrequired sku" value="" data-field="Sku"></td>';
                    html += '<td><input type="text" class="form-control hmdrequired barCode" value="" data-field="BarCode"></td>';
                    html += '<td><input type="text" class="form-control cost hmdrequiredNumber price" value="' + price + '" data-field="Giá bán lẻ"></td>';
                    html += '<td><input type="text" class="form-control cost hmdrequiredNumber oldPrice" value="' + oldPrice + '" data-field="Giá so sánh"></td>';
                    html += '<td><input type="text" class="form-control cost hmdrequiredNumber weight" value="' + weight + '" data-field="Khối lượng"></td>';
                    html += '<td><input type="text" class="form-control cost hmdrequiredNumber guaranteeMonth" value="' + guaranteeMonth + '" data-field="Bảo hành"></td>';
                    html += '<td><a href="javascript:void(0)" class="link_delete"><i class="fa fa-times" title="Xóa"></i></a></td>';
                    html += '</tr>';
                }
                $('#tbodyVariantValue').html(html);
                $('#tbodyVariantValue').on('keyup', 'input.cost', function(){
                    var value = $(this).val();
                    $(this).val(formatDecimal(value));
                });
                $('#tbodyVariantValue').on('click', 'img.variantImg', function(){
                    $('#modalProductImage').modal('show');
                });
            }
            else showNotification('Chưa điền giá trị thuộc tính', 0);
        }
    });
    $('#tbodyVariantValue').on('click', '.link_delete', function(){
        $(this).parent().parent().remove();
        return false;
    });
    //=================================================
    $('.submit').click(function(){
        if(validateEmpty('#productForm')){
            var cateIds1 = JSON.stringify($('select#cate1').val());
            if(cateIds1 == null || cateIds1 == 'null'){
                showNotification('Chưa chọn Nhóm sản phẩm', 0);
                $('select#cate1').focus();
                return false;
            }
            var cateIds2 = JSON.stringify($('select#cate2').val());
            if(cateIds2 == null || cateIds2 == 'null'){
                showNotification('Chưa chọn Loại sản phẩm', 0);
                $('select#cate2').focus();
                return false;
            }
            var images = [];
            $('#ulImages li a').each(function(){
                images.push($(this).attr('href'));
            });
            var variantNewValues = [];
            variantNewValues[0] = [];
            var variantOptions = [];
            var productKindId = parseInt($('input#productKindId').val());
            if(productKindId == 2) {
                var variantId = 0;
                for (var variantNo in variantValues) {
                    variantId = $('select#variantId_' + variantNo).val();
                    variantNewValues[variantId] = variantValues[variantNo];
                }
                variantOptions = getVariantValues();
                if(variantOptions.length == 0) return false;

            }
            var isContactPrice = 1;
            if($('input#cbPrice').parent('div.icheckbox_square-blue').hasClass('checked')) isContactPrice = 2;
            var isManageExtraWarehouse = 1;
            if($('input#cbIsManageExtraWarehouse').parent('div.icheckbox_square-blue').hasClass('checked')) isManageExtraWarehouse = 2;
            $.ajax({
                type: "POST",
                url: $('#productForm').attr('action'),
                data: {
                    ProductId: $('input#productId').val(),
                    ProductName: $('input#productName').val().trim(),
                    ProductSlug: $('input#productSlug').val().trim(),
                    ProductDesc: CKEDITOR.instances['ProductDesc'].getData().trim(),
                    ProductTypeId: $('select#productTypeId').val(),
                    ProductStatusId: $('input[name="ProductStatusId"]:checked').val(),
                    ProductKindId: productKindId,
                    VATStatusId: $('input[name="VATStatusId"]:checked').val(),
                    ProductDisplayTypeId: $('input#productDisplayTypeId').val(),
                    ProductLevelId: $('input[name="ProductLevelId"]:checked').val(),
                    ParentProductId: $('input#parentProductId').val(),
                    SupplierId: $('select#supplierId').val(),
                    Quantity: 0,//replaceCost($('input#quantity').val().trim(), true),
                    IsContactPrice: isContactPrice,
                    Price: replaceCost($('input#price').val().trim(), true),
                    OldPrice: replaceCost($('input#oldPrice').val().trim(), true),
                    ProductImage: $('img#productImage').attr('src'),
                    BarCode: $('input#barCode').val().trim(),
                    Sku: $('input#sku').val().trim(),
                    Weight: replaceCost($('input#weight').val().trim()),
                    PublishDateTime: getPublishDateTime(),
                    IsManageExtraWarehouse: isManageExtraWarehouse,
                    FormalStatus: $('input#formalStatus').val().trim(),
                    UsageStatus: $('input#usageStatus').val().trim(),
                    AccessoryStatus: $('input#accessoryStatus').val().trim(),
                    GuaranteeMonth: $('input#guaranteeMonth').val().trim(),

                    TitleSEO: $('input#titleSEO').val().trim(),
                    MetaDesc: $('#metaDesc').val().trim(),
                    Canonical: $('input#productSlug').val().trim(),
                    IsRobotIndex: 1,
                    IsRobotFollow: 1,
                    IsOnSitemap: 1,

                    Images: JSON.stringify(images),
                    CateIds1: cateIds1,
                    CateIds2: cateIds2,
                    TagNames: JSON.stringify(tags),

                    Variants: JSON.stringify(variantNewValues),
                    VariantOptions: JSON.stringify(variantOptions)
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1 && $('input#productId').val() == '0') redirect(false, $('a#productListUrl').attr('href'));
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
});

function getPublishDateTime(){
    var retVal = '';
    var productDates = $('input#productDate').val().trim().split('/');
    if(productDates.length == 3){
        retVal = productDates[2] + '-' + productDates[1] + '-' + productDates[0];
        var productTimes = $('input#productTime').val().trim().split(' ');
        if(productTimes.length == 2){
            var hour = 0;
            var minute = '00';
            var times = productTimes[0].split(':');
            if(times.length == 2){
                hour = parseInt(times[0]);
                minute = times[1];
            }
            if(productTimes[1] == 'PM') hour += 12;
            if(hour < 10) hour = '0' + hour;
            retVal += ' ' + hour + ':' + minute + ':00';
        }
        else retVal += ' 00:00:00';
    }
    return retVal;
}

function getVariantValues(){
    var retVal = [];
    var sku = '';
    var barCode = '';
    var quantity = 0;
    var price = 0;
    var oldPrice = 0;
    var weight = 0;
    var guaranteeMonth = 0;
    var flag = false;
    $('#tbodyVariantValue tr').each(function(){
        sku = $(this).find('input.sku').val().trim();
        barCode = $(this).find('input.barCode').val().trim();
        //quantity = replaceCost($(this).find('input.quantity').val().trim(), true);
        price = replaceCost($(this).find('input.price').val().trim(), true);
        oldPrice = replaceCost($(this).find('input.oldPrice').val().trim(), true);
        weight = replaceCost($(this).find('input.weight').val().trim(), true);
        guaranteeMonth = replaceCost($(this).find('input.guaranteeMonth').val().trim(), true);
        if(sku == ''){
            flag = true;
            showNotification('Sku sản phẩm con không được bỏ trống', 0);
            $(this).find('input.sku').focus();
            return false;
        }
        else if(barCode == ''){
            flag = true;
            showNotification('BarCode sản phẩm con không được bỏ trống', 0);
            $(this).find('input.barCode').focus();
            return false;
        }
        /*else if(price <= 0){
            flag = true;
            showNotification('Giá bán lẻ sản phẩm con không được bỏ trống', 0);
            $(this).find('input.price').focus();
            return false;
        }
        else if(weight <= 0){
            flag = true;
            showNotification('Khối lượng sản phẩm con không được bỏ trống', 0);
            $(this).find('input.weight').focus();
            return false;
        }*/
        else{
            retVal.push({
                Sku: sku,
                BarCode: barCode,
                Quantity: quantity,
                Price: price,
                OldPrice: oldPrice,
                Weight: weight,
                VariantValue: $(this).find('td.variantValue').text(),
                ProductImage: $(this).find('img.variantImg').attr('src'),
                GuaranteeMonth: guaranteeMonth
            });
        }
    });
    if(flag) retVal = [];
    else if(retVal.length == 0) showNotification('Bạn chưa tạo sản phẩm con', 0);
    return retVal;
}