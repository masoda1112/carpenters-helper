@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="top-area d-flex">
        <a class="create-page-link blue" href="/templates">一覧へ戻る</a>
        <form method="post" action="{{route('template.destroy', $template)}}">
            @method('DELETE')
            @csrf
            <input class="delete red" type="submit" value="定型文を削除する">
        </form>
    </div>
    <div class="index-area">
        <h1>定型文：{{$template->id}}</h1>
        <div class="index-contents">
            <form method="post" action="{{route('template.update', $template)}}">
                @method('PATCH');
                @csrf
                <div class="input-item">
                    <p class="input-item-title">タイトル</p>
                    <input type="text" name="title" value="{{$template->title}}">
                </div>
                <div class="input-item">
                    <p class="input-item-title">文章</p>
                    <textarea name="body">{{$template->body}}</textarea>
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
