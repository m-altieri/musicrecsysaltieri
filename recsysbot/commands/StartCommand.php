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

      $numberRatedMovies = getNumberRatedMovies($chatId);
      $numberRatedProperties = getNumberRatedProperties($chatId);

      
      $this->replyWithChatAction(['action' => Actions::TYPING]);

      if ($numberRatedMovies >= 3 || $numberRatedProperties >= 3) {

        $keyboard = userPropertyValueKeyboard();
        $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

         $text = "Hi ".$firstname." 😃\nLet me to recommend a movie.\nPlease, tell me something about you \nor type your preference 🙂";
         $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);              
      }
      else{

        $keyboard = startProfileAcquisitionKeyboard();
        $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

         $text = "Hi ".$firstname." 😃";
         $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]); 

         $text = "I need at least 3 preferences for generating recommendations.";
         $this->replyWithMessage(['text' => $text]); 

         $text = "Let me to recommend a movie.\nPlease, tell me something about you \nor type your preference 🙂";
         $this->replyWithMessage(['text' => $text]); 
      }        
   }
}


