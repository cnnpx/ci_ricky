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
{//Sau đó, khi có notification mới, fb sẽ gửi các post request, đón các request này và trả lại thông tin cho web browser thông
    //qua long polling request

    $input = json_decode(file_get_contents('php://input'), true);
    $this->load->view('view/notification',$input);

}
/*

$input = json_decode(file_get_contents('php://input'), true);

// Get the Senders Graph ID
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];

// Get the returned message
$message = $input['entry'][0]['messaging'][0]['message']['text'];

//API Url and Access Token, generate this token value on your Facebook App Page
$url = 'https://graph.facebook.com/v2.6/me/messages?access_token=EAActZC3KEBCwBAI2hbDkWnq02XQ6PFZBzfm0JB1IQ7ElrFkQv9mEX7aqbtmSds3KBbt4zw2tA3HSP0ZC6tKu9Ou3zgNdKEP4tA2tfnyqPPr3uEQZBOfCS9UOFQj1wRGMK4PIQ8UhUVDlpPT1teOfKF7sLpb6sYrpQ107RLrKpwZDZD';

//Initiate cURL.
$ch = curl_init($url);

//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"' . $sender . '"
    }, 
    "message":{
        "text":"The message you want to return"
    }
}';

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

//Execute the request but first check if the message is not empty.
if(!empty($input['entry'][0]['messaging'][0]['message'])){
  $result = curl_exec($ch);
}
*/
?>