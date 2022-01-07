@extends('layouts.layout')
@section('content')
    <div class="contents">
        <div class="create-area d-flex">
            <a class="create-page-link" href="/messages/new">メッセージを追加する</a>
            <div class="create-csv-import">
                <p class="csv-title">csvで追加する</p>
                <form method="post" action="{{route('message.importCSV')}}" enctype="multipart/form-data">
                    @csrf
                    <input class="csv-import-btn no-border" type="file" name="csvfile">
                    <button id="test-button">送信</button>
                </form>
            </div>
        </div>
        <div class="index-area">
            <h1>メッセージ一覧</h1>
            <div class="index-contents">
                <table class="index-table">
                    <thead>
                        <tr>
                            <th class="id-th">id</th>
                            <th>日付</th>
                            <th>顧客</th>
                            <th>状態</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                        <tr>
                            <td class="id-th"><a href="/messages/{{$message->id}}">{{$message->id}}</a></td>
                            <td>{{$message->date}}</td>
                            <td>{{$message->client->name}}</td>
                            <td>
                                <?php
                                    if($message->status == 1){
                                        echo "済";
                                    }else{
                                        echo "未";
                                    }
                                ?>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
