<?php

class Model{
    protected $room_id;
    protected $message;
    protected $message_type;
    protected $sender;

    public function __construnct() {
    }

    protected function getRoomId(){
        return $this->room_id;
    }

    protected function setRoomId($room_id){
        return $this->room_id = $room_id;
    }

    protected function setMessage($message){
        return $this->message = $message;
    }

    protected function getMessage(){
        return $this->message;
    }

    protected function setMessageType($message_type){
        return $this->message_type = $message_type;
    }

    protected function getMessageType(){
        return $this->message_type;
    }

    protected function setSender($sender){
        return $this->sender = $sender;
    }

    protected function getSender(){
        return $this->sender;
    }
}