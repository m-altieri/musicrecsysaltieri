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
    protected $description = "RecSysBot Menu";

    public function handle($arguments)
    {

        //$telegram->sendMessage(['chat_id' => $chatId, 'text' => 'start...']);
        $keyboard = [
            ['🔴 I want to choose some movie properties'],
            ['🔵 I want to choose some movies']
        ];

      $reply_markup = $this->getTelegram()->replyKeyboardMarkup([
        'keyboard' => $keyboard,
        'resize_keyboard' => true,
        'one_time_keyboard' => false
        ]);

        //$reply_markup = replyKeyboardMarkup($keyboard, true, true);
        //$reply_markup = $this->replyKeyboardMarkup($keyboard, true, true);

        $text = "Let me to recommend a movie.\nPlease, tell me something about you";
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage([
            'text' => $text, 
            'reply_markup' => $reply_markup
            ]);
        
    }
}
?>