@extends('layouts.app')
 
@section('title', 'レストラン一覧')

@section('content')
<div class="container1000vh">
    <div class="my-2">
        <a class="orange-links" href="{{ route('top') }}">トップ</a> > 店舗一覧
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
    
    <div class="row">
        <div class="col-md-3">
            <div class="restaurant-search">
                <form action="{{ route('restaurants.index', $keyword) }}" method="GET">
                    <input class="form-control mb-1" name="keyword" placeholder="店名">
                    <button type="submit" class="btn text-white w-20 orange-btn">検索</button>
                </form>
                <h3 class="mt-3">料理ジャンルから探す</h3>
                @foreach ($categories as $category)
                    <label class="my-1">
                        <a class="orange-links" href="{{ route('restaurants.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                    </label>
                    <br>
                @endforeach
            </div>
        </div>

        <div class="col-md-9">
            @if($keyword !== null)
                <a class="orange-links" href="{{ route('top') }}">トップ</a> > <a class="orange-links" href="{{ route('restaurants.index') }}">店舗一覧</a> > {{ $category->name }}
                <p>{{ $keyword }}の店舗が{{ $total_count }}件見つかりました</p>
            @endif
            <div class="restaurants-index">
                @foreach($restaurants as $restaurant)
                    <div class="card border mb-2 restaurants-card">
                        <div class="row g-0">
                            <div class="col-sm-4 restaurants-card-img">
                                @if ($restaurant->image !== "")
                                    <img src="{{ asset($restaurant->image) }}"> 
                                @else
                                    <img src="{{ asset('img/dummy.png')}}">
                                @endif
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body">
                                    <div class="row g-0">
                                        <div class="col-sm-10">
                                            <h2> {{$restaurant->name}}</h2>
                                        </div>
                                        <div class="col-sm-2">
                                            @if (Auth::user()->subscribed('premium_plan'))
                                                <h2>
                                                    @if (Auth::user()->favorite_restaurants()->where('restaurant_id', $restaurant->id)->doesntExist())
                                                        <form action="{{ route('favorites.store', $restaurant->id) }}" method="post">
                                                            @csrf
                                                            <button class="orange-marks" type="submit">♡</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('favorites.destroy', $restaurant->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="orange-marks" type="submit">♥</button>
                                                        </form>
                                                    @endif
                                                </h2>
                                            @else
                                                <h2>♡</h2>
                                            @endif
                                        </div>
                                    </div>
                                    <label>￥{{ number_format($restaurant->lowest_price) }}〜￥{{ number_format($restaurant->highest_price) }}</label>
                                    <br>
                                    <p class="my-1"> {{$restaurant->description}} </p>
                                    <a class="orange-links" href="{{ route('restaurants.show', $restaurant) }}">店舗詳細</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="my-4">
                {{ $restaurants->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection