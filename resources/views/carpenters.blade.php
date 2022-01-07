@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="create-area d-flex">
        <a class="create-page-link" href="/carpenters/new">職人を追加する</a>
    </div>
    <div class="index-area">
        <h1>職人一覧</h1>
        <div class="index-contents">
            <table class="index-table">
                <thead>
                    <tr>
                        <th class="id-th">id</th>
                        <th>名前</th>
                        <th>職種</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carpenters as $carpenter)
                    <tr>
                        <td class="id-th"><a href="/carpenters/{{$carpenter->id}}">{{$carpenter->id}}</a></td>
                        <td>{{$carpenter->name}}</td>
                        <td>{{$carpenter->role}}</td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
