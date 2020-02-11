<?php
require_once('./vendor/autoload.php');

use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token=
'jTgpKfXc44rB705Y4QxNr3KWDYyAJ2N56bLDWdOYOutT0drgUVafPpa5o/HGakmm4m2M6CQ35pZ8QcHBFYycBqNDgbW0AvAF5yrW7moUhEh79YmcxTkH1Xs8QSNsZgz/yJgL4yDBK7gcC01HdrVjYwdB04t89/1O/w1cDnyilFU=';

$channel_secret='f474c54be520197ae79d9ce4b7d14ea2';

//รับ message จาก line api
$content=file_get_contents('php://input');
$events=json_decode($content,true);

if(!is_null($events['events'])){
    foreach($events['events']as $event){
        if($event['type']=='message'){
            switch($event['message']['type']){
                case'text':

                    $replyToken=$event['replyToken'];

                    $respMessage='Hello , you message is '.$event['message']['text'];

                    $httpClient=newCurlHTTPClient($channel_token);
                    $bot=newLINEBot($httpClient, array('channelSecret'=>$channel_secret));
                    $textMessageBuilder=newTextMessageBuilder($respMessage);
                    $response=$bot->replyMessage($replyToken,$textMessageBuilder);
                break;
            }
        }
    }
    
}

echo 'ok';

