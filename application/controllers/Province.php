<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province extends MY_Controller{

    public function insert(){
        $str = file_get_contents ('assets/json/data.json');
        $arr = json_decode($str, true);
        $data = $arr['Data'];
        foreach($data as $k => $v) {
            $districts = $v['Districts'];
            $id_cty = $v['Id'];
            $cty_name = $v['Name'];
            $data_province = array(
                'ProvinceId' => $id_cty,
                'ProvinceName' => $cty_name,
                'DisplayOrder' => 1
            );
            //$this->db->insert('provinces', $data_province);
            $data_districts = array();
            foreach($districts as $key => $value) {
                $data_districts[] = array(
                    'DistrictId' => $value['Id'],
                    'ProvinceId'      => $id_cty,
                    //'DistrictCode' => $value['DistrictCode'],
                    'DistrictName' => $value['DistrictName'],
                    'GHNSupport'   => $value['GHNSupport'],
                    'TTCSupport'   => $value['TTCSupport'],
                    'VNPTSupport'  => $value['VNPTSupport'],
                    'ViettelPostSupport' => $value['ViettelPostSupport'],
                    'ShipChungSupport' => $value['ShipChungSupport'],
                    'GHNDistrictCode' => $value['GHNDistrictCode'],
                    'ViettelPostDistrictCode' => $value['ViettelPostDistrictCode'],
                    'ShipChungDistrictCode' => $value['ShipChungDistrictCode']
                );
                //$this->db->insert('districts',$data_districts);
            }
            //if(!empty($data_districts)) $this->db->insert_batch('districts', $data_districts);
            echo $cty_name.'<br/>';
        }
    }
}