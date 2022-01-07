@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="top-area d-flex">
        <a class="create-page-link blue" href="/carpenters">一覧へ戻る</a>
    </div>
    <div class="index-area">
        <h1>職人追加</h1>
        <div class="index-contents">
            <form method="post" action="{{route('carpenter.create')}}" enctype='multipart/form-data'>
                @csrf
                <div class="input-item">
                    <p class="input-item-title">名前</p>
                    <input type="text" name="name">
                </div>
                <div class="input-item">
                    <p class="input-item-title">職種</p>
                    <input type="text" name="role">
                </div>
                <div class="input-item">
                    <p class="input-item-title">画像</p>
                    <input class="no-border" type="file" name="img" value="追加" accept="image/jpeg, image/png">
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
