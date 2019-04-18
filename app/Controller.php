<?php

use Unirest\Request;

class Controller{
    private $access_token  = "<input access token disini>"; //akses token dapat diambil dari sini https://qisme.qiscus.com/app/kiwari-prod
    private $apiurl    = "https://qisme.qiscus.com/api/v1/chat/conversations/"; //dokumentasi penggunaan api ada disini http://qisme-docs.herokuapp.com/api-docs/
    private $headers = array(
        'Content-Type' => 'application/json',
        'Content-Type' => 'multipart/form-data'
    ); 
    private $qismeResponse; //response atribut

    function __construct(){
    }

    //ambil nilai response yang sudah di tampung ke atribut
    private function getQismeResponse(){
        return $this->qismeResponse;
    }

    //ambil konten response dari webhook ke callback url
    private function getResponseContent(){
        return json_decode(file_get_contents("php://input"), true);
    }

    //tampung konten dari webhook ke atribut
    private function getResponse(){
        $this->qismeResponse = $this->getResponseContent();

        //log untuk memastikan konten response dari webhook barhasil diambil
        file_put_contents('log-comment.txt', json_encode($this->getQismeResponse(), JSON_PRETTY_PRINT));
    }

    //contoh penggunaan api post-comment untuk jenis button
    private function replyCommandButton($display_name,$room_id){
        $comment ="Halo, ".$display_name." ini adalah contoh payload button yang bisa kamu coba";
        $payload = array(
            "text" => $comment,
            "buttons" => array(
                array(
                    "label" => "Tombol Reply Text",
                    "type" => "postback",
                    "payload" => array(
                        "url" => "#",
                        "method" => "get",
                        "payload" => "null"
                    )
                ),
                array(
                    "label" => "Tombol Link",
                    "type" => "link",
                    "payload" => array(
                        "url" => "https://www.google.com",
                    )
                )
            )
        );
        $replay = array(
            'access_token'=>$this->access_token,
            'topic_id'=>$room_id,
            'type'=>'buttons',
            'payload'=> json_encode($payload)
        );
        $post_comment  = Request::post($this->apiurl."post_comment", $this->headers, $replay);
        $post_comment->raw_body;
    }

    //contoh penggunaan api post-comment untuk jenis text
    private function replyCommandText($display_name,$message_type,$room_id){
        $comment = 
        "Maaf ".$display_name.", command yang kamu ketik salah. Jenis pesan kamu adalah ".$message_type.". Silahkan coba command berikut :\n".
        "/location, /button, /card, /carousel";

        $replay = array(
            'access_token'=>$this->access_token,
            'topic_id'=>$room_id,
            'type'=>'text',
            'comment'=> $comment
        );
        $post_comment  = Request::post($this->apiurl."post_comment", $this->headers, $replay);
        $post_comment->raw_body;
    }

    //contoh penggunaan api post-comment untuk jenis location
    private function replyCommandLocation($room_id){
        $payload = array(
            "name" => "Telkom Landmark Tower",
            "address" => "Jalan Jenderal Gatot Subroto No.Kav. 52, West Kuningan, Mampang Prapatan, South Jakarta City, Jakarta 12710",
            "latitude" => "-6.2303817",
            "longitude" => "106.8159363",
            "map_url" => "https://www.google.com/maps/@-6.2303817,106.8159363,17z"
        );
        $replay = array(
            'access_token'=>$this->access_token,
            'topic_id'=>$room_id,
            'type'=>'location',
            'payload'=> json_encode($payload)
        );
        $location  = Request::post($this->apiurl."post_comment", $this->headers, $replay);
        $location->raw_body;
    }

