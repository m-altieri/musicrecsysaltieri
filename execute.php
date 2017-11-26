<?php
	
	/**
	 * @author Francesco Baccaro
	 */
	use GuzzleHttp\Client;
	
	require 'vendor/autoload.php';
	$config = require_once '/app/recsysbot/config/movierecsysbot-config.php';
	
// 	$webhookUrl = "https://testmovierecsysbot.herokuapp.com/execute.php";
// 	$myToken = "testmovierecsysbot";
	
// 	$verifyToken = $_REQUEST['hub_verify_token'];
// 	$challenge = $_REQUEST['hub_challenge'];
// 	if ($verifyToken === $myToken) {
// 		echo $_REQUEST['hub_challenge'];
// 		exit();
// 	}
	
	// richiedo tutti le funzioni, i messaggi di risposta e i servizi che mi servono per l'esecuzione
	foreach ( glob ( "recsysbot/classes/*.php" ) as $file ) {
		require $file;
	}
	foreach ( glob ( "recsysbot/functions/*.php" ) as $file ) {
		require $file;
	}
	foreach ( glob ( "recsysbot/keyboards/*.php" ) as $file ) {
		require $file;
	}
	foreach ( glob ( "recsysbot/messages/*.php" ) as $file ) {
		require $file;
	}
	foreach ( glob ( "recsysbot/replies/*.php" ) as $file ) {
		require $file;
	}
	foreach ( glob ( "recsysbot/restService/*.php" ) as $file ) {
		require $file;
	}
	foreach ( glob ( "recsysbot/platforms/*.php" ) as $file ) {
		require_once $file;
	}
	
	// This is suggested from Guzzle
	date_default_timezone_set ( $config ['timezone'] );
	
	/**
	 * Change platform here.
	 * To create a new platform, create its own php class in the platforms folder.
	 * It has to implement the Platform interface.
	 */
	$platform = new $telegram();
	
	$keyboard = [
			["".$emojis['globe']." Recommend Movies"],
			['📘 Help',"".$emojis['gear']." Profile"]
	];
	$reply_markup = $platform->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);	
	
	// recupero il contenuto inviato dall'utente
	$content = $platform->getWebhookUpdates();
	$update = json_decode ( $content, true );
	
	// se la richiesta è null interrompo lo script
	if (! $update) {
		exit ();
	}
	
// 	$telegram->addCommand ( Recsysbot\Commands\HelpCommand::class );
// 	$telegram->addCommand ( Recsysbot\Commands\InfoCommand::class );
// 	$telegram->addCommand ( Recsysbot\Commands\ResetCommand::class );
// 	$telegram->addCommand ( Recsysbot\Commands\StartCommand::class );

	//Configurazione testo benvenuto, pulsante inizia e altre caratteristiche del bot
// 	setBotProfile();
	
// 	$message = $update["entry"][0]["messaging"][0];
// 	$messageId = $message["message"]["mid"];
// 	$chatId = $message["sender"]["id"];
// 	$userInfo = json_decode(file_get_contents("https://graph.facebook.com/v2.6/" . $chatId . "?access_token=" . $config['token']), true);
// 	$firstname = $userInfo["first_name"];
// 	$lastname = $userInfo["last_name"];
// 	$username = ""; //Non viene restituito dalla chiamata
// 	$date = $update["entry"][0]["time"];
// 	$text = $message["message"]["text"];
// 	$globalDate = gmdate("Y-m-d\TH:i:s\Z", $date);
// 	$postbackPayload = $message["postback"]["payload"];
	
// 	// assegno alle seguenti variabili il contenuto ricevuto da Telegram
// 	$message = isset ( $update ['message'] ) ? $update ['message'] : "";
// 	$messageId = isset ( $message ['message_id'] ) ? $message ['message_id'] : "";
// 	$chatId = isset ( $message ['chat'] ['id'] ) ? $message ['chat'] ['id'] : "";
// 	$firstname = isset ( $message ['chat'] ['first_name'] ) ? $message ['chat'] ['first_name'] : "";
// 	$lastname = isset ( $message ['chat'] ['last_name'] ) ? $message ['chat'] ['last_name'] : "";
// 	$username = isset ( $message ['chat'] ['username'] ) ? $message ['chat'] ['username'] : "";
// 	$date = isset ( $message ['date'] ) ? $message ['date'] : "";
// 	$text = isset ( $message ['text'] ) ? $message ['text'] : "";
// 	$globalDate = gmdate ( "Y-m-d\TH:i:s\Z", $date );

	$messageInfo = $platform->getMessageInfo($update);
	
	// Stampa nel log
	file_put_contents("php://stderr", "messageId: " . $messageInfo['messageId'] . "\nchatId: " . $messageInfo['chatId'] . "\nfirstname: " . $messageInfo['firstname'] . "\nlastname: " . $messageInfo['lastname'] . "\ndate: " . $messageInfo['date'] . "\ntext: " . $messageInfo['text'] . "\nglobalDate: " . $messageInfo['globalDate'] . PHP_EOL);
	
	// gestisci edited_message, per evitare blocco del bot
