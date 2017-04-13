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

      if ($needNumberOfRatedProperties <= 0){
         $keyboard = userPropertyValueKeyboard();
         $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
         $text = "Hi ".$firstname." 😃\n";
         $text .= "\nI am now able to recommend you some movies 😃";
         $text .= "\nTap on \"🌐 Recommend Movies\" button, otherwise you can enrich your profile by providing further ratings 😉";
         
         $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]);      
      }
      else{
            $keyboard = startProfileAcquisitionKeyboard();
            $reply_markup = $this->getTelegram()->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
            $text = "Hi ".$firstname." 😃\n";
            $text .= "In this experiment you will receive some recommendations about MOVIES.
In the following, we will ask you some information about you and your preferences in the movie domain.
Next, you will receive a list of recommended movies and you will be asked to evaluate the goodness of the recommendations.
You can improve the recommendations by telling me what you like and what you dislike in the recommended movies.
You can also ask why a movie has been recommended by tapping the “Why?” button.
The whole experiment will take less than five minutes.";
            $text .= "\nI need at least 3 preferences for generating recommendations 😉";
            $this->replyWithMessage(['text' => $text, 'reply_markup' => $reply_markup]); 

            $text = "Let me recommend a movie \nPlease, tell me something about you \nor type your preference 🙂";
            $this->replyWithMessage(['text' => $text]); 
      }        
   }
}


