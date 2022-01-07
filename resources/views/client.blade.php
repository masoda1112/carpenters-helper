@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="top-area d-flex">
        <a class="create-page-link blue" href="/clients">一覧へ戻る</a>
        <form method="post" action="{{route('client.destroy', $client)}}">
            @method('DELETE')
            @csrf
            <input class="delete red" type="submit" value="顧客を削除する">
        </form>
    </div>
    <div class="index-area">
        <h1>顧客：{{$client->id}}</h1>
        <div class="index-contents">
            <form method="post" action="{{route('client.update',$client)}}">
                @method('PATCH');
                @csrf
                <div class="input-item">
                    <p class="input-item-title">名前</p>
                    <input name="name" type="text" value="{{$client->name}}">
                </div>
                <div class="input-item">
                    <p class="input-item-title">line_id</p>
                    <input name="line_id" type="text" value="{{$client->line_id}}">
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
