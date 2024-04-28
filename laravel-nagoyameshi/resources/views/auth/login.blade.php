@extends('layouts.app')
 
@section('title', 'ログイン')

@section('content')

<div class="main-container">
    <div class="auth-container">
　      <h1 class="text-center">ログイン</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="py-2">
                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス" autofocus>
            </div>

            <!-- Password -->
            <div class="py-2">
                <input class="form-control" type="password" id="password" name="password" required autocomplete="new-password" placeholder="パスワード">
            </div>

            <!-- Remember Me -->
            <div class="py-1">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="red rounded" name="remember">
                    <span class="ms-2 text-sm text-gray-600">次回から自動的にログインする</span>
                </label>
            </div>

            <!-- Log in -->
            <div class="py-2">
                <button type="submit" class="btn text-white w-100 orange-btn">ログイン</button>
            </div>

            <!-- Register -->
            <div class="auth-contents py-2">
                <a class="orange-links" href="{{ route('register') }}">新規会員登録はこちら</a>
            </div>
                
            <!-- Password Request -->
            @if (Route::has('password.request'))
            <div class="auth-contents py-2">
                <a class="orange-links" href="{{ route('password.request') }}">{{ __('パスワードをお忘れの方はこちら') }}</a>
            </div>
            @endif

            <div class="auth-contents py-2">
                <a class="text-black-50 text-decoration-none" href="{{ url('/admin') }}">管理者はこちら</a>
            </div>

        </form>
    </div>
</div>
@endsection
