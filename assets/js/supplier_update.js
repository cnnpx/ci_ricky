$(document).ready(function(){
    $('input.stype, input.hasBill').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
    $('#add_contact').click(function(){
        $('#tbodyContact').append('<tr><td><input type="text" class="form-control positionName" value=""></td><td><input type="text" class="form-control contactName" value=""></td><td><input type="text" class="form-control contactPhone" value=""></td><td><a href="javascript:void(0)" class="link_delete" title="Xóa"><i class="fa fa-times"></i></a></td></tr>');
        return false;
    });
    $('#tbodyContact').on('click', '.link_delete', function(){
        $(this).parent().parent().remove();
    });
    var stype = $('input.stype:checked').val();
    if (stype == 2 ) {
        $('#forCompany').attr('style', 'display:none;');
    }

    $('input.stype').on('ifChecked', function(e){
        $('#forCompany').toggle();
        $('input#sType').val($(this).val());
    });
    $('input.hasBill').on('ifChecked', function(e){
        $('input#hasBill').val($(this).val());
    });
    $('input#submit').click(function(){
        if(validateEmpty('#supplierForm')){
            var contacts = [];
            var positionName = '';
            var contactName = '';
            var contactPhone = '';
            var flag = true;
            $('#tbodyContact tr').each(function(){
                positionName = $(this).find('input.positionName').val().trim();
                contactName = $(this).find('input.contactName').val().trim();
                contactPhone = $(this).find('input.contactPhone').val().trim();
                if(contactName != '' && contactPhone != '' && positionName != ''){
                    contacts.push({
                        PositionName: positionName,
                        ContactName: contactName,
                        ContactPhone: contactPhone
                    });
                }
                else{
                    flag = false;
                    return false;
                }
            });
            if(flag){
                var sType = $('input#sType').val();
                var taxCode = '';
                var hasBill = '';
                if (sType == 1) {
                    taxCode = $('input#taxCode').val().trim(),
                    hasBill = $('input#hasBill').val()
                }
                $.ajax({
                    type: "POST",
                    url: $('#supplierForm').attr('action'),
                    data: {
                        SupplierId: $('input#supplierId').val(),
                        SupplierCode: $('input#supplierCode').val().trim(),
                        SupplierName: $('input#supplierName').val().trim(),
                        SupplierTypeId: sType,
                        ItemStatusId: $('select#itemStatusId').val(),
                        TaxCode: taxCode,
                        HasBill: hasBill,
                        Comment: $('input#comment').val().trim(),
                        Contacts: JSON.stringify(contacts)
                    },
                    success: function (response) {
                        var json = $.parseJSON(response);
                        showNotification(json.message, json.code);
                        if(json.code == 1 && $('input#supplierId').val() == '0') redirect(false, $('input#supplierEditUrl').val() + '/' + json.data);
                    },
                    error: function (response) {
                        showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                    }
                });
            }
            else showNotification('Điền đầy đủ Chức vụ, Tên và SĐT người liên hệ', 0);
        }
        return false;
    });
});
