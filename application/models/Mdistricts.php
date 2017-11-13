<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdistricts extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->_table_name = "districts";
        $this->_primary_key = "DistrictId";
    }

    public function selectHtml($districtId = 0, $selectName = 'DistrictId'){
        $listDistricts = $this->get();
        $retVal = '<select class="form-control" name="'.$selectName.'" id="'.lcfirst($selectName).'"><option value="0" data-id="0">--Chọn--</option>';
        foreach($listDistricts as $d) $retVal .= '<option value="'.$d['DistrictId'].'" data-id="'.$d['ProvinceId'].'"'.($d['DistrictId'] == $districtId ? ' selected="selected"' : '').'>'.$d['DistrictName'].'</option>';
        $retVal .= '</select>';
        return $retVal;
    }
}