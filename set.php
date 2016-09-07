<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$API_KEY = '297809022:AAHaM0c6-mE2PvrFlEnV7JeHnKXor7JCSgM';
$BOT_NAME = 'MovieRecSysBot';
$hook_url = 'https://movierecsysbot.herokuapp.com/hook.php';
try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($API_KEY, $BOT_NAME);

    // Set webhook
    $result = $telegram->setWebHook($hook_url);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e;
}