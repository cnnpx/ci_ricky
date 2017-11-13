<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(function_exists('date_default_timezone_set')) date_default_timezone_set('Asia/Bangkok');
        $user = $this->Musers->get(3);$this->session->set_userdata('user', $user);
    }

    protected function commonData($user, $title, $data = array()){
        $data['user'] = $user;
        $data['title'] = $title;
        $data['listActions'] = $this->Mactions->getByUserId($user['UserId']);
        //$data['listProductTypes'] = $this->Mproducttypes->getBy(array('StatusId' => STATUS_ACTIVED));
        return $data;
    }

    protected function loadModel($models = array()){
        foreach($models as $model) $this->load->model($model);
    }

    protected function arrayFromPost($fields) {
        $data = array();
        foreach ($fields as $field) $data[$field] = trim($this->input->post($field));
        return $data;
    }

    protected function sendMail($emailFrom, $nameFrom, $emailTo, $subject, $message){
        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from($emailFrom, $nameFrom);
        $this->email->to($emailTo);
        $this->email->subject($subject);
        $this->email->message($message);
        if($this->email->send()) return true;
        return false;
    }
}