<?php

use Unirest\Request;
use Model;

class Controller{
    private $access_token  = "eyJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjo0Njk1NSwidGltZXN0YW1wIjoiMjAxOS0wNC0wNSAwNjoxMjo0MSArMDAwMCJ9.u5PHjfNPrRL_nhh5S-UUSNLBr2kKBlBI89px2L2jjdg";
    private $apiurl    = "https://qisme.qiscus.com/api/v1/chat/conversations/";
    protected $headers = array(
        'Content-Type' => 'application/json',
        'content-type' => 'multipart/form-data'
    );
    protected $qismeResponse;

    function __construct(){
    }

    protected function getQismeResponse(){
        return $this->qismeResponse;
    }

    private function getResponseContent(){
        return json_decode(file_get_contents("php://input"), true);
    }

    protected function getResponse(){
        $this->qismeResponse = $this->getResponseContent();
        file_put_contents('log-comment.txt', json_encode($this->getQismeResponse(), JSON_PRETTY_PRINT));
    }

    protected function replyCommandButton(){

    }

    protected function replyCommandText($display_name,$message_type){
        $comment = 
        "Maaf, ".$display_name." command yang ketik salah. jenis pesan kamu adalah ".$message_type."\n".
        "Silahkan coba command berikut : /location, /button, /card, /carousel";

        $replay = array(
            'access_token'=>$this->access_token,
            'topic_id'=>$this->room_id,
            'type'=>'text',
            'comment'=> $comment
        );
        $post_comment  = Request::post($this->apiurl."post_comment", $this->headers, $replay);
        print_r($post_comment->raw_body);
    }

    protected function replyCommandLocation(){

    }

    protected function replyCommandCaraousel(){

    }

    protected function replyCommandCard(){

    }

    function run(){
        $this->getResponse();
        $data = new Model(
            $this->getQismeResponse()['chat_room']['qiscus_room_id'],
            $this->getQismeResponse()['message']['text'],
            $this->getQismeResponse()['message']['type'],
            $this->getQismeResponse()['from']['fullname']
        );
        if($data->getMessage() != null){
            $find_slash = strpos($data->getMessage(), '/');
            if($find_slash[1] !== false){
                $command = explode("/",$this->getMessage());
                if(isset($command[1])){
                    switch($command[1]){
                        case 'location':
                            break;
                        case 'caraousel':
                            break;
                        case 'button':
                            break;
                        case 'card':
                            break;
                        default:
                            $this->replyCommandText();
                            break;            
                    }
                }else{
                    $this->replyCommandText();
                }
            }
        }
    }
}