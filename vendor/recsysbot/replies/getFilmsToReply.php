<?php 

function getFilmsToReply($telegram, $chatId, $propertyType, $msg ){
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
   $text = "Well ;)";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 

   $name = substr($msg,5);
   //$name = substr($msg,4);
   $propertyName = str_replace(' ', '_', $name); // Replaces all spaces with underscore.

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $text = "Let me see if i can recommend a movie about ".$name;
   //$text = "Let me see if i can recommend a movie about ".$name." minutes of runtime";
   $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]);            
   

   $keyboard = getKeyboardFilms($chatId, $propertyName, $propertyType);
   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);

   //if ($keyboard != null) {$reply_markup = $telegram-->inlineKeyboardMarkup(['inline_keyboard' => $keyboard]);          
   
   if ($keyboard != null) {
      $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard,
                                                     'resize_keyboard' => true,
                                                     'one_time_keyboard' => false
                                                      ]);
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
      $text = "i can recommend these films: ";
      $telegram->sendMessage(['chat_id' => $chatId, 
                              'text' => $text,
                              'reply_markup' => $reply_markup]);
   } else {
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
      $text = "Unfortunately, i don't find any movie to recommender";
      //$text = "Amongst the ".$NameRuntime." minutes, i can recommend these films: ";
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 
   } 
}