$(document).ready(function(){
    if($('#tbodyStoreCirculation').length > 0) {
        actionItemAndSearch({
            ItemName: 'Lưu chuyển kho',
            extendFunction: function(itemIds, actionCode){}
        });
    }
    else{
        var tags = [];
        $('input#tags').tagsInput({
            'width': '100%',
            'height': '54px',
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
        $('input.iCheckRadio').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        var storeCirculationId = parseInt($('input#storeCirculationId').val());
        if(storeCirculationId > 0) {
            if($('#tbodyProduct tr').length > 0) keyUpProduct();
            $('input.tagName').each(function () {
                $('input#tags').addTag($(this).val());
            });
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
            if($('input#canEdit').val() == '1') {
                $('input.rdStatusId').on('ifToggled', function (e) {
                    if (e.currentTarget.checked) {
                        if (e.currentTarget.value == '3') {
                            $('input#handleDate').val('');
                            $('#divHandleDate').hide();
                            $('#divCancelReason').show();
                        }
                        else if (e.currentTarget.value == '4') {
                            $('input#cancelReason').val('');
                            $('#divCancelReason').hide();
                            $('#divHandleDate').show();
                        }
                    }
                });
            }
            else{
                $('#tbodyProduct input.quantity').prop('disabled', true);
                $('input.iCheckRadio').iCheck('disable');
            }
        }
        chooseProduct();
        $('#tbodyProductSearch').on('click', 'tr', function(){
            $('#panelProduct').removeClass('active');
            $("#panelProduct .panel-body").css("width", "99%");
            $('select#categoryId').val('0');
            var ids = $(this).attr('data-id');
            if($(this).attr('data-child') != 0) ids += '-' + $(this).attr('data-child');
            $.ajax({
                type: "POST",
                url: $('input#getProductDetailUrl').val(),
                data: {
                    ids: ids
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.code == 1){
                        var data = json.data;
                        var html = '';
                        if(data.TypeId == 1){
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
                        else{
                            html += '<tr data-id="' + data.Product.ProductId + '" data-child="' + data.ProductChild.ProductChildId + '">';
                            html += '<td><img src="' + data.ProductChild.ProductImage + '" class="productImg"></td>';
                            html += '<td>' + data.Product.ProductName + '<br/>(' + data.ProductChild.ProductName + ')</td>';
                            html += '<td><input class="form-control quantity" value="1"></td>';
                            html += '<td class="tdPrice"><span class="spanPrice">' + formatDecimal(data.ProductChild.Price.toString()) + '</span></td>';
                            html += '<td><input class="form-control sumPrice" disabled value="' + formatDecimal(data.ProductChild.Price.toString()) + '"></td>';
                            html += '<td><a href="javascript:void(0)" class="link_delete"><i class="fa fa-times" title="Xóa"></i></a></td></tr>';
                        }
                        $('#tbodyProduct').append(html);
                        keyUpProduct();
                    }
                    else showNotification(json.message, json.code);
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        });
        $('#tbodyProduct').on('click', '.link_delete', function(){
            $(this).parent().parent().remove();
            return false;
        });
        $('.submit').click(function(){
            var products = [];
            $('#tbodyProduct tr').each(function(){
                products.push({
                    ProductId: parseInt($(this).attr('data-id')),
                    ProductChildId: parseInt($(this).attr('data-child')),
                    Quantity: replaceCost($(this).find('input.quantity').val(), true)
                });
            });
            if(products.length > 0){
                var storeSourceId = parseInt($('select#storeSourceId').val());
                var storeDestinationId = parseInt($('select#storeDestinationId').val());
                if(storeSourceId == 0){
                    showNotification('Vui lòng chọn Cơ sở xuất hàng', 0);
                    $('select#storeSourceId').focus();
                    return false;
                }
                if(storeDestinationId == 0){
                    showNotification('Vui lòng chọn Cơ sở nhập hàng', 0);
                    $('select#storeDestinationId').focus();
                    return false;
                }
                if(storeSourceId == storeDestinationId){
                    showNotification('Cơ sở nhập hàng phải khác Cơ sở xuất hàng', 0);
                    return false;
                }
                var orderStatusId = 0;
                var statusId = 0;
                if($('input#orderStatusId').length > 0) orderStatusId = $('input#orderStatusId').val();
                else orderStatusId = $('input[name="OrderStatusId"]:checked').val();
                if($('input#statusId').length > 0) statusId = $('input#statusId').val();
                else statusId = $('input[name="StatusId"]:checked').val();
                var cancelReason = $('input#cancelReason').val().trim();
                var handleDate = $('input#handleDate').val().trim();
                if(statusId == '3' && handleDate == ''){
                    showNotification('Ngày xử lý lại không được bỏ trống');
                    $('input#handleDate').focus();
                    return false;
                }
                else if(statusId == '4' && cancelReason == ''){
                    showNotification('Lý do hủy bỏ không được bỏ trống');
                    $('input#cancelReason').focus();
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: $('#storeCirculationForm').attr('action'),
                    data: {
                        StoreCirculationId: storeCirculationId,
                        StoreCirculationCode: $('input#storeCirculationCode').val(),
                        StoreSourceId: storeSourceId,
                        StoreDestinationId: storeDestinationId,
                        OrderStatusId: orderStatusId,
                        StatusId: statusId,
                        DeliveryTypeId: $('input[name="DeliveryTypeId"]:checked').val(),
                        Comment: $('#comment').val().trim(),
                        CancerReason: cancelReason,
                        HandleDate: handleDate,

                        TagNames: JSON.stringify(tags),
                        Products: JSON.stringify(products)
                    },
                    success: function (response) {
                        var json = $.parseJSON(response);
                        showNotification(json.message, json.code);
                        if(json.code == 1 && storeCirculationId == 0) redirect(false, $('a#storeCirculationListUrl').attr('href'));
                    },
                    error: function (response) {
                        showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                    }
                });
            }
            else showNotification('Vui lòng chọn sản phẩm', 0);
            return false;
        });
    }
});

function keyUpProduct(){
    $('#tbodyProduct').on('keyup', 'input.quantity', function(){
        var value = $(this).val();
        $(this).val(formatDecimal(value));
        var tr = $(this).parent().parent();
        var sumCost = replaceCost(value, true) * replaceCost(tr.find('.spanPrice').text(), true);
        tr.find('input.sumPrice').val(formatDecimal(sumCost.toString()));
    });
}