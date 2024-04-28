<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class ReviewController extends Controller

{
    public function create(Restaurant $restaurant) {

        return view('restaurants.review', compact('restaurant'));
    }

    

    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
             'content' => 'required'
         ]);
 
         $review = new Review();
         $review->content = $request->input('content');
         $review->restaurant_id = $request->input('restaurant_id');
         $review->user_id = Auth::user()->id;
         $review->score = $request->input('score');
         $review->save();
 
         return to_route('restaurants.show', $restaurant->id)->with('flash_message', 'レビューを投稿しました。');
    }

    public function destroy(Review $review) {
        if ($review->user_id !== Auth::id()) {
            return redirect()->route('top')->with('error_message', '不正なアクセスです。');
        }

        $review->delete();

        return redirect()->back()->with('flash_message', 'レビューを削除しました。');
    }
}