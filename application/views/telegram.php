<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use TelegramBot\TelegramBot;
$token='303724118:AAEM1zlVreJQXAxsqrHH95a-TulbHyscuQs';
$telegram = new TelegramBot($token);
// $input=$telegram->getWebhookUpdate();
$telegram->sendMessage([
    'chat_id' => '@subscribenaan',
    'text' => 'Hello world!'
]);

$img = curl_file_create('/home/naan/Pictures/join.png','image/png');
$telegram->sendPhoto([
    'chat_id' => '@subscribenaan', 
    'photo' => $img
]);


