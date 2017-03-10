<?php
$access_token = 'Ycdb4tYcPnoxlqkXjN4wOIDejf2Rmg46u2LvkYuu749PmYHmy8m2Xq4+jEAxdOXxczWbGNmrkf3oRpEJIS7otH5gntxC6Zx95tUhCCYiKj0eEpeVGzv3sFnJHELRtwd0jPkvdrDHQgfCpZ7/26TS6wdB04t89/1O/w1cDnyilFU=';

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
				$tmp1 = $arraytext[0];
				$tmp2 = $arraytext[1];
				$num1 = (int)$tmp1;
				$num2 = (int)$tmp2;
				$ans = $num1 + $num2;
				$stringAns = (string)$ans;
				$messages = [
				'type' => 'text',
				'text' => $stringAns . '  ไงละ ไอเมี้ยวอ้วนเอ้ยยย'
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