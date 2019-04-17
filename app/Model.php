<?php

class Model{
    protected $room_id;
    protected $message;
    protected $message_type;
    protected $sender;

    public function __construct($room_id, $message, $message_type, $sender) {
        $this->room_id = $room_id;
        $this->message = $message;
        $this->message_type = $message_type;
        $this->sender = $sender;
    }

    public function getRoomId(){
        return $this->room_id;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getMessageType(){
        return $this->message_type;
    }

    public function getSender(){
        return $this->sender;
    }
}