    //contoh penggunaan api post-comment untuk jenis carousel
    private function replyCommandCarousel($room_id){
        $payload = array(
            "cards" => array(
                array(
                    "image" => "https://cdns.img.com/a.jpg",
                    "title" => "Gambar 1",
                    "description" => "Carousel Double Button",
                    "default_action" => array(
                        "type" => "postback",
                        "postback_text" => "Load More...",
                        "payload" => array(
                            "url" => "https://j.id",
                            "method" => "GET",
                            "payload"=> null
                        )
                    ),
                    "buttons" => array(
                        array(
                            "label" => "Button 1",
                            "type" => "postback",
                            "postback_text" => "Load More...",
                            "payload" => array(
                                "url" => "https://www.r.com",
                                "method" => "GET",
                                "payload" => null
                            )
                        ),
                        array(
                            "label" => "Button 2",
                            "type" => "postback",
                            "postback_text" => "Load More...",
                            "payload" => array(
                                "url" => "https://www.r.com",
                                "method" => "GET",
                                "payload" => null
                            )
                        )
                    )
                ),
                array(
                    "image" => "https://res.cloudinary.com/hgk8.jpg",
                    "title" => "Gambar 2",
                    "description" => "Carousel single button",
                    "default_action" => array(
                        "type" => "postback",
                        "postback_text" => "Load More...",
                        "payload" => array(
                            "url" => "https://j.id",
                            "method" => "GET",
                            "payload"=> null
                        )
                    ),
                    "buttons" => array(
                        array(
                            "label" => "Button 1",
                            "type" => "postback",
                            "postback_text" => "Load More...",
                            "payload" => array(
                                "url" => "https://www.r.com",
                                "method" => "GET",
                                "payload" => null
                            )
                        )
                    )
                )
            )
        );
        $replay = array(
            'access_token'=>$this->access_token,
            'topic_id'=>$room_id,
            'type'=>'carousel',
            'payload'=> json_encode($payload)
        );
        $location  = Request::post($this->apiurl."post_comment", $this->headers, $replay);
        $location->raw_body;
    }

    //contoh penggunaan api post-comment untuk jenis card
    private function replyCommandCard($room_id){
        $payload = array(
            "text" => "Special deal buat sista nih..",
            "image" => "https://cdns.img.com/a.jpg",
            "title" => "Gambar 1",
            "description" => "Card Double Button",
            "url" => "http://url.com/baju?id=123%26track_from_chat_room=123",
            "buttons" => array(
                array(
                    "label" => "Button 1",
                    "type" => "postback",
                    "postback_text" => "Load More...",
                    "payload" => array(
                        "url" => "https://www.r.com",
                        "method" => "GET",
                        "payload" => null
                    )
                ),
                array(
                    "label" => "Button 2",
                    "type" => "postback",
                    "postback_text" => "Load More...",
                    "payload" => array(
                        "url" => "https://www.r.com",
                        "method" => "GET",
                        "payload" => null
                    )
                )
            )
        );
        $replay = array(
            'access_token'=>$this->access_token,
            'topic_id'=>$room_id,
            'type'=>'card',
            'payload'=> json_encode($payload)
        );
        $location  = Request::post($this->apiurl."post_comment", $this->headers, $replay);
        $location->raw_body;
    }

    //method untuk running bot
    function run(){
        //ambil response
        $this->getResponse();

        //tampung nilai response ke model
        $data = new Model(
            $this->getQismeResponse()['chat_room']['qiscus_room_id'],
            $this->getQismeResponse()['message']['text'],
            $this->getQismeResponse()['message']['type'],
            $this->getQismeResponse()['from']['fullname']
        );

        //cek pesan dari chat tidak kosong
        if($data->getMessage() != null){
            //cari chat yang mengandung '/' untuk menjalankan command bot
            $find_slash = strpos($data->getMessage(), '/');
            if($find_slash[1] !== false){
                $command = explode("/",$data->getMessage());
                if(isset($command[1])){
                    switch($command[1]){
                        case 'location':
                            $this->replyCommandLocation($data->getRoomId());
                            break;
                        case 'carousel':
                            $this->replyCommandCarousel($data->getRoomId());
                            break;
                        case 'button':
                            $this->replyCommandButton($data->getSender(),$data->getRoomId());
                            break;
                        case 'card':
                            $this->replyCommandCard($data->getRoomId());
                            break;
                        default:
                            $this->replyCommandText($data->getSender(),$data->getMessageType(),$data->getRoomId());
                            break;            
                    }
                }else{
                    $this->replyCommandText($data->getSender(),$data->getMessageType(),$data->getRoomId());
                }
            }
        }
    }
}