<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Client;
use App\Models\Carpenter;
use App\Models\Template;
use App\Http\Requests\MessageRequest;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class MessageController extends Controller
{

    /**
     * MessageController constructor.
     * @param Message $item
     */
    //

    public function index(){
        $messages = Message::all();
        return view('home')->with(['messages'=>$messages]);
    }

    public function show(Message $message){
        $list = $this->getList();
        $selectedclient = $message->client;
        $selectedcarpenters = [];
        foreach ($message->carpenters as $carpenter) {
            array_push($selectedcarpenters,$carpenter);
        }
        return view('message')->with(
            [
                'message'=>$message,
                'clients'=>$list["clients"],
                'selectedclient'=>$selectedclient,
                'carpenters'=>$list["carpenters"],
                'selectedcarpenters'=>$selectedcarpenters,
                'templates'=>$list["templates"]
            ]
        );
    }

    public function new(){
        $list = $this->getList();
        return view('newmessage')->with(
            [
                'clients'=>$list["clients"],
                'carpenters'=>$list["carpenters"],
                'templates'=>$list["templates"]
            ]
        );
    }

    public function create(MessageRequest $request){
        $message = new Message();
        $this->createHelper($request,$message);
        return redirect('/home');
    }

    public function update(MessageRequest $request, Message $message){
        $this->createHelper($request,$message);
        return redirect('/home');
    }

    public function destroy(Message $message){
        $message->delete();
        return redirect('/home');
    }

    public function importcsv(MessageRequest $request){
        $file_path = $request->file('csvfile')->path();
        $file = new \SplFileObject($file_path);
        $this->scanCSV($file);
        return redirect('/home');
    }

    public function sendLine(){
        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient(config('services.line.channel_token'));
        $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);
        // LINEユーザーID指定
        $userId = "LINEユーザーID";
        // メッセージ設定
        $message = "こんにちは！";
        // メッセージ送信
        $textMessageBuilder = new TextMessageBuilder($message);
        $response    = $bot->pushMessage($userId, $textMessageBuilder);
    }

    private function getList(){
        $clients = Client::all();
        $carpenters = Carpenter::all();
        $templates = Template::all();
        $response = array('clients'=>$clients, 'carpenters'=>$carpenters, 'templates'=>$templates);
        return $response;
    }

    private function createHelper(MessageRequest $request, Message $message): void{
        $message->client_id = $request->client;
        $message->date = $request->date;
        $message->message = $request->message;
        $message->status = 0;
        $message->save();
        $lastmessage = Message::latest()->first();
        $lastmessage->carpenters()->attach($request->carpenters);
        $lastmessage->save();
    }

    private function scanCSV(SplFileObject $file): void{
        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );
        foreach($file as $line)
        {
            $i = 3;
            $carpenters = [];
            while($i < 13){
                array_push($carpenters,$line[$i]);
                $i += 1;
            }
            $carpenters = array_diff($carpenters, array(0));
            $data = [
                'client_id'=> (int)$line[0],
                'date'=>date('Y-m-d', strtotime($line[1])),
                'message'=> $line[2],
                'carpenters'=>$carpenters,
            ];
            $this->createHelper($data);
        }
    }

    private function createHelperCSV( $data ): void{
        $message = new Message();
        $message->client_id = $data['client_id'];
        $message->date = $data['date'];
        $message->message = $data['message'];
        $message->status = 0;
        $message->save();
        $lastmessage = Message::latest()->first();
        $lastmessage->carpenters()->attach($data['carpenters']);
        $lastmessage->save();
    }
}
