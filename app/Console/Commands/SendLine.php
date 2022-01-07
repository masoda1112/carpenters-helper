<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Client;
use App\Models\Message;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class SendLine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:line';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '毎朝9時にlineを送信';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient(config('services.line.channel_token'));
        $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);

        // 日付が今日のメッセージを取得
        $today = date("Y-m-d");
        $messages = Message::where('date', $today)->get();
        foreach($messages as $message){
            $userId = $message->client->line_id;
            $lineMessage = new TextMessageBuilder($message->message);
            $response = $bot->pushMessage($userId, $lineMessage);
            foreach($message->carpenters as $carpenter){
                $lineImgMessage = new ImageMessageBuilder(secure_url($carpenter->img),secure_url($carpenter->img));
                $messageBody = $carpenter->role."の".$carpenter->name."です。".$carpenter->profile;
                $lineCarpenterMessage = new TextMessageBuilder($messageBody);
                $response = $bot->pushMessage($userId, $lineCarpenterMessage);
                $response = $bot->pushMessage($userId, $lineImgMessage);
            }
            $message->status = 1;
            $message->save();
        }
        $tendaysAgo = date('Y-m-d', strtotime('-10 day'));
        $oldMessages = Message::where('date', $tendaysAgo)->get();
        foreach($oldMessages as $message){
            $message->delete();
        }
    }
}
