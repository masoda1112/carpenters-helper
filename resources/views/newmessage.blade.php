@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="top-area d-flex">
        <a class="create-page-link blue" href="/home">一覧へ戻る</a>
    </div>
    <div class="index-area">
        <h1 id="test">メッセージ追加</h1>
        <div class="index-contents">
            <form method="post" action="{{route("message.create")}}">
                @csrf
                <div class="input-item">
                    <p class="input-item-title">顧客</p>
                    <select name="client" size="1">
                        @forelse($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="input-item">
                    <p class="input-item-title">日付</p>
                    <input name="date" type="date">
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
                        <textarea id="sentence-input" name="message" list="templates"></textarea>
                    </div>
                </div>
                <div class="carpenter-list" id="carpenter-list">
                    <div class="input-item carpenter-item">
                        <p class="input-item-title">職人</p>
                        <select name="carpenters[]" size="1">
                            @forelse($carpenters as $carpenter)
                            <option value="{{$carpenter->id}}">{{$carpenter->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="add-carpenter-item input-item">
                    <p class="add-carpenter-left input-item-title"></p>
                    <p class="add-carpenter" id="add-carpenter">＋職人を追加する</p>
                </div>
                <div class="input-item">
                    <p class="input-item-title"></p>
                    <input class="input-item-button" type="submit" value="追加">
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
