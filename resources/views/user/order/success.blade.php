@extends('user.layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4 text-success">Order Placed Successfully</h3>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">

        <div class="col-lg-9 col-md-8">

            {{-- Order Info --}}
            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    Order Detail
                </div>
                <div class="card-body">
                    <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                    <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                    <p>
                        <strong>Status:</strong>
                        <span class="badge 
                            @if($order->status == 'paid') bg-success
                            @elseif($order->status == 'failed') bg-danger
                            @else bg-warning text-dark
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>

            {{-- Addresses --}}
            <div class="row">

                {{-- Shipping Address --}}
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Shipping Address
                        </div>
                        <div class="card-body">
                            <p>{{ $order->shippingAddress->full_address ?? '-' }}</p>
                            <p>
                                {{ $order->shippingAddress->city ?? '' }},
                                {{ $order->shippingAddress->state ?? '' }}
                            </p>
                            <p>{{ $order->shippingAddress->zip_code ?? '' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Billing Address --}}
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            Billing Address
                        </div>
                        <div class="card-body">
                            <p>{{ $order->billingAddress->full_address ?? '-' }}</p>
                            <p>
                                {{ $order->billingAddress->city ?? '' }},
                                {{ $order->billingAddress->state ?? '' }}
                            </p>
                            <p>{{ $order->billingAddress->zip_code ?? '' }}</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Ordered Products --}}
            <div class="card mt-3">
                <div class="card-header bg-dark text-white">
                    Ordered Products
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th width="80">Qty</th>
                                <th width="120">Price</th>
                                <th width="120">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                    <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pay Now Button --}}
            <div class="mt-4">
                @if($order->status === 'pending')
                    <form action="{{ route('payment.page', $order->id) }}" method="GET">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Pay Now
                        </button>
                    </form>
                @elseif($order->status === 'paid')
                    <div class="alert alert-success mt-3">
                        Payment completed successfully 🎉
                    </div>
                @else
                    <div class="alert alert-danger mt-3">
                        Payment failed. Please try again.
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