// 	if ($chatId == "") {
// 		$message = isset ( $update ['edited_message'] ) ? $update ['edited_message'] : "";
// 		$messageId = isset ( $message ['message_id'] ) ? $message ['message_id'] : ";
// 		$chatId = isset ( $message ['chat'] ['id'] ) ? $message ['chat'] ['id'] : "";
// 		$firstname = isset ( $message ['chat'] ['first_name'] ) ? $message ['chat'] ['first_name'] : "";
// 		$lastname = isset ( $message ['chat'] ['last_name'] ) ? $message ['chat'] ['last_name'] : "";
// 		$username = isset ( $message ['chat'] ['username'] ) ? $message ['chat'] ['username'] : "";
// 		$date = isset ( $message ['date'] ) ? $message ['date'] : "";
// 		$text = isset ( $message ['text'] ) ? $message ['text'] : "";
// 		$globalDate = gmdate ( "Y-m-d\TH:i:s\Z", $date );
// 		file_put_contents ( "php://stderr", "edited_message execute.php - chatId: " . $chatId . " - update: " . print_r ( $update, true ) . PHP_EOL );
// 	}
	if ($messageInfo['chatId'] == "") {
		exit();
	}
	$botName = checkUserAndBotNameFunction($messageInfo['chatId'], 
			$messageInfo['firstname'], $messageInfo['lastname'], 
			$messageInfo['username'], $messageInfo['date']);
	
	// pulisco il messaggio ricevuto
	$messageInfo['text'] = trim ($messageInfo['text']);
	$messageInfo['text'] = strtoLower ($messageInfo['text']);	

/***************
DEBUG
***************/
if ($messageInfo['text'] == "sayhi") {
  sayHi();
  return;
}
/***************
DEBUG
***************/
	
	try {
		$response = "";
		// gestisco il tipo di messaggio: testo
		if (isset ( $messageInfo['text'] )) { //Telegram
// 		if ( !isset ($message ['message']['attachments'][0]) ) { //Messenger
			
			if ($messageInfo['text'] == "/start") { //Telegram
// 			if ($postbackPayload == $getStartedPayload) { //Messenger
// 				$username = $firstname;
// 				//Integer.parseInt() bug
// 				putUserDetail (substr($chatId, 0, 9), $firstname, $lastname, $username); //substr perchè su messenger è troppo lungo
				putUserDetail($messageInfo['chatId'], $messageInfo['firstname'],
						$messageInfo['lastname'], $messageInfo['username']);
			}
			messageDispatcher($platform, $messageInfo['chatId'], $messageInfo['messageId'], $messageInfo['date'], $messageInfo['text'], $messageInfo['firstname'], $botName);
			file_put_contents("php://stderr", "Richiedo l'user detail dell'id " . $messageInfo['chatId']);
			$userDetail = getUserDetail($messageInfo['chatId']);
// 			$userDetail = getUserDetail(substr($chatId, 0, 9)); //substr perchè su messenger è troppo lungo
			file_put_contents("php://stderr", "User Detail ricevuto: " . 
					"\nid: " . $userDetail['id'] . 
					"\nusername: " . $userDetail['username'] . 
					"\nfirstname: " . $userDetail['firstname'] . 
					"\nlastname: " . $userDetail['lastname'] .
					"\ntext: " . $messageInfo['text']);
// 			sendMessage("id: " . $userDetail['id'] .
// 					"\nusername: " . $userDetail['username'] .
// 					"\nfirstname: " . $userDetail['firstname'] .
// 					"\nlastname: " . $userDetail['lastname'], $chatId);
		} else {
			$response = "I'm sorry. I received a message, but i can't unswer";
			$platform->sendMessage($messageInfo['chatId'], $response);
// 			sendMessage("I'm sorry. I received a message, but i can't unswer", $chatId);
		}
	} catch ( Exception $e ) {
		file_put_contents ( "php://stderr", "Exception chatId:" . $messageInfo['chatId'] . " - firstname:" . $messageInfo['firstname'] . " - botName" . $botName . " - Date:" . $messageInfo['globalDate'] . " - text:" . $messageInfo['text'] . PHP_EOL );
		file_put_contents ( "php://stderr", "Exception chatId:" . $messageInfo['chatId'] . " Caught exception: " . print_r ( $e->getTraceAsString (), true ) . PHP_EOL );
	}
	
	// Stampa nel log
	file_put_contents("php://stderr", $response);
