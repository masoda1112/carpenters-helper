@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="top-area d-flex">
        <a class="create-page-link blue" href="/clients">一覧へ戻る</a>
    </div>
    <div class="index-area">
        <h1>顧客追加</h1>
        <div class="index-contents">
            <form method="post" action="{{route('client.create')}}">
                @csrf
                <div class="input-item">
                    <p class="input-item-title">名前</p>
                    <input name="name" type="text">
                </div>
                <div class="input-item">
                    <p class="input-item-title">line_id</p>
                    <input name="line_id" type="text">
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

