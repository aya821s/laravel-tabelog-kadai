@extends('layouts.app')
 
@section('title', 'マイページ')
 
@section('content')
<div class="container500">
    <h1 class="mb-3 text-center">マイページ</h1>

    @if (session('flash_message'))
        <div class="alert alert-warning" role="alert">
            <p class="mb-0">{{ session('flash_message') }}</p>
        </div>
    @endif

    @if (session('error_message'))
        <div class="alert alert-danger" role="alert">
            <p class="mb-0">{{ session('error_message') }}</p>
        </div>
    @endif

    <div class="container mb-4">
        <div class="row pb-2 mb-2 border-bottom">
            <div class="col-4">
                <span class="fw-bold">氏名</span>
            </div>
        <div class="col">
            <span>{{ $user->name }}</span>
        </div>
    </div>
    
    <div class="row pb-2 mb-2 border-bottom">
        <div class="col-4">
            <span class="fw-bold">メールアドレス</span>
        </div>
        <div class="col">
            <span>{{ $user->email }}</span>
        </div>
    </div>
    <div class="row pb-2 mb-2 border-bottom">
        <div class="col-4">
            <span class="fw-bold">電話番号</span>
        </div>
        <div class="col">
            <span>
                @if ($user->phone_number !== null)
                    {{ $user->phone_number }}
                @else
                    未設定
                @endif
            </span>
        </div>
    </div>

    <div class="my-2">
        <a class="orange-links" href="{{route('mypage.edit')}}">マイページ編集</a>
    </div>

    @if (Auth::user()->subscribed('premium_plan'))
        <div class="my-2">
            <a class="orange-links" href="{{ route('mypage.favorite') }}">お気に入り店舗一覧</a>
        </div>

        <div class="my-2">
            <a class="orange-links" href="{{ route('reservations.index') }}">予約一覧</a>
        </div>

        <div class="my-2">
            <a class="orange-links" href="{{ route('subscription.edit') }}">クレジットカード情報編集</a>
        </div>

        <div class="my-2">
            <a class="orange-links" href="{{ route('subscription.cancel') }}">有料会員解約</a>
        </div>

    @else
        <div class="my-2">
            <a class="orange-links" href="{{ route('subscription.create') }}">有料プラン登録</a>
        </div>

        <div class="my-2">
            <a class="orange-links" href="{{ route('user.delete') }}">アカウント削除</a>
        </div>
    @endif
</div>    
@endsection