@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="top-area d-flex">
        <a class="create-page-link blue" href="/carpenters">一覧へ戻る</a>
        <form method="post" action="{{route('carpenter.destroy', $carpenter)}}">
            @method('DELETE')
            @csrf
            <input class="delete red" type="submit" value="職人を削除する">
        </form>
    </div>
    <div class="index-area">
        <h1>職人：{{$carpenter->id}}</h1>
        <div class="index-contents">
            <form method="post" action="{{route('carpenter.update', $carpenter)}}" enctype="multipart/form-data">
                @method('PATCH');
                @csrf
                <div class="input-item">
                    <p class="input-item-title">名前</p>
                    <input type="text" name="name" value="{{$carpenter->name}}">
                </div>
                <div class="input-item">
                    <p class="input-item-title">職種</p>
                    <input type="text" name="role" value="{{$carpenter->role}}">
                </div>
                <div class="input-item">
                    <p class="input-item-title">画像</p>
                    <div class="d-flex flex-column over-flow-hidden">
                        <label class="d-block over-flow-hidden" for="img">現在の使用している画像：{{$carpenter->img}}</label>
                        <input class="no-border input-item-file" type="file" name="img" accept="image/jpeg, image/png">
                    </div>
                    {{-- ここに画像表示予定 --}}
                </div>
                <div class="input-item">
                    <p class="input-item-title"></p>
                    {{-- <img src="{{ secure_url('storage/' . $carpenter->img) }}" /> --}}
                    <img src="{{$carpenter->img}}"/>
                </div>
                <div class="input-item">
                    <p class="input-item-title"></p>
                    <input class="input-item-button" type="submit" value="編集">
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
