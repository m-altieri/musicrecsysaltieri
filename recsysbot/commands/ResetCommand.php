<?php 

namespace Recsysbot\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * @author Francesco Baccaro
 */
class ResetCommand extends Command
{
    protected $name = "reset";
    protected $description = "Reset all rated movie or property";

    public function handle($arguments){
        $chatId = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();
        $firstname = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getFirstName();
        //file_put_contents("php://stderr", '/reset - chatId:'.$chatId.PHP_EOL);

        $argumentArray = explode (' ', $arguments);
/*        foreach ($argumentArray as $key => $value) {
             file_put_contents("php://stderr", 'Argument['. $key. ']: '. $value.PHP_EOL);
         }*/

        $resetArguments = $argumentArray[0];
        $resetArguments = strtolower($resetArguments);
         if (strpos($resetArguments, 'properties') !== false) {
            $text = $this->resetAllPropertyRated($chatId, $firstname);

            $keyboard = startProfileAcquisitionKeyboard();
            $reply_markup = $this->getTelegram()->replyKeyboardMarkup(['keyboard' => $keyboard,  'resize_keyboard' => true, 'one_time_keyboard' => false]);

            $this->replyWithChatAction(['action' => Actions::TYPING]);
            $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);
            $this->triggerCommand('start');
         }
         elseif (strpos($resetArguments, 'movies') !== false) {
            $text = $this->resetAllMovieRated($chatId, $firstname);

            $keyboard = startProfileAcquisitionKeyboard();
            $reply_markup = $this->getTelegram()->replyKeyboardMarkup(['keyboard' => $keyboard,  'resize_keyboard' => true, 'one_time_keyboard' => false]);

            $this->replyWithChatAction(['action' => Actions::TYPING]);
            $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);
            $this->triggerCommand('start');
         }
         elseif (strpos($resetArguments, 'all') !== false) {
            $text = $this->resetAllMovieAndPropertyRated($chatId, $firstname);

            $keyboard = startProfileAcquisitionKeyboard();
            $reply_markup = $this->getTelegram()->replyKeyboardMarkup(['keyboard' => $keyboard,  'resize_keyboard' => true, 'one_time_keyboard' => false]);

            $this->replyWithChatAction(['action' => Actions::TYPING]);
            $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);
            $this->triggerCommand('start');
         }
         elseif (strpos($resetArguments, 'pagerank') !== false) {
            $text = $this->resetAllPagerankScores($chatId, $firstname);

            $keyboard = startProfileAcquisitionKeyboard();
            $reply_markup = $this->getTelegram()->replyKeyboardMarkup(['keyboard' => $keyboard,  'resize_keyboard' => true, 'one_time_keyboard' => false]);

            $this->replyWithChatAction(['action' => Actions::TYPING]);
            $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);
            $this->triggerCommand('start');
         }
         else{
            $this->replyWithChatAction(['action' => Actions::TYPING]);
            $this->replyWithMessage(['text' => '😕 Reset format is incorrect', 'reply_markup' => $reply_markup]);
            $text = "You can use the following format:\n- /reset movies\n- /reset properties\n- /reset pagerank\n- /reset all";

            $keyboard = startProfileAcquisitionKeyboard();

            $reply_markup = $this->getTelegram()->replyKeyboardMarkup(['keyboard' => $keyboard,  'resize_keyboard' => true, 'one_time_keyboard' => false]);

            $this->replyWithChatAction(['action' => Actions::TYPING]);
            $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);
         }



        //$reply_markup = replyKeyboardMarkup($keyboard, true, true);
        //$reply_markup = $this->replyKeyboardMarkup($keyboard, true, true);


        
    }

   private function resetAllPropertyRated($chatId, $firstname){

      deleteAllPagerankScores($chatId);
      $dataChat = deleteAllChatMessage($chatId); 
      $data = deleteAllPropertyRated($chatId);        
      $newNumberOfRatedProperties = $data;

      if ($newNumberOfRatedProperties == 0) {
         $text = "All right ".$firstname.", i reset all properties that you have evaluated";
      } else{
         $text = "Sorry ".$firstname.", there was a problem to reset all properties that you have evaluated";
      }
      return $text;
    }

   private function resetAllMovieRated($chatId, $firstname){

      deleteAllPagerankScores($chatId);
      $data = deleteAllMovieRated($chatId);          
      $newNumberOfRatedMovies = $data;

      if ($newNumberOfRatedMovies == 0 ) {
         $text = "All right ".$firstname.", i reset all movies that you have evaluated";
      } else{
         $text = "Sorry ".$firstname.", there was a problem to reset all movies that you have evaluated";
      }
      return $text;
   }

   private function resetAllPagerankScores($chatId, $firstname){

      deleteAllPagerankScores($chatId);
      $text = "All right ".$firstname.", i reset all pagerank scores saved";

      return $text;
   }


   private function resetAllMovieAndPropertyRated($chatId, $firstname){

      //Va finito di gestire l'azzeramento dei messaggi - forse solo il pagerank è da controllare
      deleteAllPagerankScores($chatId);  
      $dataProperty = deleteAllPropertyRated($chatId);
      $dataMovie = deleteAllMovieRated($chatId);
      $dataChat = deleteAllChatMessage($chatId);
             
      $newNumberOfRatedProperties = $dataProperty;
      $newNumberOfRatedMovies = $dataMovie;

      if ($newNumberOfRatedProperties + $newNumberOfRatedMovies == 0) {
         $text = "All right ".$firstname.", i reset all movies and properties that you have evaluated";
      } else{
         $text = "Sorry ".$firstname.", there was a problem to reset all movies and properties that you have evaluated";
      }
      return $text;

   }


}
