@extends('layouts.app')
 
@section('title', '予約一覧')

@section('content')

<div class="container500vh">
    <div class="my-2">
        <a class="orange-links" href="{{ route('top') }}">トップ</a> > <a class="orange-links" href="{{ route('mypage') }}">マイページ</a> > 予約一覧
    </div>
    <h1 class="my-3 text-center">予約一覧</h1>

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

    @if ($reservations->isEmpty())
        <p class="my-5">予約はありません。</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">店舗名</th>
                    <th scope="col">予約日時</th>
                    <th scope="col">人数</th>
                    <th scope="col"></th>
                </tr>
             </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>
                            <a class="orange-links" href="{{ route('restaurants.show', $reservation->restaurant) }}">
                                {{ $reservation->restaurant->name }}
                            </a>
                        </td>
                        <td>{{ date('Y年n月j日 G時i分', strtotime($reservation->reserved_datetime)) }}</td>
                        <td>{{ $reservation->number_of_people }}名</td>
                        <td>
                            @if ($reservation->reserved_datetime > now())
                                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('予約をキャンセルしてもよろしいですか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="orange-links" type="submit">キャンセル</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $reservations->links() }}
        </div>
    @endif
</div>
@endsection