@extends('layouts.app')
 
@section('title', 'トップページ')

@section('content')

<div class="main-container">
    <div class="top-container">
        <@if (session('flash_message'))
            <div class="alert alert-warning" role="alert">
                <p class="mb-0">{{ session('flash_message') }}</p>
            </div>
        @endif

        @if (session('error_message'))
            <div class="alert alert-danger" role="alert">
                <p class="mb-0">{{ session('error_message') }}</p>
            </div>
        @endif
        <div class="top-bg"><img class="top-img" src="{{ asset('/img/sekai.jpg') }}"></div>
            <div class="top-text">
                <h1>NAGOYAMESHIは、<br>名古屋のB級グルメに特化したレビューサイト。</h1>
                <br>
                @auth
                    <div class="mr-auto">
                        <h1><a href="{{ route('restaurants.index') }}">店舗一覧</a>はこちら。名古屋ならではの味を探そう！</h1>
                    </div>
                @endauth
                @guest
                    <div class="mr-auto">
                        <h1>今すぐ<a  href="{{ route('login') }}">ログイン</a>・<a href="{{ route('register') }}">会員登録</a>して、名古屋ならではの味を探そう！</h1>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection