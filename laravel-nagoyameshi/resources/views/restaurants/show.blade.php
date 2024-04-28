@extends('layouts.app')
 
@section('title', '店舗詳細')

@section('content')
<div class="container500">
    <div class="my-2">
        <a class="orange-links" href="{{ route('top') }}">トップ</a> > <a class="orange-links" href="{{ route('restaurants.index') }}">店舗一覧</a> >店舗詳細
    </div>

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

    <div class="my-2">
        <div class="row g-0">
            <div class="col-sm-8">
                <h1 class="my-2"> {{$restaurant->name}}</h1>
            </div>
            @if (Auth::user()->subscribed('premium_plan'))
                <div class="col-sm-4">
                    @if (Auth::user()->favorite_restaurants()->where('restaurant_id', $restaurant->id)->doesntExist())
                        <form action="{{ route('favorites.store', $restaurant->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn text-white orange-btn">♥ お気に入り追加</button>
                        </form>
                    @else
                        <form action="{{ route('favorites.destroy', $restaurant->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn text-white orange-btn">♥ お気に入り解除</button>
                        </form>
                    @endif
                </div>
            @endif
        </div> 
        
        @if ($restaurant->image !== "")
            <img src="{{ asset($restaurant->image) }}" width="200" height="150"> 
        @else
            <img src="{{ asset('img/dummy.png')}}">
        @endif

        <div class="my-3">
            {{$restaurant->description}}
        </div>

        <div class="row pb-1 my-1 border-bottom">
            <div class="col-3">
                <strong>営業時間</strong>
            </div>
            <div class="col">
                <span>
                    {{ date('G:i', strtotime($restaurant->opening_time)) }}〜{{ date('G:i', strtotime($restaurant->closing_time)) }}
                </span>
            </div>
        </div>

        <div class="row pb-1 my-1 border-bottom">
            <div class="col-3">
                <strong>平均予算</strong>
            </div>
            <div class="col">
                <span>
                    ￥{{ number_format($restaurant->lowest_price) }}〜￥{{ number_format($restaurant->highest_price) }}
                </span>
            </div>
        </div>

        <div class="row pb-1 my-1 border-bottom">
            <div class="col-3">
                <strong>住所</strong>
            </div>
            <div class="col">
                <span>
                    〒{{ substr($restaurant->postal_code, 0, 3) . '-' . substr($restaurant->postal_code, 3) }} 
                    <br>
                    {{ $restaurant->address }}
                </span>
            </div>
        </div>

        <div class="row pb-1 my-1 border-bottom">
            <div class="col-3">
                <strong>電話番号</strong>
            </div>
            <div class="col">
                <span>
                {{ $restaurant->phone_number }}
                </span>
            </div>
        </div>

        <div class="row pb-1 my-1 border-bottom">
            <div class="col-3">
                <strong>定休日</strong>
            </div>
            <div class="col">
                <span>
                    {{ $restaurant->holidays }}
                </span>
            </div>
        </div>

        <div class="row pb-2 my-2 border-bottom">
            @if (Auth::user()->subscribed('premium_plan'))
                <a class="orange-links" href="{{ route('reservations.create', $restaurant) }}">このお店を予約する</a>
            @else
                <a class="orange-links" href="{{ route('subscription.create') }}">有料プランに登録して、お店を予約しよう！</a>
            @endif
        </div>

        <h2 class="my-3">レビュー</h2>
        @if ($reviews->isEmpty())
            <p class="my-4">まだレビューはありません。</p>
        @else
            @foreach($reviews as $review)
                <div class="card mb-1">
                    <div class="card-header">{{$review->user->name}}</div>
                    <div class="card-body">
                        <div class="review-card">
                            <p class="orange-marks">{{ str_repeat('★', $review->score) }}</p>
                            <p>{{$review->content}}</p>
                            <p>{{$review->created_at}} </p>
                        </div>
                        @if ($review->user_id === Auth::id())
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                                @csrf
                                @method('DELETE')
                                <button class="orange-links" type="submit">削除</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif

        @if (Auth::user()->subscribed('premium_plan'))
            <div class="my-2">
                <a class="orange-links" href="{{ route('review.create', $restaurant) }}">レビュー投稿</a>
            </div>
        @endif
    </div>
</div>
@endsection