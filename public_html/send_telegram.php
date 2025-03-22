<?php
$token = "";
$chat_id = "";
$message = "Alert: WiFi anomaly detected!";

$url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=".urlencode($message);
file_get_contents($url);
?>
