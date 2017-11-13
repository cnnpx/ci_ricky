<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Musers extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "users";
        $this->_primary_key = "UserId";
    }

    public function login($userName, $userPass){
        if(!empty($userName) && !empty($userPass)){
            $query = "SELECT * FROM users WHERE UserPass=? AND StatusId=? AND (UserName=? OR PhoneNumber=?) LIMIT 1";
            $users = $this->getByQuery($query, array(md5($userPass), STATUS_ACTIVED, $userName, $userName));
            if (!empty($users)){
                $user = $users[0];
                $this->load->model('Mlogins');
                $this->Mlogins->save(array('UserId' => $user['UserId'], 'IpAddress' => $this->input->ip_address(), 'UserAgent' => $this->input->user_agent(), 'LoginDateTime' => getCurentDateTime()));
                return $user;
            }
        }
        return false;
    }

    public function checkExist($userId, $userName, $email, $phoneNumber){
        $query = "SELECT UserId FROM users WHERE UserId!=? AND StatusId=?";
        if(!empty($email) && !empty($phoneNumber)){
            $query .= " AND (UserName=? OR Email=? OR PhoneNumber=?) LIMIT 1";
            $users = $this->getByQuery($query, array($userId, STATUS_ACTIVED, $userName, $email, $phoneNumber));
        }
        elseif(!empty($email)){
            $query .= " AND (UserName=? OR Email=?) LIMIT 1";
            $users = $this->getByQuery($query, array($userId, STATUS_ACTIVED, $userName, $email));
        }
        elseif(!empty($phoneNumber)){
            $query .= " AND (UserName=? OR PhoneNumber=?) LIMIT 1";
            $users = $this->getByQuery($query, array($userId, STATUS_ACTIVED, $userName, $phoneNumber));
        }
        if (!empty($users)) return $users[0];
        return false;
    }

    public function getCount($postData){
        $query = "StatusId > 0" . $this->buildQuery($postData);
        return $this->countRows($query);
    }

    public function search($postData, $perPage = 0, $page = 1){
        $query = "SELECT * FROM users WHERE StatusId > 0" . $this->buildQuery($postData);
        if($perPage > 0) {
            $from = ($page-1) * $perPage;
            $query .= " LIMIT {$from}, {$perPage}";
        }
        return $this->getByQuery($query);
    }

    private function buildQuery($postData){
        $query = '';
        if(isset($postData['UserName']) && !empty($postData['UserName'])) $query.=" AND UserName LIKE '%{$postData['UserName']}%'";
        if(isset($postData['FullName']) && !empty($postData['FullName'])) $query.=" AND FullName LIKE '%{$postData['FullName']}%'";
        if(isset($postData['Email']) && !empty($postData['Email'])) $query.=" AND Email LIKE '%{$postData['Email']}%'";
        if(isset($postData['PhoneNumber']) && !empty($postData['PhoneNumber'])) $query.=" AND PhoneNumber LIKE '%{$postData['PhoneNumber']}%'";
        if(isset($postData['DegreeName']) && !empty($postData['DegreeName'])) $query.=" AND DegreeName LIKE '%{$postData['DegreeName']}%'";
        if(isset($postData['GenderId']) && $postData['GenderId'] > 0) $query.=" AND GenderId=".$postData['GenderId'];
        if(isset($postData['StatusId']) && $postData['StatusId'] > 0) $query.=" AND StatusId=".$postData['StatusId'];
        if(isset($postData['ProvinceId']) && $postData['ProvinceId'] > 0) $query.=" AND ProvinceId=".$postData['ProvinceId'];
        return $query;
    }

    public function getList() {
        return $this->getby('StatusId > 0', false, '', '', 0, 0, 'asc');
    }
}