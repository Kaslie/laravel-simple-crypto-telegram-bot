<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Api as TelegramAPI;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\TelegramResponse as Response;
use Ixudra\Curl\Facades\Curl;



class TelegramController extends Controller
{
    //
    public function initialize(){
        $api = new TelegramAPI();
        $api->addCommand(\Telegram\Bot\Commands\HelpCommand::class);
        $api->addCommand(\App\Commands\StartCommand::class);
//        while(true){
            $updates = $api->commandsHandler();
//            if(empty($updates)){
//                continue;
//            }
            foreach ($updates as $update){
                $response = Curl::to('https://bittrex.com/api/v1.1/public/getmarketsummary?market=btc-rcn')->asJson()->get();
                $last_price = (string)(number_format($response->result[0]->Last,8,'.',','));
                $api->sendMessage([
                    'chat_id'=> $update->getMessage()->getFrom()->getId(),
                    'text'=>"Here is the coin u request $last_price",
                ]);
            }
//        }
    }
    public function webHook(){
        $api = new TelegramAPI();
        $resp =  $api->setWebhook([
            'url'=> "https://72aa3aca.ngrok.io/bot/webhook"
        ]);
        return $resp->getDecodedBody();
    }
    public function getWebHook(Request $request){
        $api = new TelegramAPI();
        $updates = $api->getWebhookUpdates();

        echo "TestWeb";
        foreach ($updates as $update){
            echo "TestUpdates";
            $response = Curl::to('https://bittrex.com/api/v1.1/public/getmarketsummary?market=btc-rcn')->asJson()->get();
            $last_price = (string)(number_format($response->result[0]->Last,8,'.',','));
            $api->sendMessage([
                'chat_id'=> $update->getMessage()->getFrom()->getId(),
                'text'=>"Here is the coin u request $last_price",
            ]);
        }
        return 'Ok';
    }
    public function getUpdates(){
        $api = new TelegramAPI();
        $resp = $api->getUpdates();
        dd($resp);
    }
    public function getBotInfo(){
        $api = new TelegramAPI();
        $testing = $api->getMe();
        echo "Api: $testing";
    }
    public function getBot(){
        $response = \Telegram::getMe();
        echo "$response";
    }
}
