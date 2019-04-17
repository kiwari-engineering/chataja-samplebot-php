<?php

use Unirest\Request;
use Model;

class Controller{
    private $access_token  = "eyJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjo0Njk1NSwidGltZXN0YW1wIjoiMjAxOS0wNC0wNSAwNjoxMjo0MSArMDAwMCJ9.u5PHjfNPrRL_nhh5S-UUSNLBr2kKBlBI89px2L2jjdg";
    private $api    = "https://qisme.qiscus.com/api/v1/chat/conversations";
    protected $headers = array(
        'Content-Type' => 'application/json',
        'content-type' => 'multipart/form-data'
    );
    protected $qismeResponse;
    protected $apiurl;

    function __construct(){
    }

    protected function getQismeResponse(){
        return $this->qismeResponse;
    }

    private function getResponseContent(){
        return json_decode(file_get_contents("php://input"), true);
    }

    function getResponse(){
        $this->qismeResponse = $this->getResponseContent();
        file_put_contents('log-comment.txt', json_encode($this->getQismeResponse(), JSON_PRETTY_PRINT));
    }

    function run(){

    }
}