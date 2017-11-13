<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MY_Controller{

    public function deleteBatch(){
        $user = $this->session->userdata('user');
        if($user){
            $transactionIds = json_decode(trim($this->input->post('ItemIds')), true);
            if(!empty($transactionIds)){
                $this->load->model('Mtransactions');
                $flag = $this->Mtransactions->deleteBatch($transactionIds, $user);
                if($flag) echo json_encode(array('code' => 1, 'message' => "Xóa phiếu thành công"));
                else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function update(){
        $user = $this->session->userdata('user');
        if($user){
            $postData = $this->arrayFromPost(array('CustomerId', 'OrderId', 'TransactionTypeId', 'TransactionStatusId', 'StoreId', 'MoneySourceId', 'MoneyPhoneId', 'PaidCost', 'Comment'));
            $postData['PaidCost'] = replacePrice($postData['PaidCost']);
            if($postData['CustomerId'] > 0 && $postData['OrderId'] > 0 && $postData['PaidCost'] > 0){
                $transactionId = $this->input->post('TransactionId');
                $crDateTime = getCurentDateTime();
                $transactionTypeName = $this->Mconstants->transactionTypes[$postData['TransactionTypeId']];
                $actionLogs = array(
                    'ItemTypeId' => 10,
                    'CrUserId' => $user['UserId'],
                    'CrDateTime' => $crDateTime
                );
                if($transactionId > 0){
                    $actionLogs['ActionTypeId'] = 2;
                    $actionLogs['Comment'] = $user['FullName'] . ': Cập nhật phiếu '.$transactionTypeName;
                }
                else{
                    $postData['CrUserId'] = $user['UserId'];
                    $postData['CrDateTime'] = $crDateTime;
                    $actionLogs['ActionTypeId'] = 1;
                    $actionLogs['Comment'] = $user['FullName'] . ': Thêm mới phiếu '.$transactionTypeName;
                }
                $this->load->model('Mtransactions');
                $tagNames = json_decode(trim($this->input->post('TagNames')), true);
                $transactionId = $this->Mtransactions->update($postData, $transactionId, $tagNames, $actionLogs);
                if ($transactionId > 0) echo json_encode(array('code' => 1, 'message' => "Cập nhật phiếu {$transactionTypeName} thành công", 'data' => $transactionId));
                else echo json_encode(array('code' => 0, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
            }
            else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
        }
        else echo json_encode(array('code' => -1, 'message' => "Có lỗi xảy ra trong quá trình thực hiện"));
    }

    public function search(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filterId = $this->input->post('filterId');
            $searchText=$this->input->post('searchText');
            if ($filterId > 0) {
                $query = $this->db->select(['FilterData', 'TagFilter'])->where('FilterId', $filterId)->get('filters');
                $filter = $query->row();
                $itemFilters = json_decode($filter->FilterData,true);
                $tagFilters = json_decode($filter->TagFilter,true);
                $data['tagFilters'] = $tagFilters;
                $data['itemFilters'] = $itemFilters;
            }
            else {
                $itemFilters = $this->input->post('itemFilters');
            }
            $page = intval($this->input->post('page') ? $this->input->post('page') : 1);
            $limit = intval($this->input->post('limit') ? $this->input->post('limit') : DEFAULT_LIMIT);
            $totalRow = $this->db->select('count(*) as totalRow')->get('transactions')->row_array()['totalRow'];

            $this->loadModel(array('Mcustomers', 'Morders', 'Mtransactions', 'Mstores', 'Mmoneysources', 'Mmoneyphones', 'Musers'));
            $query = "select {selects} from transactions {joins} where {wheres} ORDER BY transactions.CrDateTime DESC LIMIT {limits}";
            $selects = [
                'transactions.*',
                'customers.Email',
                'stores.StoreName',
                'orders.OrderCode',
                'customers.FullName',
                'users.UserName',
                'moneysources.MoneySourceName',
                'moneyphones.MoneyPhoneName',
            ];
            $joins = [
                'customers' => "left join customers on customers.CustomerId = transactions.CustomerId",
                'stores' => "left join stores on stores.StoreId = transactions.StoreId",
                'orders' => "left join orders on orders.OrderId = transactions.OrderId",
                'moneysources' => 'left join moneysources on moneysources.MoneySourceId = transactions.MoneySourceId',
                'users' => 'left join users on users.UserId = transactions.CrUserId',
                'moneyphones' => 'left join moneyphones on moneyphones.MoneyPhoneId = transactions.MoneyPhoneId'
            ];
            $wheres = [];
            $wheres_search= '';
            $data_bind = [];
            //search theo text
            if(!empty($searchText)){
                $searchText=$this->Mhelpers->formatSearchText($searchText);
                if(filter_var($searchText,FILTER_VALIDATE_EMAIL)){
                    $wheres_search = 'customers.Email like ?';
                    $data_bind[] = "%$searchText%";
                }else if(preg_match('/\d{4}-\d{2}-\d{2}/im',$searchText)){
                    $wheres_search = 'transactions.CrDateTime like ?';
                    $data_bind[] = "$searchText%";
                }else if(preg_match('/\d+|\w+-/im',$searchText)){
                    $wheres_search = 'orders.OrderCode like ? or transactions.CrDateTime like ? or transactions.PaidCost like ?';
                    $data_bind[] = "%$searchText%";
                    $data_bind[] = "%$searchText%";
                    $data_bind[] = "%$searchText%";
                }else if(strpos("da duyet",$searchText) > -1 ){
                    $wheres_search = 'transactions.TransactionStatusId > 1';
                }else if(strpos('chua duyet',$searchText) > -1){
                    $wheres_search = 'transactions.TransactionStatusId = 1';
                }else if(strpos('ghi no',$searchText) > -1 ||  strpos('no',$searchText) > -1  ||  strpos('ghi',$searchText) > -1 ){
                    $wheres_search = 'transactions.TransactionTypeId = 3';
                }else if(strpos('phieu',$searchText) > -1){
                    $wheres_search = 'transactions.TransactionTypeId = 2 or transactions.TransactionTypeId = 1';
                }else if(strpos('phieu thu',$searchText) > -1 || strpos('thu',$searchText) > -1){
                    $wheres_search = 'transactions.TransactionTypeId = 1';
                }else if(strpos('phieu chi',$searchText) > -1 || strpos('chi',$searchText) > -1){
                    $wheres_search = 'transactions.TransactionTypeId = 2';
                }
                else{
                    $wheres_search =
                        '
                        orders.OrderCode like ? or customers.FullName like ? or users.Username like ? or customers.Email like ? 
                        or moneysources.MoneySourceName like ? or stores.StoreName like ? 
                        or moneyphones.MoneyPhoneName like ?
                        ';
                    for( $i = 0; $i < 7; $i++){
                        $data_bind[] = "%$searchText%";
                    }
                }

            }
            if($wheres_search != '') {
                $wheres_search = "( $wheres_search )";
                $wheres[] = $wheres_search;
            }

            //search theo bộ lọc ,
            if (!empty($itemFilters) && count($itemFilters)) {
                foreach ($itemFilters as $item) {
                    $filed_name = $item['field_name'];
                    $conds = $item['conds'];

                    //$cond[0] là điều kiện ví dụ : < > = like .....   $cons[1] và $cond[2]  là gía trị điều kiện như 2017-01-02 và 2017-01-01
                    switch ($filed_name) {

                        case 'group_money':
                            $wheres[] = "transactions.PaidCost $conds[0] ?";
                            $data_bind[] = $conds[1];
                            break;
                        case 'group_email':
                            $wheres[] = "customers.Email $conds[0] ?";
                            $data_bind[] = $conds[1];
                            break;
                        case 'group_date':
                            if ($conds[0] == 'between') {
                                $wheres[] = 'transactions.CrDateTime between ? and ?';
                                $data_bind[] = $conds[1];
                                $data_bind[] = $conds[2];
                            } else {
                                $wheres[] = "transactions.CrDateTime $conds[0] ?";
                                $data_bind[] = $conds[1];
                            }
                            break;
                        case 'group_ac_datetime' :
                            if ($conds[0] == 'between') {
                                $wheres[] = 'transactions.AccountantDateTime between ? and ?';
                                $data_bind[] = $conds[1];
                                $data_bind[] = $conds[2];
                            } else {
                                $wheres[] = "transactions.AccountantDateTime $conds[0] ?";
                                $data_bind[] = $conds[1];
                            }
                            break;
                        case 'group_admin_datetime' :
                            if ($conds[0] == 'between') {
                                $wheres[] = 'transactions.AdminDateTime between ? and ?';
                                $data_bind[] = $conds[1];
                                $data_bind[] = $conds[2];
                            } else {
                                $wheres[] = "transactions.AdminDateTime $conds[0] ?";
                                $data_bind[] = $conds[1];
                            }
                            break;
                        case 'group_status_trans':
                            $wheres[] = "transactions.TransactionStatusId $conds[0] ?";
                            $data_bind[] = $conds[1];
                            break;
                        case 'group_type_trans':
                            $wheres[] = "transactions.TransactionTypeId $conds[0] ?";
                            $data_bind[] = $conds[1];
                            break;
                        case 'group_store':
                            $wheres[] = "stores.StoreId $conds[0] ?";
                            $data_bind[] = $conds[1];
                            break;
                        case 'group_order':
                            $wheres[] = "orders.OrderCode $conds[0] ?";
                            $data_bind[] = $conds[1];
                            break;
                        case 'group_moneysource':
                            $wheres[] = "moneysources.MoneySourceId $conds[0] ?";
                            $data_bind[] = $conds[1];
                            break;
                        default :
                            break;
                    }
                }
            }
            $selects_string = implode(',', $selects);
            $wheres_string = implode(' and ', $wheres);
            $joins_string = implode(' ', $joins);
            $query = str_replace('{selects}', $selects_string, $query);
            $query = str_replace('{joins}', $joins_string, $query);
            $query = str_replace('{wheres}', $wheres_string, $query);
            $query = str_replace('{limits}', $limit * ($page - 1) . "," . $limit, $query);
            if (count($wheres) == 0)
                $query = str_replace('where', '', $query);

            $dataTransactions = $this->db->query($query, $data_bind)->result_array();
            $listUsers=$this->Musers->getBy(['StatusId > ' => 0]);
            for ($i = 0; $i < count($dataTransactions); $i++) {
                $dataTransactions[$i]['TransactionStatus'] = $this->Mconstants->transactionStatus[$dataTransactions[$i]['TransactionStatusId']];
                $dataTransactions[$i]['TransactionType'] = $this->Mconstants->transactionTypes[$dataTransactions[$i]['TransactionTypeId']];
                $dataTransactions[$i]['AccountantUserName'] = $this->Mconstants->getObjectValue($listUsers, 'UserId', $dataTransactions[$i]['AccountantUserId'], 'FullName');
                $dataTransactions[$i]['AdminUserName'] = $this->Mconstants->getObjectValue($listUsers, 'UserId', $dataTransactions[$i]['AdminUserId'], 'FullName');
            }

            $pageSize = ceil($totalRow / $limit);
            $data['dataTables'] = $dataTransactions;
            $data['page'] = $page;
            $data['pageSize'] = $pageSize;
            $data['callBackTable'] = 'renderContentTransactions';
            $data['callBackTagFilter'] = 'renderTagFilter';
            $data['totalRow'] = $totalRow;
            echo json_encode($data);
        }
    }

}