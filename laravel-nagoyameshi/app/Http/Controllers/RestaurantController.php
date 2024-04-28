<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models;


class RestaurantController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        

        if ($request->category !== null) {
            $restaurants = Restaurant::where('category_id', $request->category)->sortable()->paginate(5);
            $total_count = Restaurant::where('category_id', $request->category)->count();
            $category = Category::find($request->category);
        }
        elseif ($keyword !== null) {
            $restaurants = Restaurant::where('name', 'like', "%{$keyword}%")->sortable()->paginate(5);
            $total_count = $restaurants->total();
            $category = null;
        } 
        else {
            $restaurants = Restaurant::sortable()->paginate(5);
            $total_count = "";
            $category = null;
        }
        $categories = Category::all();

        return view('restaurants.index', compact('restaurants', 'category', 'categories', 'total_count', 'keyword'));
    }

  


    public function show(Restaurant $restaurant)
    {
        $reviews = $restaurant->reviews()->get();
  
        return view('restaurants.show', compact('restaurant', 'reviews'));
  
    }

}
