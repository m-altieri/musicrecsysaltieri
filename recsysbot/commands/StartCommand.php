<?php 

namespace Recsysbot\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * @author Francesco Baccaro
 */
class StartCommand extends Command
{
    protected $name = "start";
    protected $description = "Bot Start";

    public function handle($arguments)
    {

      $chatId = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();
      $firstname = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getFirstName();
      $lastname = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getLastName();
      $username = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getUserName();
      $date = $this->getTelegram()->getWebhookUpdates()->getMessage()->getdate();

      $this->replyWithChatAction(['action' => Actions::TYPING]);

      $numberRatedMovies = getNumberRatedMovies($chatId);
      $numberRatedProperties = getNumberRatedProperties($chatId);
      $needNumberOfRatedProperties = 3 - ($numberRatedProperties + $numberRatedMovies);

      if ($needNumberOfRatedProperties <= 0){ //Old user
         $userDetailComplete = checkUserDetailCompleteFunction($chatId);   
         $botName = checkUserAndBotNameFunction($chatId, $firstname, $lastname, $username, $date);

         switch ($botName) {
            case strcasecmp($botName, 'conf1testrecsysbot') == 0:
               $keyboard = conf1userPropertyValueKeyboard();
               $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
               $text = "Hi ".$firstname." 😃\n";
               $text .= "\n\nI am now able to recommend you some movies 😃";
               $text .= "\nTap on \"🌐 Recommend Movies\" button, otherwise you can enrich your profile by providing further ratings 😉";
               $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);  
               break;
            case strcasecmp($botName, 'conf2testrecsysbot') == 0:
               $keyboard = conf1userPropertyValueKeyboard();
               $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
               $text = "Hi ".$firstname." 😃\n";
               $text .= "\n\nI am now able to recommend you some movies 😃";
               $text .= "\nTap on \"🌐 Recommend Movies\" button, otherwise you can enrich your profile by providing further ratings 😉";
               $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);  
               break;
            case strcasecmp($botName, 'conf3testrecsysbot') == 0:                     
               $keyboard = conf3userPropertyValueKeyboard();
               $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
               $text = "Hi ".$firstname." 😃\n";
               $text .= "\n\nI am now able to recommend you some movies 😃";
               $text .= "\nTap on \"🌐 Recommend Movies\" button, otherwise you can enrich your profile by providing further ratings 😉";
               $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);  
               break; 
            case strcasecmp($botName, 'conf4testrecsysbot') == 0:                     
               $keyboard = conf4userPropertyValueKeyboard();
               $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
               $text = "Hi ".$firstname." 😃\n";
               $text .= "\n\nI am now able to recommend you some movies 😃";
               $text .= "\nTap on \"🌐 Recommend Movies\" button, otherwise you can enrich your profile by providing further ratings 😉";
               $text .= "\n(e.g., Pulp Fiction or Tom Cruise or Thriller) 🙂";
               $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);  
               break;                   
            default: //da sistemare per la full
               $keyboard = userPropertyValueKeyboard();
               $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
               $text = "Hi ".$firstname." 😃\n";
               $text .= "\n\nI am now able to recommend you some movies 😃";
               $text .= "\nTap on \"🌐 Recommend Movies\" button, otherwise you can enrich your profile by providing further ratings 😉";
               
               $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);  
               break;
         }            
      }
      else{ //new user
         $text = "Hi ".$firstname." 😃";

         $botName = checkUserAndBotNameFunction($chatId, $firstname, $lastname, $username, $date);
         switch ($botName) {
            case strcasecmp($botName, 'conf1testrecsysbot') == 0:
               $keyboard = conf1startProfileAcquisitionKeyboard();
               $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
               $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]); 

               $text = "I need at least 3 preferences for generating recommendations.";
               $this->replyWithMessage(['text' => $text]); 

               $text = "Let me recommend a movie.\nPlease, tell me something about you 🙂";
               $this->replyWithMessage(['text' => $text]); 
               break;
            case strcasecmp($botName, 'conf2testrecsysbot') == 0:
               $keyboard = conf1startProfileAcquisitionKeyboard();
               $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
               $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]); 

               $text = "I need at least 3 preferences for generating recommendations.";
               $this->replyWithMessage(['text' => $text]); 

               $text = "Let me recommend a movie.\nPlease, tell me something about you 🙂";
               $this->replyWithMessage(['text' => $text]); 
               break;
            case strcasecmp($botName, 'conf3testrecsysbot') == 0:
               $keyboard = conf3startProfileAcquisitionKeyboard();
               $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
               $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]); 

               $text = "I need at least 3 preferences for generating recommendations.";
               $this->replyWithMessage(['text' => $text]); 

               $text = "Let me recommend a movie.\nPlease, tell me something about you 🙂";
               $this->replyWithMessage(['text' => $text]); 
               break; 
            case strcasecmp($botName, 'conf4testrecsysbot') == 0:
               $keyboard = conf4startProfileAcquisitionKeyboard();
               $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
               $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]); 

               $text = "I need at least 3 preferences for generating recommendations.";
               $this->replyWithMessage(['text' => $text]); 

               $text = "Let me recommend a movie 😃\nPlease, type your preferences \n(e.g., Pulp Fiction or Tom Cruise or Thriller) 🙂";
               $this->replyWithMessage(['text' => $text]); 
               break;             
            default: //da gestire per la full
               $keyboard = startProfileAcquisitionKeyboard();
               $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
               $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]); 

               $text = "I need at least 3 preferences for generating recommendations.";
               $this->replyWithMessage(['text' => $text]); 

               $text = "Let me recommend a movie \nPlease, tell me something about you \nor type your preference 🙂";
               $this->replyWithMessage(['text' => $text]); 
               break;
            }


      }        
   }
}


