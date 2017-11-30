<?php
	
	/**
	 * @author Francesco Baccaro
	 */
	use GuzzleHttp\Client;
	
	require 'vendor/autoload.php';
	$config = require_once '/app/recsysbot/config/movierecsysbot-config.php';
	
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
	$platform = new Telegram();
	
	// recupero il contenuto inviato dall'utente
	$content = $platform->getWebhookUpdates();
	$update = json_decode ( $content, true );
	
	// se la richiesta è null interrompo lo script
	if (! $update) {
		exit ();
	}
	
	$platform->addCommand ( Recsysbot\Commands\HelpCommand::class );
	$platform->addCommand ( Recsysbot\Commands\InfoCommand::class );
	$platform->addCommand ( Recsysbot\Commands\ResetCommand::class );
	$platform->addCommand ( Recsysbot\Commands\StartCommand::class );

	$messageInfo = $platform->getMessageInfo($update);
	
	// Stampa nel log
	file_put_contents("php://stderr", "messageId: " . $messageInfo['messageId'] . "\nchatId: " . $messageInfo['chatId'] . "\nfirstname: " . $messageInfo['firstname'] . "\nlastname: " . $messageInfo['lastname'] . "\ndate: " . $messageInfo['date'] . "\ntext: " . $messageInfo['text'] . "\nglobalDate: " . $messageInfo['globalDate'] . PHP_EOL);
	
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
DEBUG: SERVER ATTIVO @193.204.187.192:8090 ?
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

		if (isset ( $messageInfo['text'] )) {
			if ($messageInfo['text'] == "/start") {putUserDetail($messageInfo['chatId'], $messageInfo['firstname'],
						$messageInfo['lastname'], $messageInfo['username']);
			}
			
			// $reply è un array contenente 'action', 'text', 'photo', 'keyboard'
			$reply = messageDispatcher($platform, $messageInfo['chatId'], $messageInfo['messageId'], $messageInfo['date'], $messageInfo['text'], $messageInfo['firstname'], $botName);
			file_put_contents("php://stderr", "Richiedo l'user detail dell'id " . $messageInfo['chatId']);
			$userDetail = getUserDetail($messageInfo['chatId']);
			file_put_contents("php://stderr", "User Detail ricevuto: " . 
					"\nid: " . $userDetail['id'] . 
					"\nusername: " . $userDetail['username'] . 
					"\nfirstname: " . $userDetail['firstname'] . 
					"\nlastname: " . $userDetail['lastname'] .
					"\ntext: " . $messageInfo['text']);
		} else {
			$response = "I'm sorry. I received a message, but i can't unswer";
			$platform->sendMessage($messageInfo['chatId'], $response);
		}
	} catch ( Exception $e ) {
		file_put_contents ( "php://stderr", "Exception chatId:" . $messageInfo['chatId'] . " - firstname:" . $messageInfo['firstname'] . " - botName" . $botName . " - Date:" . $messageInfo['globalDate'] . " - text:" . $messageInfo['text'] . PHP_EOL );
		file_put_contents ( "php://stderr", "Exception chatId:" . $messageInfo['chatId'] . " Caught exception: " . print_r ( $e->getTraceAsString (), true ) . PHP_EOL );
	}