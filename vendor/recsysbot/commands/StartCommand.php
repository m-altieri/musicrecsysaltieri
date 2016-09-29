<?php 

namespace Vendor\Recsysbot\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * @author Francesco Baccaro
 */
class StartCommand extends Command
{
    protected $name = "start";
    protected $description = "RecSysBot Menu";

    public function handle($arguments)
    {

        //$telegram->sendMessage(['chat_id' => $chatId, 'text' => 'start...']);
        $keyboard = [
            ['Yes','No'],
            ['/info']
        ];

      $reply_markup = $this->getTelegram()->replyKeyboardMarkup([
        'keyboard' => $keyboard,
        'resize_keyboard' => true,
        'one_time_keyboard' => false
        ]);

        //$reply_markup = replyKeyboardMarkup($keyboard, true, true);
        //$reply_markup = $this->replyKeyboardMarkup($keyboard, true, true);

        $text = "I can recommend a movie?";

        $this->replyWithMessage([
            'text' => $text, 
            'reply_markup' => $reply_markup
            ]);
        $this->replyWithChatAction(['action' => Actions::TYPING]);

    }
}
?>