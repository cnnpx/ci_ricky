$(document).ready(function () {
    chooseProduct();
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
                                html += '<td><span class="spanPrice">' + data.ProductChild[i].BarCode + '</span></td>';
                                html += '<td><input class="form-control quantity" value="1"></td>';
                                html += '<td><a href="javascript:void(0)" class="link_delete"><i class="fa fa-times" title="Xóa"></i></a></td></tr>';
                            }
                        }
                        else{
                            html += '<tr data-id="' + data.Product.ProductId + '" data-child="0">';
                            html += '<td><img src="' + data.Product.ProductImage + '" class="productImg"></td>';
                            html += '<td>' + data.Product.ProductName + '</td>';
                            html += '<td><span class="spanPrice">' + data.Product.BarCode + '</span></td>';
                            html += '<td><input class="form-control quantity" value="1"></td>';
                            html += '<td><a href="javascript:void(0)" class="link_delete"><i class="fa fa-times" title="Xóa"></i></a></td></tr>';
                        }
                    }
                    else {
                        html += '<tr data-id="' + data.Product.ProductId + '" data-child="' + data.ProductChild.ProductChildId + '">';
                        html += '<td><img src="' + data.ProductChild.ProductImage + '" class="productImg"></td>';
                        html += '<td>' + data.Product.ProductName + '<br/>(' + data.ProductChild.ProductName + ')</td>';
                        html += '<td><span class="spanPrice">' + data.ProductChild.BarCode + '</span></td>';
                        html += '<td><input class="form-control quantity" value="1"></td>';
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

    $('input.iCheckRadio').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
    $('#tbodyProduct').on('click', '.link_delete', function () {
        $(this).parent().parent().remove();
        return false;
    });
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
    var importId = parseInt($('input#importId').val());
    if(importId > 0) {
        $('input.tagName').each(function () {
            $('input#tags').addTag($(this).val());
        });
    }

    $('.submit').click(function () {
        var statusId = 1;
        if (importId > 0) statusId = $('select#statusId').val();
        if ($('select#supplierId').val() == 0) {
            showNotification('Vui lòng chọn Nhà cung cấp', 0);
            $('select#supplierId').focus();
            return false;
        }
        if ($('select#storeId').val() == 0) {
            showNotification('Vui lòng chọn Cơ sở nhập', 0);
            $('select#storeId').focus();
            return false;
        }
        var products = [];
        $('#tbodyProduct tr').each(function () {
            products.push({
                ProductId: parseInt($(this).attr('data-id')),
                ProductChildId: parseInt($(this).attr('data-child')),
                Quantity: replaceCost($(this).find('input.quantity').val(), true)
            });
        });
        if (products.length > 0) {
            if (validateEmpty('#importForm')) {
                $.ajax({
                    type: "POST",
                    url: $('#importForm').attr('action'),
                    data: {
                        ImportId: $('input#importId').val(),
                        ImportCode: $('input#importCode').val(),
                        StatusId: statusId,
                        SupplierId: $('select#supplierId').val(),
                        DeliverName: $('input#deliverName').val().trim(),
                        DeliverPhone: $('input#deliverPhone').val().trim(),
                        StoreId: $('select#storeId').val(),
                        Comment: $('#comment').val().trim(),
                        FileExcel: '',
                        ScanBarCodeId: 0,

                        TagNames: JSON.stringify(tags),
                        Products: JSON.stringify(products)
                    },
                    success: function (response) {
                        var json = $.parseJSON(response);
                        showNotification(json.message, json.code);
                        if (json.code == 1){
                            if(importId == 0) redirect(false, $('a#importListUrl').attr('href'));
                            else redirect(true, '');
                        }
                    },
                    error: function (response) {
                        showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                    }
                });
            }
        }
        else showNotification('Vui lòng chọn sản phẩm', 0);
        return false;
    });
});
