@extends('layouts.layout')
@section('content')
<div class="contents">
    <div class="create-area d-flex">
        {{-- <a class="create-page-link" href="/clients/new">顧客を追加する</a> --}}
    </div>
    <div class="index-area">
        <h1>顧客一覧</h1>
        <div class="index-contents">
            <table class="index-table">
                <thead>
                    <tr>
                        <th class="id-th">id</th>
                        <th>名前</th>
                        <th>line_id</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                    <tr>
                        <td class="id-th"><a href="/clients/{{$client->id}}">{{$client->id}}</a></td>
                        <td>{{$client->name}}</td>
                        <td>{{$client->line_id}}</td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
