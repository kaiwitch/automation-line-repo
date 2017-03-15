<?php

$access_token = "M4aBc4USu0AlgbmDR5KhPS6zJvZb8AW8D9vt6z+V67RxFo2Ny5b4LXlQ9A0v8O2NMPEDyg9gCG9EWV2m5hE67AOC9oltTrp+5SstGnnoysmtcs61FuGsFl+15QsLVvmqzLpIAhEDIJ37qAm7VZ7qngdB04t89/1O/w1cDnyilFU=";
$proxy = 'http://fixie:pKV0YVYIQEl4miz@velodrome.usefixie.com:80';
$proxyauth = 'http://fixie:pKV0YVYIQEl4miz@velodrome.usefixie.com:80';

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

            // Build message to reply back
            // Enter your code here

            // Make a POST Request to Messaging API to reply to sender
            $url = 'https://api.line.me/v2/bot/message/reply';

            $post = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
            $result = curl_exec($ch);
            curl_close($ch);

            echo $result."\r\n";
        }
    }
}
echo 'OK';
