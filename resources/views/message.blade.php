@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="top-area d-flex">
        <a class="create-page-link blue" href="/home">一覧へ戻る</a>
        <form method="post" action="{{route('message.destroy', $message)}}">
            @method('DELETE')
            @csrf
            <input class="delete red delete-btn" type="submit" value="メッセージを削除する">
        </form>
    </div>
    <div class="index-area">
        <h1>メッセージ：{{$message->id}}</h1>
        <div class="index-contents">
            <form method="post" action="{{route("message.update",$message)}}">
                @method('PATCH');
                @csrf
                <div class="input-item">
                    <p class="input-item-title">顧客</p>
                    <select name="client" size="1">
                        <option value="{{$selectedclient->id}}">{{$selectedclient->name}}</option>
                        @forelse($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="input-item">
                    <p class="input-item-title">日付</p>
                    <input name="date" type="date" value="{{$message->date}}">
                </div>
                <div class="input-item">
                    <p class="input-item-title">文章</p>
                    <div class="input-item-right">
                        <select id="templates-list">
                            <option hidden>定型文を選択する</option>
                            @forelse($templates as $template)
                            <option value="{{$template->body}}">{{$template->title}}</option>
                            @empty
                            @endforelse
                        </select>
                        <textarea id="sentence-input" name="message" list="templates">{{$message->message}}</textarea>
                    </div>
                </div>
                <div class="carpenter-list" id="carpenter-list">
                    @forelse($selectedcarpenters as $selectedcarpenter)
                    <div class="input-item carpenter-item">
                        <p class="input-item-title">職人</p>
                        <select name="carpenters[]" size="1">
                            <option value="{{$selectedcarpenter->id}}">{{$selectedcarpenter->name}}</option>
                            @forelse($carpenters as $carpenter)
                            <option value="{{$carpenter->id}}">{{$carpenter->name}}</option>
                            @empty
                            @endforelse
                        </select>
                        <p class="carpenter-item-deletebtn">削除</p>
                    </div>
                    @empty
                    @endforelse
                </div>
                <div class="add-carpenter-item input-item">
                    <p class="add-carpenter-left input-item-title"></p>
                    <p class="add-carpenter" id="add-carpenter">＋職人を追加する</p>
                </div>
                <div class="input-item">
                    <p class="input-item-title"></p>
                    <input class="input-item-button" type="submit" value="編集">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
