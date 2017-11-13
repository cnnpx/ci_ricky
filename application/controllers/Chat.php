<?php
/**
 * Created by PhpStorm.
 * User: tu.leanh.ctv
 * Date: 8/10/2017
 * Time: 10:11 PM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chat extends MY_Controller {

    public function index() {
        $data  = array
        (   'pageId' =>'1759192184381061',
            'appId'  => '2020899998139436',
            'appToken' => '2020899998139436|dvRUN1GCgvUv2P3aP3EXQqSrLlk'
        );

        $this->load->view("facebook/chat",$data);

    }




}