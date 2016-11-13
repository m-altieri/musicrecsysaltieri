<?php

namespace Vendor\Recsysbot\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * @author Francesco Baccaro
 */
class HelpCommand extends Command
{
    protected $name = "help"; //this is the string the user write
    protected $description = "Help - Info & commands";

    public function handle($arguments)
    {
        // handled when you replace `send<Method>` with `replyWith` and use all their parameters except chat_id.
        $text = "/help , Here you find the commands available";

        $this->replyWithMessage([
            'text' => $text
            ]);
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        // This will prepare a list of available commands and send the user.
        // First, Get an array of all registered commands
        // They'll be in 'command-name' => 'Command Handler Class' format.
        $commands = $this->getTelegram()->getCommands();
        // Build the list
        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }
        $this->replyWithMessage([
            'text' => $response
            ]);

        // Trigger another command dynamically from within this command
        // When you want to chain multiple commands within one or process the request further.
        // The method supports second parameter arguments which you can optionally pass, By default
        // it'll pass the same arguments that are received for this command originally.
        //$this->triggerCommand('subscribe');
    }
}


?>
