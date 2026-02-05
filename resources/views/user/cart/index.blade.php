@extends('user.layouts.app')

@section('content')

<div class="container py-4">

    <h3 class="mb-4">My Cart</h3>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->count() > 0)

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th width="160">Quantity</th>
                        <th>Total</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>

                    @php $grandTotal = 0; @endphp

                    @foreach($cartItems as $item)
                        @php
                            $price = $item->product->price;
                            $total = $price * $item->quantity;
                            $grandTotal += $total;
                        @endphp

                        <tr>
                            {{-- Product --}}
                            <td>
                                <div class="d-flex align-items-center">
                                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists($item->product->image))
                                        <img
                                            src="{{ asset('storage/'.$item->product->image) }}"
                                            width="60"
                                            height="60"
                                            class="rounded mr-3"
                                            style="object-fit:cover;"
                                        >
                                    @else
                                        <img
                                            src="{{ asset('img/no-image.png') }}"
                                            width="60"
                                            height="60"
                                            class="rounded mr-3"
                                        >
                                    @endif
                                    <span>{{ $item->product->name }}</span>
                                </div>
                            </td>

                            {{-- Price --}}
                            <td>₹{{ number_format($price, 2) }}</td>

                            {{-- Quantity --}}
                            <td>
                                <div class="d-flex align-items-center">

                                    {{-- Decrease --}}
                                    <form action="{{ route('cart.decrease', $item->product_id) }}"
                                          method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-secondary">
                                            −
                                        </button>
                                    </form>

                                    <span class="mx-2 font-weight-bold">
                                        {{ $item->quantity }}
                                    </span>

                                    {{-- Increase --}}
                                    <form action="{{ route('cart.increase', $item->product_id) }}"
                                          method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-secondary">
                                            +
                                        </button>
                                    </form>

                                </div>
                            </td>

                            {{-- Total --}}
                            <td>₹{{ number_format($total, 2) }}</td>

                            {{-- Remove --}}
                            <td>
                                <form action="{{ route('cart.remove', $item->product_id) }}"
                                      method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{-- Grand Total --}}
        <div class="d-flex justify-content-end">
            <h5>
                Grand Total :
                <span class="text-primary">
                    ₹{{ number_format($grandTotal, 2) }}
                </span>
            </h5>
        </div>

        {{-- Actions --}}
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('user.products.index') }}"
               class="btn btn-outline-secondary mr-2">
                Continue Shopping
            </a>

            {{--  CHECKOUT LINK --}}
            <a href="{{ route('checkout.index') }}"
               class="btn btn-primary">
                Proceed to Checkout
            </a>
        </div>

    @else
        <div class="alert alert-info">
            Your cart is empty.
            <a href="{{ route('user.products.index') }}" class="ml-2">
                Shop now
            </a>
        </div>
    @endif

</div>

@endsection
