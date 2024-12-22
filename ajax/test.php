<? 
$ip = $_SERVER['REMOTE_ADDR'] . PHP_EOL; 
file_put_contents("cookie.txt", "$ip", FILE_APPEND); 
echo "Your ip $ip has been logged." 
?>