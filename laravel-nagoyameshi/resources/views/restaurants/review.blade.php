@extends('layouts.app')
 
@section('title', 'レビュー投稿')

@section('content')

<div class="container500vh">
    <div class="my-2">
        <a class="orange-links" href="{{ route('top') }}">トップ</a> > <a class="orange-links" href="{{ route('restaurants.index') }}">店舗一覧</a> > <a class="orange-links" href="{{ route('restaurants.show', $restaurant) }}">店舗詳細</a> > レビュー投稿
    </div>
    <h1 class="text-center my-2">{{ $restaurant->name }}</h1>
    <div class="d-block mx-auto mb-3">
        @if ($restaurant->image !== "")
            <img src="{{ asset($restaurant->image) }}" width="200" height="150"> 
        @else
            <img src="{{ asset('img/dummy.png')}}">
        @endif
    </div>
    <p class="text-center my-1">
        <span class="star-rating" data-rate="{{ round($restaurant->reviews->avg('score') * 2) / 2 }}"></span>
        {{ number_format(round($restaurant->reviews->avg('score'), 2), 2) }}（レビュー{{ $restaurant->reviews->count() }}件）
    </p>
    <div>
        @auth
            <h2 class="text-center mt-2">レビュー投稿</h2>
            <div class="form-group">
                <form method="POST" action="{{ route('reviews.store', $restaurant) }}">
                    @csrf
                    <label class="col-form-label">評価</label>
                    <div>
                        <select name="score" class="form-control">
                            <option value="5" class="review-score-color">★★★★★</option>
                            <option value="4" class="review-score-color">★★★★</option>
                            <option value="3" class="review-score-color">★★★</option>
                            <option value="2" class="review-score-color">★★</option>
                            <option value="1" class="review-score-color">★</option>
                        </select>
                    </div>
                    <label class="col-form-label">レビュー内容</label>
                    <div>
                        @error('content')
                            <strong class="text-danger">レビュー内容を入力してください</strong>
                        @enderror
                        <textarea class="form-control mb-2" name="content" cols="30" rows="5"></textarea>
                        <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                        <div class="form-group d-flex justify-content-center mb-4">
                            <button type="submit" class="btn text-white orange-btn ">レビューを投稿</button>
                        </div>
                    </div>
                </form>
            </div>
        @endauth
    </div>
</div>
@endsection