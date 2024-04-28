<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Charge;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function create(Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        return view('subscription.create', compact('intent'));
    }

    public function store(Request $request)
    {
        $subscription = $request->user()->newSubscription('premium_plan', 'price_1Oxo4804Hf3ynxmhxHBHACpH')->create($request->paymentMethodId);
        return to_route('mypage')->with('flash_message', '有料プランへの登録が完了しました。');
}

public function edit(Request $request)
    {
        $user = Auth::user();
        return view('subscription.edit', compact('user'),[
            'intent' => $user->createSetupIntent()
        ]);
    }

public function update(Request $request)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('stripePaymentMethod'); 
        Auth::user()->updateDefaultPaymentMethod($request->paymentMethodId);
        return to_route('mypage')->with(['flash_message' => "お支払い方法を変更しました。"]);
    }

    public function cancel(Request $request)
    {
        return view('subscription.cancel');
    }

    public function destroy(Request $request, User $user)
    {
       $user = Auth::user();
       $user->subscription('premium_plan')->cancelNow();
       $user->stripe_id = null;
       $user->pm_type = null;
       $user->pm_last_four = null;
       $user->trial_ends_at= null;
       $user->update();
       return to_route('mypage')->with(['flash_message' => "有料プランを解約しました。"]);
    }
}