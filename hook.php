<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$commands_path = __DIR__ . '/commands/';
$telegram->addCommandsPath($commands_path);

$API_KEY = '297809022:AAHaM0c6-mE2PvrFlEnV7JeHnKXor7JCSgM';
$BOT_NAME = 'MovieRecSysBot';
try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($API_KEY, $BOT_NAME);

    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e;
}