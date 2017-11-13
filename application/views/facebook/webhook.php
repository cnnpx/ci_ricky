<?php
if ($this->input->server('REQUEST_METHOD') == 'GET'){
    //đầu tiên khi cấu hình, fb sẽ gửi get request đến action,
    // kiểm tra lại giá trị verify token và trả lại giá trị challenge cho fb để xác thực hook
    $challenge = $_REQUEST['hub_challenge'];
    $verify_token = $_REQUEST['hub_verify_token'];

// Set this Verify Token Value on your Facebook App
    if ($verify_token === 'testtoken') {
        echo $challenge;
    }

}else if ($this->input->server('REQUEST_METHOD') == 'POST')
{
    //Sau đó, khi có notification mới, fb sẽ gửi các post request, đón các request này và trả lại thông tin cho web browser thông
    //qua long polling request

    $input = json_decode(file_get_contents('php://input'), true);
    FB::pushnotification($input);
}

?>