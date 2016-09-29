<?php

require 'vendor/autoload.php';
require 'vendor/recsysbot/replies/menuReply.php';
require 'vendor/recsysbot/replies/fullMenuReply.php';



use Telegram\Bot\Api;
$telegram = new Api('297809022:AAHaM0c6-mE2PvrFlEnV7JeHnKXor7JCSgM');



// recupero il contenuto inviato da Telegram
$content = $telegram->getWebhookUpdates();

// converto il contenuto da JSON ad array PHP
//$content = file_get_contents("php://input");
$update = json_decode($content, true);

// se la richiesta è null interrompo lo script
if(!$update)
{
  exit;
}

$telegram->addCommand(Vendor\Recsysbot\Commands\HelpCommand::class);
$telegram->addCommand(Vendor\Recsysbot\Commands\InfoCommand::class);
$telegram->addCommand(Vendor\Recsysbot\Commands\RatingCommand::class);
$telegram->addCommand(Vendor\Recsysbot\Commands\StartCommand::class);




// assegno alle seguenti variabili il contenuto ricevuto da Telegram
$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

// pulisco il messaggio ricevuto togliendo eventuali spazi prima e dopo il testo
$text = trim($text);
// converto tutti i caratteri alfanumerici del messaggio in minuscolo
$text = strtolower($text);

switch ($text) {
   case "/start": case "/help": case "/info":            
      $telegram->commandsHandler(true);
      break;
   case "menu": case "/yes": case "yes": case "<-":         
      menuReply($telegram, $chatId);
      break;
   case "->":   
      fullMenuReply($telegram, $chatId);
      break;
   default:
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);
      break;
}





