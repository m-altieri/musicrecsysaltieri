<?php

function startProfileAcquisitioReply($telegram, $chatId){

	$keyboard = startProfileAcquisitionKeyboard();

   $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

   $text = "Let me to recommend a movie.\nPlease, tell me something about you";

   $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
   $telegram->sendMessage(['chat_id' => $chatId, 
                           'text' => $text,
                           'reply_markup' => $reply_markup]);
}