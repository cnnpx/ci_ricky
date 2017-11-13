<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcustomeraddress extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "customeraddress";
        $this->_primary_key = "CustomerAddressId";
    }

    public function update($postData){
        $searchData = $postData;
        unset($searchData['CrUserId']);
        unset($searchData['CrDateTime']);
        $customerAddressId = $this->getFieldValue($searchData, 'CustomerAddressId', 0);
        if($customerAddressId == 0) $customerAddressId = $this->save($postData);
        return $customerAddressId;
    }
}