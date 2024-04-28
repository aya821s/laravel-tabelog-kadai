@extends('layouts.app')
 
@section('title', '有料プラン解約')

@section('content')
<div class="container500vh">
    <div class="my-2">  
        <a class="orange-links" href="{{ route('top') }}">トップ</a> > <a class="orange-links" href="{{ route('mypage') }}">マイページ</a> > 有料プラン解約
    </div>
    <h1 class="my-3 text-center">有料プラン解約</h1>
    <p>有料プランを解約すると以下の特典を受けられなくなります。本当に解約してもよろしいですか？</p>
    <div class="card mb-3">
        <div class="card-header text-center">
            有料プランの内容
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">・いつでも来店予約可能</li>
            <li class="list-group-item">・店舗を好きなだけお気に入りに追加可能</li>
            <li class="list-group-item">・レビューを投稿可能</li>
            <li class="list-group-item">・月額たったの300円</li>
        </ul>
    </div>

    <div class="d-flex justify-content-center">
        <form id="cardForm" action="{{ route('subscription.destroy') }}" method="post">
            @csrf
            <button class="btn text-white orange-btn">解約</button>
        </form>
    </div>
</div> 
@endsection