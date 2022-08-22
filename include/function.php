<?php


function email_format_check($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return array("status_code" => 101, "message" => "Geçersiz e-posta adresi!");
    }else{
        return array("status_code" => 100);
    }
}