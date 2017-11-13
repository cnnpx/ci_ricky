<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mhelpers extends CI_Model
{
    function __construct()
    {

    }

    public function getSelecOptionHtml($data,$name='',$id='',$value_default='',$attr=[]){
        $required=!empty($attr['required']) && $attr['required'] ? 'required' : '';
        $disabled=!empty($attr['disabled']) && $attr['disabled'] ? 'disabled' : '';
        $html="<select $required $disabled class='form-control' name='$name' id='$id'>";
        if(count($data) > 0)
            $html.="<option value='0' selected>Chọn thông tin</option>";
        else
            $html.="<option value='0' selected>Không có thông tin</option>";
        foreach ($data as $key=> $value){
            if(is_array($value)) {
                $keys = array_keys($value);
                $name_value = $value[$keys[0]];
                $text_value = $value[$keys[1]];
                $selectd = $value_default==$name_value ? 'selected' :'';
                $html .= "<option $selectd value='$name_value'>$text_value</option>";
            }else {
                $selectd=$value_default==$key ? 'selected' :'';
                $html .= "<option $selectd value='$key'>$value</option>";
            }
        }
        $html.="</select>";
        return $html;
    }

    public function xss($data){
        foreach ($data as $key=>$value){
            $data[$key]=strip_tags($value);
        }
        return $data;
    }

    public function wordLimit($content,$limit=20){
        $content=trim(preg_replace('/\s+/',' ',$content));
        $words=explode(" ",$content);
        return str_word_count($content) > $limit ? implode(" ",array_slice($words,0,$limit)) . "..." : $content;
    }

    public function formatSearchText($str){
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|� �|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|� �|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|� �|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|� �|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return  strtolower(trim(preg_replace('/\s+/',' ',$str)));
    }


}