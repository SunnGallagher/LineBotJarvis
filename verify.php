<?php
$access_token = 'Ycdb4tYcPnoxlqkXjN4wOIDejf2Rmg46u2LvkYuu749PmYHmy8m2Xq4+jEAxdOXxczWbGNmrkf3oRpEJIS7otH5gntxC6Zx95tUhCCYiKj0eEpeVGzv3sFnJHELRtwd0jPkvdrDHQgfCpZ7/26TS6wdB04t89/1O/w1cDnyilFU=s';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;