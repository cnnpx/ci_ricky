$(document).ready(function(){
    var dataProductExits = {
        index : 0,
        data : []
    };

    var canEdit = parseInt($('input#canEdit').val());
    if(canEdit == 1) {
        chooseProduct();
        province();
        $('#tbodyProductSearch').on('click', 'tr', function () {
            $('#panelProduct').removeClass('active');
            $("#panelProduct .panel-body").css("width", "99%");
            $('select#categoryId').val('0');
            var ids = $(this).attr('data-id');
            if ($(this).attr('data-child') != 0) ids += '-' + $(this).attr('data-child');
            $.ajax({
                type: "POST",
                url: $('input#getProductDetailUrl').val(),
                data: {
                    ids: ids
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1) {
                        var data = json.data;
                        var html = '';
                        if (data.TypeId == 1) {
                            if(data.ProductChild.length > 0) {
                                for (var i = 0; i < data.ProductChild.length; i++) {
                                    html += '<tr data-id="' + data.Product.ProductId + '" data-child="' + data.ProductChild[i].ProductChildId + '">';
                                    html += '<td><img src="' + data.ProductChild[i].ProductImage + '" class="productImg"></td>';
                                    html += '<td>' + data.Product.ProductName + '<br/>(' + data.ProductChild[i].ProductName + ')</td>';
                                    html += '<td><input class="form-control quantity" value="1"></td>';
                                    html += '<td class="tdPrice"><span class="spanPrice">' + formatDecimal(data.ProductChild[i].Price.toString()) + '</span></td>';
                                    html += '<td><input class="form-control sumPrice" disabled value="' + formatDecimal(data.ProductChild[i].Price.toString()) + '"></td>';
                                    html += '<td><a href="javascript:void(0)" class="link_delete"><i class="fa fa-times" title="Xóa"></i></a></td></tr>';
                                }
                            }
                            else{
                                html += '<tr data-id="' + data.Product.ProductId + '" data-child="0">';
                                html += '<td><img src="' + data.Product.ProductImage + '" class="productImg"></td>';
                                html += '<td>' + data.Product.ProductName + '</td>';
                                html += '<td><input class="form-control quantity" value="1"></td>';
                                html += '<td class="tdPrice"><span class="spanPrice">' + formatDecimal(data.Product.Price.toString()) + '</span></td>';
                                html += '<td><input class="form-control sumPrice" disabled value="' + formatDecimal(data.Product.Price.toString()) + '"></td>';
                                html += '<td><a href="javascript:void(0)" class="link_delete"><i class="fa fa-times" title="Xóa"></i></a></td></tr>';
                            }
                        }
                        else {
                            html += '<tr data-id="' + data.Product.ProductId + '" data-child="' + data.ProductChild.ProductChildId + '">';
                            html += '<td><img src="' + data.ProductChild.ProductImage + '" class="productImg"></td>';
                            html += '<td>' + data.Product.ProductName + '<br/>(' + data.ProductChild.ProductName + ')</td>';
                            html += '<td><input class="form-control quantity" value="1"></td>';
                            html += '<td class="tdPrice"><span class="spanPrice">' + formatDecimal(data.ProductChild.Price.toString()) + '</span></td>';
                            html += '<td><input class="form-control sumPrice" disabled value="' + formatDecimal(data.ProductChild.Price.toString()) + '"></td>';
                            html += '<td><a href="javascript:void(0)" class="link_delete"><i class="fa fa-times" title="Xóa"></i></a></td></tr>';
                        }
                        $('#tbodyProduct').append(html);
                        calcPrice(0);
                        keyUpInput();
                    }
                    else showNotification(json.message, json.code);
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        });
        $('#tbodyProduct').on('click', '.link_delete', function () {
            $(this).parent().parent().remove();
            var sumCost = 0;
            $('#tbodyProduct tr').each(function () {
                sumCost += replaceCost($(this).find('input.sumPrice').val(), true);
            });
            $('input#sumCost').val(formatDecimal(sumCost.toString()));
            return false;
        });
        chooseCustomer(function(li){
            var customerId = parseInt(li.attr('data-id'));
            $('input#customerId').val('0');
            //$('#aCustomer').attr('href', 'javascript:void(0)').text('');
            $('p#customerGroupName').text('');
            $('input#customerName').val('');
            $('input#customerEmail').val('');
            $('input#customerPhone').val('');
            $('input#customerAddress').val('');
            if (customerId > 0) {
                $.ajax({
                    type: "POST",
                    url: $('input#getCustomerDetailUrl').val(),
                    data: {
                        CustomerId: customerId
                    },
                    success: function (response) {
                        var json = $.parseJSON(response);
                        if (json.code == 1) {
                            $('input#customerId').val(customerId);
                            var data = json.data;
                            //$('#aCustomer').attr('href', data.CustomerLink).text(data.FullName);
                            //$('p#customerGroupName').text(data.CustomerGroupName);
                            $('input#customerName').val(data.FullName);
                            $('input#customerEmail').val(data.Email);
                            $('input#customerPhone').val(data.PhoneNumber);
                            $('input#customerAddress').val(data.Address);
                            $('select#provinceId').val(data.ProvinceId);
                            $('select#districtId').val(data.DistrictId);
                        }
                        else showNotification(json.message, json.code);
                    },
                    error: function (response) {
                        showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                    }
                });
            }
        });
    }

    $('input.iCheckRadio').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
    $('input.iCheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });

    processOrderCost(canEdit);

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
    var orderId = parseInt($('input#orderId').val());
    if(orderId > 0) {
        if($('#tbodyProduct tr').length > 0){
            keyUpInput();
            calcPrice(0);
        }
        $('input.tagName').each(function () {
            $('input#tags').addTag($(this).val());
        });
        $('#btnVerifyOrder').click(function(){
            var verifyStatusId = parseInt($('input#verifyStatusId').val());
            if(verifyStatusId == 1){
                $.ajax({
                    type: "POST",
                    url: $('input#updateVerifyOrderUrl').val(),
                    data: {
                        OrderIds: JSON.stringify([orderId]),
                        VerifyStatusId: 2
                    },
                    success: function (response) {
                        var json = $.parseJSON(response);
                        showNotification(json.message, json.code);
                        if (json.code == 1){
                            $('#divVerify1').hide();
                            $('#divVerify2').show();
                            $('input#verifyStatusId').val(2);
                            $('.submit').remove();
                        }
                    },
                    error: function (response) {
                        showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                    }
                });
            }
        });
        var transportId = parseInt($('input#transportId').val());
        if(transportId == 0) {
            $('input#transportTags').tagsInput({
                'width': '100%',
                'height': '50px',
                'interactive': true,
                'defaultText': '',
                'onAddTag': function (tag) {
                    transportTags.push(tag);
                },
                'onRemoveTag': function (tag) {
                    var index = transportTags.indexOf(tag);
                    if (index >= 0) transportTags.splice(index, 1);
                },
                'delimiter': [',', ';'],
                'removeWithBackspace': true,
                'minChars': 0,
                'maxChars': 0
            });
            $('select#transportDistrictId option').hide();
            var provinceId = $('select#transportProvinceId').val();
            if (provinceId != '0') $('select#transportDistrictId option[data-id="' + provinceId + '"]').show();
            else $('select#transportDistrictId option[value="0"]').show();
            $('select#transportProvinceId').change(function () {
                $('select#transportDistrictId option').hide();
                provinceId = $(this).val();
                if (provinceId != '0') $('select#transportDistrictId option[data-id="' + provinceId + '"]').show();
                else $('select#transportDistrictId option[value="0"]').show();
            });
            $('#modalTransport').on('keyup', 'input.cost', function () {
                var value = $(this).val();
                $(this).val(formatDecimal(value));
            });
            $('#btnTransport').click(function () {
                $('#modalTransport').modal('show');
            });
            $('#btnCheckOrder').click(function(){
                var orderId = $(this).data('orderId');
                $.ajax({
                    type : "POST",
                    async : false,
                    url : $('#urlCheckOrder').val(),
                    success : function(respone){
                        //render table prodcut extis
                        respone = JSON.parse(respone);
                        if(respone.status != undefined && respone.status == -1){
                            $('#productExits').html('Không đủ sản phẩm để cung cấp cho đơn hàng');
                        }else {
                            dataProductExits.index = 0;
                            dataProductExits.data = respone;
                            renderTableProductExits(dataProductExits);
                        }

                        $('#modelCheckOrder').modal('show');
                    },
                    error : function () {

                    }

                });
            });
            $('#btnAddTransport').click(function () {
                transportId = parseInt($('input#transportId').val());
                if(transportId == 0) {
                    $.ajax({
                        type: "POST",
                        url: $('input#updateTransportUrl').val(),
                        data: {
                            TransportId: transportId,
                            TransportCode: '',
                            OrderId: orderId,
                            CustomerId: $('input#customerId').val(),
                            TransportUserId: 0,
                            TransportStatusId: 9,
                            TransportTypeId: $('select#transportTypeId').val(),
                            TransporterId: $('select#transporterId').val(),
                            StoreId: $('select#storeId').val(),
                            Tracking: $('input#transportTracking').val().trim(),
                            Weight: $('input#transportWeight').val().trim(),
                            CODCost: replaceCost($('input#transportCODCost').val(), true),
                            Comment: $('#transportComment').val().trim(),
                            CancerReasonId: 0,
                            CancerReasonText: '',

                            CustomerName: $('input#customerName1').val().trim(),
                            Email: $('input#customerEmail1').val().trim(),
                            PhoneNumber: $('input#customerPhone1').val().trim(),
                            Address: $('input#customerAddress1').val().trim(),
                            ProvinceId: $('select#transportProvinceId').val(),
                            DistrictId: $('select#transportDistrictId').val(),

                            TagNames: JSON.stringify(transportTags)
                        },
                        success: function (response) {
                            var json = $.parseJSON(response);
                            showNotification(json.message, json.code);
                            if (json.code == 1) {
                                $('#modalTransport').modal('hide');
                                $('#divShowTransport1').hide();
                                transportId = json.data;
                                $('#aTransportLink').attr('href', $('#aTransportLink').attr('href') + '/' + transportId);
                                $('#divShowTransport2').show();
                                $('input#transportId').val(transportId);
                                $('.submit').remove();
                            }
                        },
                        error: function (response) {
                            showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                        }
                    });
                }
            });
        }
        else $('#aTransportLink').attr('href', $('#aTransportLink').attr('href') + '/' + transportId);
    }
    $('.submit').click(function(){
        if(replaceCost($('input#sumCost').val(), true) > 0){
            var customerId = parseInt($('input#customerId').val());
            if(customerId > 0){
                if(validateEmpty('#orderForm')){
                    $('.submit').prop('disabled', true);
                    var products = [];
                    $('#tbodyProduct tr').each(function(){
                        products.push({
                            ProductId: parseInt($(this).attr('data-id')),
                            ProductChildId: parseInt($(this).attr('data-child')),
                            Quantity: replaceCost($(this).find('input.quantity').val(), true),
                            Price: replaceCost($(this).find('.spanPrice').text(), true),
                            OriginalPrice: 0,
                            DiscountReason: ''
                        });
                    });
                    var orderServices = [];
                    var otherServiceId = 0;
                    var serviceCost = 0;
                    $('.trService').each(function(){
                        otherServiceId = $(this).find('select').val();
                        serviceCost = replaceCost($(this).find('input.cost').val(), true);
                        if(otherServiceId != '0' && serviceCost > 0) {
                            orderServices.push({
                                OtherServiceId: otherServiceId,
                                ServiceCost: serviceCost
                            });
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: $('#orderForm').attr('action'),
                        data: {
                            OrderId: orderId,
                            CustomerId: customerId,
                            StaffId: 0,
                            OrderChanelId: $('select#orderChanelId').val(),
                            OrderStatusId: 3,
                            Comment: $('#comment').val().trim(),
                            TransportCost: replaceCost($('input#transportCost').val().trim(), true),
                            IsLendBack: parseInt($('input#isLendBack').val()) + 1,
                            LendBackCost: replaceCost($('input#lendBackCost').val().trim(), true),
                            Discount: replaceCost($('input#discount').val().trim(), true),
                            PreCost: replaceCost($('input#preCost').val().trim(), true),
                            VATPercent: parseInt($('input#VATPercent').val()),
                            PaymentStatusId: 1,
                            VerifyStatusId: $('input#verifyStatusId').val(),
                            OrderTypeId: $('select#orderTypeId').val(),
                            DeliveryTypeId: $('input[name="DeliveryTypeId"]:checked').val(),
                            OrderReasonId: $('select#orderReasonId').val(),
                            CODCost: replaceCost($('input#CODCost').val().trim(), true),
                            CODStatusId: 1,

                            CustomerName: $('input#customerName').val().trim(),
                            Email: $('input#customerEmail').val().trim(),
                            PhoneNumber: $('input#customerPhone').val().trim(),
                            Address: $('input#customerAddress').val().trim(),
                            ProvinceId: $('select#provinceId').val(),
                            DistrictId: $('select#districtId').val(),

                            TagNames: JSON.stringify(tags),
                            Products: JSON.stringify(products),
                            OrderServices: JSON.stringify(orderServices)
                        },
                        success: function (response) {
                            var json = $.parseJSON(response);
                            showNotification(json.message, json.code);
                            if(json.code == 1 && orderId == 0) redirect(false, $('a#orderListUrl').attr('href'));
                            $('.submit').prop('disabled', false);
                        },
                        error: function (response) {
                            showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                            $('.submit').prop('disabled', false);
                        }
                    });
                }
            }
            else showNotification('Vui lòng chọn khách hàng', 0);
        }
        else showNotification('Vui lòng chọn sản phẩm', 0);
        return false;
    });


});

function keyUpInput(){
    var sumCost = 0;
    $('#tbodyProduct').on('keyup', 'input.quantity', function(){
        var value = $(this).val();
        $(this).val(formatDecimal(value));
        var tr = $(this).parent().parent();
        sumCost = replaceCost(value, true) * replaceCost(tr.find('.spanPrice').text(), true);
        tr.find('input.sumPrice').val(formatDecimal(sumCost.toString()));
        sumCost = 0;
        $('#tbodyProduct tr').each(function(){
            sumCost += replaceCost($(this).find('input.sumPrice').val(), true);
        });
        $('input#sumCost').val(formatDecimal(sumCost.toString()));
        calcPrice(sumCost);
    });
    keyUpCost();
}

function keyUpCost(){
    $('#tblCost').on('keyup', 'input.cost', function() {
        var value = $(this).val();
        $(this).val(formatDecimal(value));
        calcPrice(replaceCost($('input#sumCost').val()));
    });
    $('#tblCost').on('keyup', 'input#VATPercent', function() {
        if($(this).val() == '') $(this).val('0');
        var value = parseInt($(this).val());
        if(value == NaN || value == 'NAN' || value < 0 || value > 100) value = 0;
        $(this).val(value);
        //var sumCost = replaceCost($('input#sumCost').val());
        //$('input#VATCost').val(Math.ceil(sumCost * value / 100));
        calcPrice(replaceCost($('input#sumCost').val()));

    });
}

function calcPrice(sumCost){
    if(sumCost == 0) {
        $('#tbodyProduct tr').each(function () {
            sumCost += replaceCost($(this).find('input.sumPrice').val(), true);
        });
        $('input#sumCost').val(formatDecimal(sumCost.toString()));
    }
    //var VATCost = Math.ceil(sumCost * parseInt($('input#VATPercent').val()) / 100);
    //$('input#VATCost').val(formatDecimal(VATCost.toString()));
    var serviceCost = 0;
    $('.trService').each(function(){
        serviceCost += replaceCost($(this).find('input.cost').val(), true);
    });
    var expandCost = serviceCost + replaceCost($('input#transportCost').val(), true) - replaceCost($('input#discount').val(), true) - replaceCost($('input#preCost').val(), true);
    var collectCost = sumCost + expandCost;
    var VATCost = Math.ceil(collectCost * parseInt($('input#VATPercent').val()) / 100);
    $('input#VATCost').val(formatDecimal(VATCost.toString()));
    if($('input#isLendBack').val() == '1'){
        //var collectCost = sumCost + expandCost;
        $('input#collectCost').val(formatDecimal(collectCost.toString()));
    }
    var CODCost = sumCost + VATCost + expandCost - replaceCost($('input#lendBackCost').val(), true);
    $('input#CODCost').val(formatDecimal(CODCost.toString()));
}

function processOrderCost(canEdit){
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
    if(canEdit == 1) {
        $('.link_add_service').click(function () {
            if ($('.trService').length < $('select#otherServiceId_1 option').length - 1) {
                var html = '<tr class="trCost trService"><td class="first">Dịch vụ khác <i class="fa fa-minus link_delete_service"></i></td>';
                html += '<td><select class="form-control">' + $('select#otherServiceId_1').html() + '</select></td><td><input type="text" value="0" class="form-control cost"></td></tr>';
                $('#trLendBack').before(html);
                keyUpCost();
            }
        });
        $('#tblCost').on('click', '.link_delete_service', function () {
            $(this).parent().parent().remove();
            calcPrice(replaceCost($('input#sumCost').val()));
        });
        $('input#cbLendBack').on('ifToggled', function(e){
            if(e.currentTarget.checked){
                $('input#lendBackCost').prop('disabled', false);
                $('input#isLendBack').val('1');
            }
            else{
                $('input#collectCost').val(0);
                $('input#lendBackCost').val(0).prop('disabled', true);
                $('input#isLendBack').val('0');
            }
            calcPrice(replaceCost($('input#sumCost').val()));
        });
    }
    else{
        $('#tbodyProduct input, #tblCost input, #tblCost select').prop('disabled', true);
        $('input#cbLendBack').iCheck('disable');
        $('.submit').remove();
    }
}

function renderTableProductExits(dataProductExits){
    var data = null;
    var paginate =
        '<tr style="background: white">'+
            '<td colspan="2">'+
                '<ul class="pull-right controls" style="list-style-type: none;margin: 0px !important;padding: 0px!important;">'+
                    '<li class="prev" style="display: inline-block;"><a {disable_prev} style="{style_disable_prev}margin: 5px;padding: 5px;border: 1px solid #EEEEEE"  href="javascript:;"> Prev </a></li>'+
                    '<li class="next" style="display: inline-block;"><a {disable_next} style="{style_disable_next}padding: 5px;border: 1px solid #EEEEEE" href="javascript:;"> Next </a></li>'+
                '</ul>'+
            '</td>'+
        '</tr>';;
    if(dataProductExits.data.length > 0 ) {
        data = dataProductExits.data[dataProductExits.index];
        if(dataProductExits.index == 0){
            paginate = paginate.replace('{disable_prev}','disabled').replace('{style_disable_prev}','cursor:not-allowed;background :#eeeeee;');
            paginate = paginate.replace('{disable_next}','').replace('{style_disable_next}','');
        }else if(dataProductExits.index == dataProductExits.data.length-1) {
            paginate = paginate.replace('{disable_next}','disabled').replace('{style_disable_next}','cursor:not-allowed;background :#eeeeee;');
            paginate = paginate.replace('{disable_prev}','').replace('{style_disable_prev}','');
        }else {
            paginate = paginate.replace('{disable_next}','').replace('{style_disable_next}','');
            paginate = paginate.replace('{disable_prev}','').replace('{style_disable_prev}','');
        }
    }
    else {
        data = dataProductExits.data;
        paginate = '';
    }
    $('#productExits').find('.title').text(data.StoreData.StoreName +", "+ data.StoreData.DistrictName + ", " + data.StoreData.ProvinceName + " ("+formatNumber(data.DataProduct.distance.toString())+"m)");
    var html  = "";
    $('#productExitsTbody').html('');
    for(var key in data.DataProduct) {
        if(!isNaN(key)) {
            var product = data.DataProduct[key];
            var tr = '<tr>' +
                '<td>' + product.ProductName + " " + (product.ProductNameChild == null ? '' : product.ProductNameChild) + '</td>' +
                '<td>' + product.product_quantity + '</td>' +
                '</tr>';
            html += tr;
        }
    }
    html += paginate;
    $('#productExitsTbody').html(html);
    $('#productExitsTbody').find('.controls .prev a').click(function(){
        if(!$(this).is('[disabled]')) {
            dataProductExits.index = dataProductExits.index - 1 <= 0 ? 0 : dataProductExits.index - 1;
            renderTableProductExits(dataProductExits);
        }
    });

    $('#productExitsTbody').find('.controls .next a').click(function(){
        if(!$(this).is('[disabled]')) {
            dataProductExits.index = dataProductExits.index + 1 >= dataProductExits.data.length ? dataProductExits.data.length-1 :dataProductExits.index + 1;
            renderTableProductExits(dataProductExits);
        }
    });
}