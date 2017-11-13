<?php
include APPPATH . 'third_party/Facebook/autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
class FB extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();

        $fb = new Facebook\Facebook([
            'app_id'                => '2020899998139436',
            'app_secret'            => 'cecc8c9c67458626c667fbc55a7676ce',
            'default_graph_version' => 'v2.10',
        ]);
    }


    public function index(){
        $this->load->view('facebook/list');

    }
    //callback xác nhận webhook

    public function hookcallback() {
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
//            $data = array(
//               'payload' => $input
//            );
//            $this->load->view('facebook/notification',$data);

            //brooadcast to all client
            FB::pushnotification($input);
        }
    }

//    get feed of page
    public function callbackdata(){
        $param = array();
        $request = new FacebookRequest(null,'','GET','/1759192184381061/feed',$param,null,'2.10');
        $facebookClient = new \Facebook\FacebookClient($request,false);
        $response = $facebookClient->sendRequest();
        $graphObject = $response->getBody();
        echo  $graphObject;
    }


    function makerequestfeed(){
        $fb = new Facebook\Facebook([
            'app_id'  => '2020899998139436',
            'app_secret' => 'cecc8c9c67458626c667fbc55a7676ce',
            'default_graph_version' => 'v2.10'
        ]);


// Send the request to Graph
        try {
            $accessToken=  $fb->getApp()->getAccessToken();
            echo $accessToken;
            $response = $fb->get('/me/feed', $accessToken);
            echo $response;
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getTraceAsString();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }


   public  function pushnotification (){

    }

}

?>