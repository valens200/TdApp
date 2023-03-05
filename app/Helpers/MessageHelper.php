<?php

namespace Helpers\MessageHelper;
 class MessageHelper {
    private  $message = "";

    public function __construct($message){
        $this->$message = $message;
    }
    public function getMessage(){
        return $this->message;
    }

    public function setMessage($message){
        $this->message = $message;
    }


}