<?php

$access_token = 'ZqWh38XF/ogTCKohjdr1cIAxMBTKGe0UaggAiF9WilmHODIEOSJqHeqw5TJHV7xYczWbGNmrkf3oRpEJIS7otH5gntxC6Zx95tUhCCYiKj3WL6n+S/zdKc8uD8dl8yquiTpdolavo+Ox+5BKqK5eugdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);


// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			if(strpos($text, '+') !== false)
			{
				$arraytext = explode("+", $text, 2);
				$num1 = (int)$arraytext[0];
				$num2 = (int)$arraytext[1];
				$ans = $num1 + $num2;
				$stringAns = (string)$ans;
				$messages = [
				'type' => 'text',
				'text' => $stringAns . '  ไงล่ะ ไอเมี้ยวอ้วนเอ๊ยยย'
				];
			}
			elseif($text === 'ขอบคุณงับ')
			{
				$messages = [
				'type' => 'sticker',
				'packageId': '1',
  				'stickerId': '1'
				];
			}
			else
			{
			// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => 'คิดถึงข้าละสิ เมี้ยวๆ'
			];

			}
			

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";