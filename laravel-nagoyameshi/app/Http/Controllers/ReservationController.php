<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
    public function index(Reservation $reservation)
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', Auth::id())->orderBy('reserved_datetime', 'asc')->paginate(10);
 
        return view('reservations.index', compact('reservations'));
    }


    public function create(Restaurant $restaurant)
    {   
        return view('reservations.create', compact('restaurant'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'number_of_people' => 'required|between:1,50',
            'reservation_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
        ]);
        
        $reservation = new Reservation();
        $reservation->restaurant_id = $request->input('restaurant_id');
        $reservation->number_of_people = $request->input('number_of_people');
        $reservation->user_id = Auth::user()->id;
        $reserved_date = $request->input('reservation_date'); 
        $reserved_time = $request->input('reservation_time');
        $reservation->reserved_datetime = $reserved_date . ' ' . $reserved_time;
        $reservation->save();

        return to_route('reservations.index')->with('flash_message', '予約が完了しました。');
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('reservations.index')->with('error_message', '不正なアクセスです。');
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('flash_message', '予約をキャンセルしました。');
    }
}
