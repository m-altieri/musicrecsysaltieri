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

      $keyboard = $this->getUserStartProfileAcquisitionKeyboard($chatId);

      $reply_markup = $this->getTelegram()->replyKeyboardMarkup([
        'keyboard' => $keyboard,
        'resize_keyboard' => true,
        'one_time_keyboard' => false
        ]);

        //$reply_markup = replyKeyboardMarkup($keyboard, true, true);
        //$reply_markup = $this->replyKeyboardMarkup($keyboard, true, true);
        $text = "Hi ".$firstname."!\nLet me to recommend a movie.\nPlease, tell me something about you";
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage([
            'text' => $text, 
            'reply_markup' => $reply_markup
            ]);
        
    }

    private function getUserStartProfileAcquisitionKeyboard($chatId){
      $numberRatedMovies = getNumberRatedMovies($chatId);

      if ($numberRatedMovies >= 3)
         $keyboard = startProfileAcquisitionKeyboard();
      else
         $keyboard = [
             ['🔵 Choose some movies']
         ];


      return $keyboard;
   }
}


