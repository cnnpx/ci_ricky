<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends MY_Controller{

    public function transportType(){
        header('Content-Type: application/json');
        $this->load->model('Mtransporttypes');
        echo json_encode(array('code' => 1, 'data' => $this->Mtransporttypes->getBy(array('StatusId' => STATUS_ACTIVED))));
    }

    public function store(){
        header('Content-Type: application/json');
        $this->load->model('Mstores');
        echo json_encode(array('code' => 1, 'data' => $this->Mstores->getBy(array('ItemStatusId' => STATUS_ACTIVED), false, '', 'StoreId, StoreName')));
    }
}