<?php

include('vendor/autoload.php');
include('TelegramBot.php');
include('Weather.php');

$telegramApi = new TelegramBot();
$weatherApi = new Weather();
while(true) {

    sleep(2);
    $update = $telegramApi->getUpdates();



        if (isset($update[0]->message->text)) {
            try {
                $res = $update[0]->message->text;
               if(strpos($res, '@Valera123456789_bot') !== false) {
                  $city = str_replace('@Valera123456789_bot', '', $res);
                   $result = $weatherApi->getWeather($city);
                   $telegramApi->sendMessage(json_encode($result->weather[0]->main), $update[0]->message->chat->id);
               }
            } catch (Exception $e) {
                $telegramApi->sendMessage('Пожалуйста, отправь правильный город', $update[0]->message->chat->id);
            }
        }

}

