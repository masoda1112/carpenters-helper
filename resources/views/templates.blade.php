@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="create-area d-flex">
        <a class="create-page-link" href="/templates/new">定型文を追加する</a>
    </div>
    <div class="index-area">
        <h1>定型文一覧</h1>
        <div class="index-contents">
            <table class="index-table">
                <thead>
                    <tr>
                        <th class="id-th">id</th>
                        <th>タイトル</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($templates as $template)
                        <tr>
                            <td class="id-th"><a href="/templates/{{$template->id}}">{{$template->id}}</a></td>
                            <td>{{$template->title}}</td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
