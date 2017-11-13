$(document).ready(function(){
    actionItemAndSearch({
        ItemName: 'Phiếu',
        extendFunction: function(itemIds, actionCode){}
    });
});


var data_tr={
    transactionIds : []
};

function renderContentTransactions(data) {
    var html = '';
    if(data!=null) {
        var cssType = ['label label-success', 'label label-default', 'label label-warning'];
        var cssStatus = ['label label-default', 'label label-success'];
        for (var item = 0; item < data.length; item++) {
            var urlEditCustomer = $('#urlEditCustomer').val() + '/' + data[item].CustomerId;
            var urlEditOrder = $('#urlEditOrder').val() + '/' + data[item].OrderId;
            var urlEditTransaction = $('#urlEditTransaction').val() + '/' + data[item].TransactionId;
            var tr = '<tr>';
            tr += '<td><input class="checkTran iCheckTable iCheckItem" type="checkbox" value="' + data[item].TransactionId + '"></td>';
            tr += '<td><a href="' + urlEditTransaction + '" target="_blank">#' + data[item].TransactionId + '</a></td>';
            tr += '<td><a href="' + urlEditCustomer + '" target="_blank">' + data[item].FullName + '</a></td>';//<div style="font-weight: 600;font-size: 12px">' + data[item].Email + '</div></td>';
            tr += '<td><span class="' + cssType[parseInt(data[item].TransactionTypeId) - 1] + '">' + data[item].TransactionType + '</span></td>';
            tr += '<td><a href="' + urlEditOrder + '" target="_blank">' + (typeof data[item].OrderCode != "undefined" && data[item].OrderCode != null ? data[item].OrderCode : "") + '</a></td>';
            tr += '<td>' + data[item].MoneySourceName + '</td>';
            tr += '<td>' + formatNumber(data[item].PaidCost) + '</td>';
            tr += '<td>' + (typeof data[item].StoreName != "undefined" && data[item].StoreName != null ? data[item].StoreName : "") + '</td>';
            tr += '<td>' + (typeof data[item].MoneyPhoneName != "undefined" && data[item].MoneyPhoneName != null ? data[item].MoneyPhoneName : "") + '</td>';
            tr += '<td><span class="' + cssStatus[data[item]['TransactionStatusId'] - 1] + '">' + data[item].TransactionStatus + '</span></td>';
            tr += '<td>' + data[item].UserName + '</td>';
            tr += '<td>' + data[item].CrDateTime.split(' ')[0] + '</td>';
            //tr += '<td>' + (data[item].AccountantUserName != null ? data[item].AccountantUserName : '' ) + '</span></td>';
            //tr += '<td>' + (data[item].AdminUserName !=null ? data[item].AdminUserName : '') + '</span></td>';
            tr += '<td>' + wordLimit(data[item].Comment != null ? data[item].Comment : "") + '</td>';
            tr += '</tr>';
            html += tr;
        }
        html += '<tr>' +
            '<td colspan="14" class="paginate_table"></td>' +
            '</tr>';
        $('#table-data').find('tbody').html(html);
    }
    $('input.iCheckTable').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
}

$('#table-data').Paginate({
    page: paginate.page,
    pageSize: paginate.pageShow,
    totalRow: paginate.totalRow
});
