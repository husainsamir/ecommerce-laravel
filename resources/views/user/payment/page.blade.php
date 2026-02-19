@extends('user.layouts.app')

@section('content')
<div class="container py-5 text-center">

    <h3 class="mb-4">
        Pay ₹{{ number_format($order->total_amount, 2) }}
    </h3>

    <form method="POST" action="{{ route('payment.stripe.checkout') }}">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <button type="submit" class="btn btn-success btn-lg">
            Pay with Stripe (Test Mode)
        </button>
    </form>

    <p class="text-muted mt-3">
        * You will be redirected to Stripe secure page.
    </p>

</div>
@endsection
