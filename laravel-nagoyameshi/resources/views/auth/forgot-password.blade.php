@extends('layouts.app')
 
@section('title', 'パスワード再設定')

@section('content')

<div class="main-container">
    <div class="auth-container">
        <h1 class="text-center pt-4">パスワード再設定</h1>
        <div class="py-2"> 
            登録されているメールアドレスを入力して、「送信」ボタンを押してください。<br>パスワード再設定用のURLをお送りします。
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-0" :status="session('status')" />

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="py-2">
                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス" autofocus>
            </div>
            <button type="submit" class="btn text-white w-100 orange-btn">送信</button>
        </form>
    </div>
</div>
@endsection

