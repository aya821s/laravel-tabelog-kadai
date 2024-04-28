@extends('layouts.app')
 
@section('title', 'マイページ編集')

@section('content')
<div class="container500">
    <div class="my-2">  
        <a class="orange-links" href="{{ route('top') }}">トップ</a> > <a class="orange-links" href="{{ route('mypage') }}">マイページ</a> > マイページ編集
    </div>
    <h1 class="my-2 text-center">マイページ編集</h1>
    <form method="POST" action="{{ route('mypage.update', $user) }}">
        @method('PUT')
        @csrf
        <div class="container mb-3">
            <div class="row py-1 my-2">
                <div class="col-4">
                    <span class="fw-bold">氏名（必須）</span>
                </div>
                <div class="col-8">
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus placeholder="名古屋 太郎">
                </div>
            </div>
            <div class="row py-1 my-2">
                <div class="col-4">
                    <span class="fw-bold">メールアドレス（必須）</span>
                </div>
                <div class="col-8">
                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" placeholder="taro.nagoya@example.com">
                </div>
            </div>
            <div class="row py-1 my-2">
                <div class="col-4">
                    <span class="fw-bold">電話番号</span>
                </div>
                <div class="col-8">
                    <input class="form-control" type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" autocomplete="tel-national" minlength="10" maxlength="11" placeholder="09012345678">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn text-white orange-btn">更新</button>
        </div>
    </form>
</div>
@endsection