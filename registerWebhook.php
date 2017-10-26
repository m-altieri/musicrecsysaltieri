<?php

$webhookUrl = "https://testmovierecsysbot.herokuapp.com/execute.php";
$verifyToken = "movierecsysbot";
$accessToken = "EAAE0Lnad6ywBAAhC40YZAncbqj3ZAWOvlpbuH5EF0ZCxMf5KwnS8JCpctYpVIo6YTCdPpec7vk9olB30HuSyMoRbyUX96FvNxs8NQ0OoeoYr1xYmMSvk4qduu0wlVRycF5YbgJ8L6Vf79fJhKCPCoFzvmonF9OBWfZAZBbv1OEQZDZD";

if ($_REQUEST['hub_verify_token'] === $verifyToken) {
	console.log("Validating webhook");
	echo $_REQUEST['hub_challenge'];
}

$input = json_decode(file_get_contents('php://input'), true);

$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$answer = $input['entry'][0]['messaging'][0]['message']['text'];

$response = [
		'recipient' => [ 'id' => $senderId ],
		'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);

// $response = [
// 		'recipient' => [ 'id' => $senderId ],
// 		'message' => [ 'text' => 'Ecco una quick reply',
// 				'quick_replies' => array (
// 						[ 'content_type' => 'text',
// 								'title' => 'Quick Reply 1',
// 								'payload' => 'Quick Reply 1'
// 						],
// 						[ 'content_type' => 'text'
// 								'title' => 'Quick Reply 2',
// 								'payload' => 'Quick Reply 2'
// 						]
// 				)
// 		]
// ];
// $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
// curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
// curl_exec($ch);
// curl_close($ch);

// curl -X POST -H "Content-Type: application/json" -d '{
//   "recipient":{
//     "id":"<PSID>"
//   },
//   "message":{
//     "text": "Here's a quick reply!",
//     "quick_replies":[
//       {
//         "content_type":"text",
//         "title":"Search",
//         "payload":"<POSTBACK_PAYLOAD>",
//         "image_url":"http://example.com/img/red.png"
// },
// {
// 	"content_type":"location"
// },
// {
// 	"content_type":"text",
// 	"title":"Something Else",
// 	"payload":"<POSTBACK_PAYLOAD>"
// }
// ]
// }
// }' "https://graph.facebook.com/v2.6/me/messages?access_token=<PAGE_ACCESS_TOKEN>"

?>