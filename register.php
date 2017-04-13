<?php

// PARAMETRI DA MODIFICARE
$WEBHOOK_URL = 'https://movierecsysbot.herokuapp.com/execute.php';
$BOT_TOKEN = '297809022:AAHaM0c6-mE2PvrFlEnV7JeHnKXor7JCSgM';

// NON APPORTARE MODIFICHE NEL CODICE SEGUENTE
$API_URL = 'https://api.telegram.org/bot' . $BOT_TOKEN .'/';
$method = 'setWebhook';
$parameters = array('url' => $WEBHOOK_URL);
$url = $API_URL . $method. '?' . http_build_query($parameters);
$handle = curl_init($url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); //true
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 9); //5
curl_setopt($handle, CURLOPT_TIMEOUT, 99); //60
$result = curl_exec($handle);
print_r($result);
