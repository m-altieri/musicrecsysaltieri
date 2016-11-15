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
    protected $description = "Reset all movie or property rated";

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
         }
         elseif (strpos($resetArguments, 'movies') !== false) {
            $text = $this->resetAllMovieRated($chatId, $firstname);
         }
         elseif (strpos($resetArguments, 'all') !== false) {
             $text = $this->resetAllMovieAndPropertyRated($chatId, $firstname);
         }
         else{
            $this->replyWithChatAction(['action' => Actions::TYPING]);
            $this->replyWithMessage(['text' => '😕 Reset format is incorrect', 'reply_markup' => $reply_markup]);
            $text = "You can use the following format:\n- /reset movies\n- /reset properties\n- /reset all";
         }

        $keyboard = startProfileAcquisitionKeyboard();

        $reply_markup = $this->getTelegram()->replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
            ]);

        //$reply_markup = replyKeyboardMarkup($keyboard, true, true);
        //$reply_markup = $this->replyKeyboardMarkup($keyboard, true, true);

        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);
        
    }

   private function resetAllPropertyRated($chatId, $firstname){

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

      $data = deleteAllMovieRated($chatId);          
      $newNumberOfRatedMovies = $data;

      if ($newNumberOfRatedMovies == 0 ) {
         $text = "All right ".$firstname.", i reset all movies that you have evaluated";
      } else{
         $text = "Sorry ".$firstname.", there was a problem to reset all movies that you have evaluated";
      }

      return $text;

   }


   private function resetAllMovieAndPropertyRated($chatId, $firstname){

      $dataProperty = deleteAllPropertyRated($chatId);
      $dataMovie = deleteAllMovieRated($chatId);           
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
