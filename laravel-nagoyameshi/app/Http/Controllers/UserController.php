<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage()
     {
         $user = Auth::user();
 
         return view('user.mypage', compact('user'));
     }

     public function edit(User $user)
    {
         $user = Auth::user();
 
         return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
         $user = Auth::user();
 
         $user->name = $request->input('name') ? $request->input('name') : $user->name;
         $user->email = $request->input('email') ? $request->input('email') : $user->email;
         $user->phone_number = $request->input('phone_number') ? $request->input('phone_number') : $user->phone_number;
         $user->update();
 
         return to_route('mypage')->with('flash_message', 'マイページを編集しました。');
    }

    public function favorite()
     {
         $user = Auth::user();
 
         $favorite_restaurants = $user->favorite_restaurants;
 
         return view('user.favorite', compact('favorite_restaurants'));
     }

     public function delete(Request $request)
     {
        $user = Auth::user();
 
        return view('user.delete', compact('user'));
     }


     public function destroy(Request $request)
     {
         Auth::user()->delete();
         return redirect('/');
     }
}
