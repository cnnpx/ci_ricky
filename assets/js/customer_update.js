$(document).ready(function () {
    province();
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
    $('select#customerTypeId').change(function(e){
        var customerTypeId = $(this).val();
        var style = customerTypeId == 2 ? 'block' : 'none';
        var lable = customerTypeId == 2 ? 'Họ tên người đại diện' : 'Họ tên';
        $('#divCompany').css({ display: style });
        $('#lableName').text(lable);
    }).change();

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

    $('.submit').click(function(){
        if(validateEmpty('#customerForm')){
            $.ajax({
                type: "POST",
                url: $('#customerForm').attr('action'),
                data: {
                    CustomerId: $('input#customerId').val(),
                    FullName: $('input#fullName').val().trim(),
                    Email: $('input#email').val().trim(),
                    PhoneNumber: $('input#phoneNumber').val().trim(),
                    GenderId: $('select#genderId').val(),
                    StatusId: $('input#statusId').val(),
                    BirthDay: $('input#birthDay').val(),
                    CustomerTypeId: $('select#customerTypeId').val(),
                    ProvinceId: $('select#provinceId').val(),
                    DistrictId: $('select#districtId').val(),
                    Address: $('input#address').val().trim(),
                    CustomerGroupId: $('select#customerGroupId').val(),
                    FaceBook: $('input#facebook').val().trim(),
                    Commnet: $('input#comment').val().trim(),
                    CareStaffId: $('select#careStaffId').val(),
                    DiscountTypeId: $('select#discountTypeId').val(),
                    PaymentTimeId: $('select#paymentTimeId').val(),
                    PositionName: $('input#positionName').val().trim(),
                    CompanyName: $('input#companyName').val().trim(),
                    TaxCode: $('input#taxCode').val().trim(),
                    TagNames: JSON.stringify(tags)
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    showNotification(json.message, json.code);
                    if(json.code == 1 && $('input#customerId').val() == '0') redirect(false, $('a#customerListUrl').attr('href'));
                },
                error: function (response) {
                    showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                }
            });
        }
        return false;
    });
});