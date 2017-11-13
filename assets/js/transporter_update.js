$(document).ready(function(){
    $('input.iCheckRadio').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
    $('input.cbStore').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
    $('#add_contact').click(function(){
        $('#tbodyContact').append('<tr><td><input type="text" class="form-control contactName" value=""></td><td><input type="text" class="form-control contactPhone" value=""></td><td><a href="javascript:void(0)" class="link_delete" title="Xóa"><i class="fa fa-times"></i></a></td></tr>');
        return false;
    });
    $('#tbodyContact').on('click', '.link_delete', function(){
        $(this).parent().parent().remove();
    });
    $('.submit').click(function(){
        if(validateEmpty('#transporterForm')){
            var storeIds = [];
            $('input.cbStore').each(function(){
                if($(this).parent('.icheckbox_square-blue').hasClass('checked')) storeIds.push($(this).val());
            });
            if(storeIds.length > 0){
                var contacts = [];
                var contactName = '';
                var contactPhone = '';
                var flag = true;
                $('#tbodyContact tr').each(function(){
                    contactName = $(this).find('input.contactName').val().trim();
                    contactPhone = $(this).find('input.contactPhone').val().trim();
                    if(contactName != '' && contactPhone != ''){
                        contacts.push({
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
                    $.ajax({
                        type: "POST",
                        url: $('#transporterForm').attr('action'),
                        data: {
                            TransporterId: $('input#transporterId').val(),
                            TransporterCode: $('input#transporterCode').val().trim(),
                            TransporterName: $('input#transporterName').val().trim(),
                            HasCOD: $('input[name="HasCOD"]:checked').val(),
                            ItemStatusId: $('select#itemStatusId').val(),
                            Comment: $('input#comment').val().trim(),
                            StoreIds: JSON.stringify(storeIds),
                            Contacts: JSON.stringify(contacts)
                        },
                        success: function (response) {
                            var json = $.parseJSON(response);
                            showNotification(json.message, json.code);
                            if(json.code == 1 && $('input#transporterId').val() == '0') redirect(false, $('a#transporterListUrl').attr('href'));
                        },
                        error: function (response) {
                            showNotification('Có lỗi xảy ra trong quá trình thực hiện', 0);
                        }
                    });
                }
                else showNotification('Điền đầy đủ Tên và SĐT người liên hệ', 0);
            }
            else showNotification('Vui lòng chọn Cơ sở', 0);
        }
        return false;
    });
});
