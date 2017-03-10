<?php
$access_token = 'ZqWh38XF/ogTCKohjdr1cIAxMBTKGe0UaggAiF9WilmHODIEOSJqHeqw5TJHV7xYczWbGNmrkf3oRpEJIS7otH5gntxC6Zx95tUhCCYiKj3WL6n+S/zdKc8uD8dl8yquiTpdolavo+Ox+5BKqK5eugdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;