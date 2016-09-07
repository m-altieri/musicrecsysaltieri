<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$commands_path = __DIR__ . '/Commands/';


$API_KEY = '297809022:AAHaM0c6-mE2PvrFlEnV7JeHnKXor7JCSgM';
$BOT_NAME = 'MovieRecSysBot';
try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($API_KEY, $BOT_NAME);
	$telegram->addCommandsPath($commands_path);
    // Handle telegram webhook request
	$telegram->handle();
	} catch (Longman\TelegramBot\Exception\TelegramException $e) {
	    // Silence is golden!
	    echo $e;
	    // Log telegram errors
	    //Longman\TelegramBot\TelegramLog::error($e);
	} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
	    // Silence is golden!
	    // Uncomment this to catch log initilization errors
	    echo $e;
}