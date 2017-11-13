function chooseProduct(){
    $('#txtSearchProduct').click(function(){
        if($('#panelProduct').hasClass('active')){
            $('#panelProduct').removeClass('active');
            $("#panelProduct .panel-body").css("width", "99%");
        }
        else{
            $('#panelProduct').addClass('active');
            setTimeout(function (){
                $("#panelProduct .panel-body").css("width", "100%");
            }, 100);
            $('input#pageIdProduct').val('1');
            getListProducts();
        }
    });
    $('select#categoryId').change(function(){
        $('input#pageIdProduct').val('1');
        getListProducts();
    });
    $(document).on('keyup', '#txtSearchProduct', function(){
        $('input#pageIdProduct').val('1');
        getListProducts();
    });
    $('#btnPrevProduct').click(function(){
        var pageIdProduct = parseInt($('input#pageIdProduct').val());
        if(pageIdProduct > 1){
            $('input#pageIdProduct').val(pageIdProduct - 1);
            getListProducts();
        }
    });
    $('#btnNextProduct').click(function(){
        var pageIdProduct = parseInt($('input#pageIdProduct').val());
        $('input#pageIdProduct').val(pageIdProduct + 1);
        getListProducts();
    });
}

function getListProducts(){
    var loading = $('#panelProduct .search-loading');
    loading.show();
    $('#tbodyProductSearch').html('');
    $.ajax({
        type: "POST",
        url: $('input#getListProductUrl').val(),
        data: {
            SearchText: $('input#txtSearchProduct').val().trim(),
            CategoryId: $('select#categoryId').val(),
            PageId: parseInt($('input#pageIdProduct').val()),
            Limit: 10
        },
        success: function (response) {
            var json = $.parseJSON(response);
            if (json.code == 1){
                loading.hide();
                var data = json.data;
                var html = '';
                var i, j;
                for(i = 0; i < data.length; i++){
                    html += '<tr class="pProduct" data-id="' + data[i].ProductId + '" data-child="0">';
                    html += '<td><img src="' + data[i].ProductImage + '" class="productImg"></td>';
                    html += '<td>' + data[i].ProductName + '</td>';
                    html += '<td>' + data[i].BarCode + '</td>';
                    html += '<td>' + formatDecimal(data[i].Price.toString()) + '</td>';
                    html += '<td>' + data[i].GuaranteeMonth + ' tháng</td></tr>';
                    if(data[i].Childs.length > 0){
                        for(j = 0; j < data[i].Childs.length; j++){
                            html += '<tr class="cProduct" data-id="' + data[i].ProductId + '" data-child="' + data[i].Childs[j].ProductChildId + '">';
                            html += '<td><img src="' + data[i].Childs[j].ProductImage + '" class="productImg"></td>';
                            html += '<td>' + data[i].ProductName + ' (' + data[i].Childs[j].ProductName + ')</td>';
                            html += '<td>' + data[i].Childs[j].BarCode + '</td>';
                            html += '<td>' + formatDecimal(data[i].Childs[j].Price.toString()) + '</td>';
                            html += '<td>' + data[i].GuaranteeMonth + ' tháng</td></tr>';
                        }
                    }
                }
                $('#tbodyProductSearch').html(html);
            }
            else loading.text('Có lỗi xảy ra').show();
        },
        error: function (response) {
            //showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
            loading.text('Có lỗi xảy ra').show();
        }
    });
}

function chooseCustomer(fn){
    $('#txtSearchCustomer').click(function () {
        if ($('#panelCustomer').hasClass('active')) {
            $('#panelCustomer').removeClass('active');
            $("#panelCustomer .panel-body").css("width", "99%");
        }
        else {
            $('#panelCustomer').addClass('active');
            setTimeout(function () {
                $("#panelCustomer .panel-body").css("width", "100%");
            }, 100);
            $('input#pageIdCustomer').val('1');
            getListCustomers();
        }
    });
    $(document).on('keyup', '#txtSearchCustomer', function () {
        $('input#pageIdCustomer').val('1');
        getListCustomers();
    });
    $('#btnPrevCustomer').click(function () {
        var pageIdCustomer = parseInt($('input#pageIdCustomer').val());
        if (pageIdCustomer > 1) {
            $('input#pageIdCustomer').val(pageIdCustomer - 1);
            getListCustomers();
        }
    });
    $('#btnNextCustomer').click(function () {
        var pageIdCustomer = parseInt($('input#pageIdCustomer').val());
        $('input#pageIdCustomer').val(pageIdCustomer + 1);
        getListCustomers();
    });
    $('#ulListCustomers').on('click', 'li.row', function () {
        $('#panelCustomer').removeClass('active');
        $("#panelCustomer .panel-body").css("width", "99%");
        fn($(this));
    });
}

function getListCustomers(){
    $('#panelCustomer .search-loading').show();
    $('#ulListCustomers').html('');
    $.ajax({
        type: "POST",
        url: $('input#getListCustomerUrl').val(),
        data: {
            SearchText: $('input#txtSearchCustomer').val().trim(),
            PageId: parseInt($('input#pageIdCustomer').val()),
            Limit: 10
        },
        success: function (response) {
            var json = $.parseJSON(response);
            if (json.code == 1){
                $('#panelCustomer .search-loading').hide();
                var data = json.data;
                var html = '';
                for(var i = 0; i < data.length; i++){
                    html += '<li class="row" data-id="' + data[i].CustomerId + '"><div class="wrap-img inline_block vertical-align-t radius-cycle"><img class="thumb-image radius-cycle" src="assets/vendor/dist/img/users.png" title="" /></div><div class="inline_block ml10">';
                    html += '<p class="pCustomerName">' + data[i].FullName + '</p><p>' + data[i].Email + '</p></div></li>';
                }
                $('#ulListCustomers').html(html);
            }
            else $('#panelCustomer .search-loading').text('Có lỗi xảy ra').show();
        },
        error: function (response) {
            showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
        }
    });
}