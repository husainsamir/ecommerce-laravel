@extends('user.layouts.app')

@section('content')

<div class="container py-4">
    <h3 class="mb-4">Checkout</h3>

    <form action="{{ route('checkout.place') }}" method="POST">
        @csrf

        <div class="row">

            {{-- Shipping Address --}}
            <div class="col-md-6 mb-3">
                <h5>Shipping Address</h5>

                <div class="form-group mb-2">
                    <label>Full Address</label>
                    <textarea name="shipping_full_address"
                        class="form-control @error('shipping_full_address') is-invalid @enderror"
                        rows="2">{{ old('shipping_full_address') }}</textarea>
                    @error('shipping_full_address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label>City</label>
                    <input type="text"
                        name="shipping_city"
                        class="form-control @error('shipping_city') is-invalid @enderror"
                        value="{{ old('shipping_city') }}">
                    @error('shipping_city')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label>State</label>
                    <input type="text"
                        name="shipping_state"
                        class="form-control @error('shipping_state') is-invalid @enderror"
                        value="{{ old('shipping_state') }}">
                    @error('shipping_state')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label>Zip Code</label>
                    <input type="text"
                        name="shipping_zip_code"
                        class="form-control @error('shipping_zip_code') is-invalid @enderror"
                        value="{{ old('shipping_zip_code') }}">
                    @error('shipping_zip_code')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input" id="same_as_shipping">
                    <label class="form-check-label" for="same_as_shipping">
                        Billing same as shipping
                    </label>
                </div>
            </div>

            {{-- Billing Address --}}
            <div class="col-md-6 mb-3">
                <h5>Billing Address</h5>

                <div class="form-group mb-2">
                    <label>Full Address</label>
                    <textarea name="billing_full_address"
                        id="billing_full_address"
                        class="form-control @error('billing_full_address') is-invalid @enderror"
                        rows="2">{{ old('billing_full_address') }}</textarea>
                    @error('billing_full_address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label>City</label>
                    <input type="text"
                        name="billing_city"
                        id="billing_city"
                        class="form-control @error('billing_city') is-invalid @enderror"
                        value="{{ old('billing_city') }}">
                    @error('billing_city')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label>State</label>
                    <input type="text"
                        name="billing_state"
                        id="billing_state"
                        class="form-control @error('billing_state') is-invalid @enderror"
                        value="{{ old('billing_state') }}">
                    @error('billing_state')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label>Zip Code</label>
                    <input type="text"
                        name="billing_zip_code"
                        id="billing_zip_code"
                        class="form-control @error('billing_zip_code') is-invalid @enderror"
                        value="{{ old('billing_zip_code') }}">
                    @error('billing_zip_code')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>

        {{-- Order Summary --}}
        <div class="row mt-4">
            <div class="col-12">
                <h5>Order Summary</h5>

                @php $total = 0; @endphp

                <ul class="list-group mb-3">
                    @foreach($cartItems as $item)
                        @php
                            $subtotal = $item->product->price * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                            <strong>₹{{ $subtotal }}</strong>
                        </li>
                    @endforeach

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong>₹{{ $total }}</strong>
                    </li>
                </ul>

                <button type="submit" class="btn btn-primary btn-block">
                    Place Order
                </button>
            </div>
        </div>

    </form>
</div>

{{-- Copy Shipping → Billing --}}
<script>
document.getElementById('same_as_shipping').addEventListener('change', function () {
    if (this.checked) {
        document.getElementById('billing_full_address').value =
            document.querySelector('[name="shipping_full_address"]').value;
        document.getElementById('billing_city').value =
            document.querySelector('[name="shipping_city"]').value;
        document.getElementById('billing_state').value =
            document.querySelector('[name="shipping_state"]').value;
        document.getElementById('billing_zip_code').value =
            document.querySelector('[name="shipping_zip_code"]').value;
    }
});
</script>

@endsection
