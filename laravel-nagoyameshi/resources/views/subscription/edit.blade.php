@extends('layouts.app')
 
@section('title', 'クレジットカード情報編集')

@section('content')
<div class="container500vh">
  <div>
    <a class="orange-links" href="{{ route('top') }}">トップ</a> > <a class="orange-links" href="{{ route('mypage') }}">マイページ</a> > クレジットカード情報編集
  </div>
  <h1 class="my-3 text-center">お支払い方法</h1>
  <div class="container mb-4">
    <div class="row pb-2 mb-2 border-bottom">
      <div class="col-3">
        <span class="fw-bold">カード種別</span>
      </div>

      <div class="col">
        <span>{{ $user->pm_type }}</span>
      </div>
    </div>

    <div class="row pb-2 mb-2 border-bottom">
      <div class="col-3">
        <span class="fw-bold">カード名義人</span>
      </div>

      <div class="col">
        <span>{{ $user->defaultPaymentMethod()->billing_details->name }}</span>
      </div>
    </div>

    <div class="row pb-2 mb-2 border-bottom">
      <div class="col-3">
        <span class="fw-bold">カード番号</span>
      </div>

      <div class="col">
        <span>**** **** **** {{ $user->pm_last_four }}</span>
      </div>
    </div>
  </div>

  <form id="payment-form" action="{{ route('subscription.update') }}" method="post">
    @csrf
    @method('patch')
    <input type="text" class="form-control"  id="card-holder-name" placeholder="カード名義人" required>
    <div class="mb-4" id="card-element"></div>
  </form>
  <div class="d-flex justify-content-center">
    <button class="btn text-white orange-btn" id="card-button" data-secret="{{ $intent->client_secret }}">変更</button>
  </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
	const stripe = window.Stripe("{{ config('services.stripe.pb_key') }}");
  const elements = stripe.elements();
  const cardElement = elements.create('card', {
    hidePostalCode: true,
  });
  cardElement.mount('#card-element');

  const cardHolderName = document.getElementById('card-holder-name');
  const cardButton = document.getElementById('card-button');
  const clientSecret = cardButton.dataset.secret;

  const cardError = document.getElementById('card-error');
  const errorList = document.getElementById('error-list');

  cardButton.addEventListener('click', async (e) => {
    const { setupIntent, error } = await stripe.confirmCardSetup(
      clientSecret, {
        payment_method: {
          card: cardElement,
          billing_details: { name: cardHolderName.value }
        }
      }
    );

    if(error) { 
        cardBtn.disable = false
    } else {
      stripePaymentIdHandler(setupIntent.payment_method);
    }
  });

  function stripePaymentIdHandler(paymentMethodId) {
  const form = document.getElementById('payment-form');

  const token = document.createElement('input');
  token.setAttribute('type', 'hidden');
  token.setAttribute('name', 'paymentMethodId');
  token.setAttribute('value', paymentMethodId);
  form.appendChild(token);

  form.submit();
  }
</script>
@endsection