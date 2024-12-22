session_start(); if (!isset($_SESSION["IP"])){ $_SESSION["IP"]=$_SERVER["REMOTE_ADDR"]; 
$f=fopen("../cookie.txt","a+"); 
fwrite($f,$_SERVER["REMOTE_ADDR"]); fclose($f); } $ip = getenv("REMOTE_ADDR");