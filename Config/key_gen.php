<?php

$encriptionKey = openssl_random_pseudo_bytes(32);

file_put_contents('config.php',"<?php define('SECRET_KEY', " . var_export($encriptionKey,true) . "); ?>");

?>