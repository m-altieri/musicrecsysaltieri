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

    public function handle($arguments)
    {
        $chatId = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();
        file_put_contents("php://stderr", '/reset - chatId:'.$chatId.PHP_EOL);

        $argument_array = explode (' ', $arguments);
        foreach ($argument_array as $key => $value) {
             file_put_contents("php://stderr", 'Argument['. $key. ']: '. $value.PHP_EOL);
         }




        $oldNumberOfRatedProperties = getNumberRatedProperties($chatId);
        $result = deleteAllPropertyRated($chatId);
      
        $newNumberOfRatedProperties = $result;

       if ($newNumberOfRatedProperties < $oldNumberOfRatedProperties) {
          $text = "All right ".$firstname.", i reset all properties that you have evaluated";
       } else{
          $text = "Sorry ".$firstname.", there was a problem to reset all properties that you have evaluated";
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
}
?>