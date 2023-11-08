<?php
include "retrive_key.php";

function encrypt($data, $encrytionKey, $iv){
    return openssl_encrypt($data, 'aes-256-cbc', $encrytionKey, 0, $iv);
}

function decrypt($data, $encrytionKey, $iv){
    return openssl_decrypt($data, 'aes-256-cbc', $encrytionKey, 0, $iv);
}

?>