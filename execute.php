<?php

/**
 * @author Francesco Baccaro
 */
use GuzzleHttp\Client;
use Telegram\Bot\Api;

require 'vendor/autoload.php';
$config = require __DIR__ . '/recsysbot/config/movierecsysbot-config.php';

//richiedo tutti le funzioni, i messaggi di risposta e i servizi che mi servono per l'esecuzione
foreach(glob("recsysbot/classes/*.php") as $file){require $file;}
foreach(glob("recsysbot/functions/*.php") as $file){require $file;}
foreach(glob("recsysbot/keyboards/*.php") as $file){require $file;}
foreach(glob("recsysbot/messages/*.php") as $file){require $file;}
foreach(glob("recsysbot/replies/*.php") as $file){require $file;}
foreach(glob("recsysbot/restService/*.php") as $file){require $file;}

//This is suggested from Guzzle
date_default_timezone_set($config['timezone']);
$token = $config['token'];

$telegram = new Api($token);

// recupero il contenuto inviato da Telegram
//$content = file_get_contents("php://input");
$content = $telegram->getWebhookUpdates();

// converto il contenuto da JSON ad array PHP
$update = json_decode($content, true);

// se la richiesta è null interrompo lo script
if(!$update)
{
  exit;
}

$telegram->addCommand(Recsysbot\Commands\HelpCommand::class);
$telegram->addCommand(Recsysbot\Commands\InfoCommand::class);
$telegram->addCommand(Recsysbot\Commands\ResetCommand::class);
$telegram->addCommand(Recsysbot\Commands\StartCommand::class);

// assegno alle seguenti variabili il contenuto ricevuto da Telegram
$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

file_put_contents("php://stderr", "execute.php - chatId: ".$chatId." - update: ".print_r($update, true).PHP_EOL);
// Stampa nel log
$globalDate = gmdate("Y-m-d\TH:i:s\Z", $date);
file_put_contents("php://stderr", "Date:".$globalDate." - chatId:".$chatId." - firstname:".$firstname." - text:".$text.PHP_EOL);
// pulisco il messaggio ricevuto togliendo eventuali spazi prima e dopo il testo
$text = trim($text);
// converto tutti i caratteri alfanumerici del messaggio in minuscolo
$text = strtolower($text);
if (isset ($message['text'])){
   if (($text == "/start")) {
      putUserDetail($chatId, $firstname, $lastname, $username);
      switchText($telegram, $chatId, $messageId, $date, $text, $firstname);
      file_put_contents("php://stderr", "Switch text: /start".PHP_EOL);
   }
   else{
      switchText($telegram, $chatId, $messageId, $date, $text, $firstname);
      file_put_contents("php://stderr", "Switch text: ".$text.PHP_EOL);
   }

}
/*if (isset ($message['text'])){
   $numberRatedMovies = getNumberRatedMovies($chatId);
   $numberRatedProperties = getNumberRatedProperties($chatId); 
   if (($text == "/start")) {
      putUserDetail($chatId, $firstname, $lastname, $username);
      switchText($telegram, $chatId, $messageId, $date, $text, $firstname);
      file_put_contents("php://stderr", "text == start".PHP_EOL);
   } 
   elseif ( $text == "preferences" || 
            $text == "/help" || 
            $text == "/info" || 
            strpos($text, '🔴') !== false || 
            strpos($text, '🔵') !== false ||
            strpos($text, '👍') !== false || 
            strpos($text, '👎') !== false || 
            strpos($text, '💬') !== false ) {
      switchText($telegram, $chatId, $messageId, $date, $text, $firstname); 
      file_put_contents("php://stderr", "help || info || movies || properties".PHP_EOL);
   } 
   elseif ($numberRatedMovies >= 3 || $numberRatedProperties >= 3) {
      switchText($telegram, $chatId, $messageId, $date, $text, $firstname);
      file_put_contents("php://stderr", "numberRatedMovies >= 3 || numberRatedProperties >= 3".PHP_EOL);
   }
   else {
      $text = "preferences";
      switchText($telegram, $chatId, $messageId, $date, $text, $firstname);
      file_put_contents("php://stderr", "profile".PHP_EOL);
   }
}*/
elseif (isset ($message['audio'])){
   $response = "I'm sorry. I received an audio message";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response]);
}
elseif (isset ($message['document'])){
   $response = "I'm sorry. I received a message document, but i can't unswer";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response]);
}
elseif (isset ($message['photo'])){
   $response = "I'm sorry. I received a message photo, but i can't unswer";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response]);
}
elseif (isset ($message['sticker'])){
   $response = "I'm sorry. I received a sticker message, but i can't unswer";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response]);
}
elseif (isset ($message['video'])){
   $response = "I'm sorry. I received a video message, but i can't unswer";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response]);
}
elseif (isset ($message['voice'])){
   $response = "I'm sorry. I received a voice message, but i can't unswer";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response]);
}
elseif (isset ($message['contact'])){
   $response = "I'm sorry. I received a message contact, but i can't unswer";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response]);
}
elseif (isset ($message['location'])){
   $response = "I'm sorry. I received a location message, but i can't unswer";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response]);
}
elseif (isset ($message['venue'])){
   $response = "I'm sorry. I received a venue, but i can't unswer";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response]);
}
else{
   $response = "I'm sorry. I received a message, but i can't unswer";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response]);
}

