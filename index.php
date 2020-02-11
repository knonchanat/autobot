<?php
require_once('vendor/autoload.php');

use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token=
'p6KWu/pGSqlrCPg4fOH4g2wwgJF8R1yGX5K3OQZqxALaQ6qM0OKO
wam31edWZ8i+4m2M6CQ35pZ8QcHBFYycBqNDgbW0AvAF5yrW7moUhEi
ZwKKKRZgGEDBQv0acjZF1/9H3kA6nXKETFcoEaxsDagdB04t89/1O/w1cDnyilFU=';

$channel_secret='ed2d6c1cb35b36fdc865bd3b2fd63166';

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

