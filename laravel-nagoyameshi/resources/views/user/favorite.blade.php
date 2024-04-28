@extends('layouts.app')
 
@section('title', 'お気に入り店舗一覧')

@section('content')

<div class="container800">
    <div class="my-2">  
        <a class="orange-links" href="{{ route('top') }}">トップ</a> > <a class="orange-links" href="{{ route('mypage') }}">マイページ</a> > お気に入り店舗一覧
    </div>
    <h1 class="my-3 text-center">お気に入り一覧</h1>

    @if (session('flash_message'))
        <div role="alert">
             <p>{{ session('flash_message') }}</p>
        </div>
    @endif

    @if ($favorite_restaurants->isEmpty())
        <p class="my-5">お気に入りに登録された店舗はありません。</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th scope="col">店舗名</th>
                <th scope="col">郵便番号</th>
                <th scope="col">住所</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($favorite_restaurants as $favorite_restaurant)
            <tr>
                <td>
                    <a class="orange-links" href="{{ route('restaurants.show', $favorite_restaurant) }}">
                        {{ $favorite_restaurant->name }}
                    </a>
                </td>
                <td>{{ substr($favorite_restaurant->postal_code, 0, 3) . '-' . substr($favorite_restaurant->postal_code, 3) }}</td>
                <td>{{ $favorite_restaurant->address }}</td>
                <td>
                    <form action="{{ route('favorites.destroy', $favorite_restaurant->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="orange-links">お気に入り解除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection