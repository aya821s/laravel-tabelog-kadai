@extends('layouts.app')
 
@section('title', 'アカウント削除')

@section('content')

<div class="container500">
    <div>
        <a class="orange-links" href="{{ route('top') }}">トップ</a> > <a class="orange-links" href="{{ route('mypage') }}">マイページ</a> > アカウント削除
    </div>
     <div class="my-5">
        <h1 class="my-3 text-center">退会の確認</h1>         
        <p>一度退会するとデータはすべて削除され、復旧はできません。</p>
        <form class="text-center" method="POST" action="{{ route('mypage.destroy') }}" onsubmit="return confirm('本当に退会しますか？');">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn text-white orange-btn">退会する</button>
        </form>
    </div>
</div>
@endsection