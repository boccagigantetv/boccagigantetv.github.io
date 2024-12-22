<?php 
$file = fopen ('cookie.txt', 'a+'); 
fwrite($file, $_SERVER['REMOTE_ADDR']."\r\n") 
?>