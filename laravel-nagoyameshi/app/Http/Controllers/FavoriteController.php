<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store($restaurant_id)
     {
         Auth::user()->favorite_restaurants()->attach($restaurant_id);
 
         return back();
     }
 
     public function destroy($restaurant_id)
     {
         Auth::user()->favorite_restaurants()->detach($restaurant_id);
 
         return back();
     }
}
