$(document).ready(function(){
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

    var tags = [];
    var transportTags = [];
    $('input#tags').tagsInput({
        'width': '100%',
        'height': '70px',
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
    var returnGoodId = parseInt($('input#returnGoodId').val());
    if(returnGoodId > 0){
        $('input.tagName').each(function () {
            $('input#tags').addTag($(this).val());
        });
    }
    $('.submit').click(function(){
        if($('#tbodyProduct tr').length > 0){
            var customerId = parseInt($('input#customerId').val());
            if(customerId > 0){
                if(validateEmpty('#orderForm')){
                    $('.submit').prop('disabled', true);
                    var products = [];
                    $('#tbodyProduct tr').each(function(){
                        products.push({
                            ProductId: parseInt($(this).attr('data-id')),
                            ProductChildId: parseInt($(this).attr('data-child')),
                            Quantity: replaceCost($(this).find('input.quantity').val(), true)
                        });
                    });
                    var storeId = parseInt($('select#storeId').val());
                    if(storeId == 0){
                        showNotification('Vui lòng chọn Cơ sở nhập hàng', 0);
                        $('select#storeId').focus();
                        return false;
                    }
                    $.ajax({
                        type: "POST",
                        url: $('#returnGoodForm').attr('action'),
                        data: {
                            ReturnGoodId: returnGoodId,
                            CustomerId: customerId,
                            TransportStatusId: $('#transportStatusId').val(),
                            ReturnGoodTypeId: $('input[name="ReturnGoodTypeId"]:checked').val(),
                            StoreId: storeId,
                            Comment: $('#comment').val().trim(),

                            CustomerName: $('input#customerName').val().trim(),
                            Email: $('input#customerEmail').val().trim(),
                            PhoneNumber: $('input#customerPhone').val().trim(),
                            Address: $('input#customerAddress').val().trim(),
                            ProvinceId: $('select#provinceId').val(),
                            DistrictId: $('select#districtId').val(),

                            TagNames: JSON.stringify(tags),
                            Products: JSON.stringify(products)
                        },
                        success: function (response) {
                            var json = $.parseJSON(response);
                            showNotification(json.message, json.code);
                            if(json.code == 1 && returnGoodId == 0) redirect(false, $('a#returnGoodListUrl').attr('href'));
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