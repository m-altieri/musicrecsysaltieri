<?php 

namespace Vendor\Recsysbot\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * @author Francesco Baccaro
 */
class InfoCommand extends Command
{
    protected $name = "info";
    protected $description = "BOT information";

    public function handle($arguments)
    {
        //$telegram->sendMessage(['chat_id' => $chatId, 'text' => 'info...']);
        $text = <<<BOT
MovieRecSysBot (Alpha)
Recommender System Bot

A recommender system, built on 
a bot, for movie recommendation 
in according to user profile

Developer: Francesco Baccaro
eMail: baccaro.f@gmail.com
BOT;

        $this->replyWithMessage(['text' => $text]);
        $this->triggerCommand('start');
   }
}
?>