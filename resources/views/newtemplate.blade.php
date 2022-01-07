@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="top-area d-flex">
        <a class="create-page-link blue" href="/templates">一覧へ戻る</a>
    </div>
    <div class="index-area">
        <h1>定型文追加</h1>
        <div class="index-contents">
            <form method="post" action="{{route('template.create')}}">
                @csrf
                <div class="input-item">
                    <p class="input-item-title">タイトル</p>
                    <input type="text" name="title">
                </div>
                <div class="input-item">
                    <p class="input-item-title">文章</p>
                    <textarea name="body"></textarea>
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
