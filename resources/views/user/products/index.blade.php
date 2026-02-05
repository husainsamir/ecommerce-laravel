@extends('user.layouts.app')

@section('content')

<style>
    .product-img {
        height: 180px;
        width: 100%;
        object-fit: cover;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }
</style>

<div class="container">

    {{-- PAGE HEADING --}}
    <h2 class="mb-4">
        @isset($currentCategory)
            {{ $currentCategory->name }} Products
        @else
            All Products
        @endisset
    </h2>

    {{-- PRODUCTS --}}
    <div class="row">
        @forelse($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">

                    {{-- IMAGE --}}
                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="product-img"
                             alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('img/no-image.png') }}"
                             class="product-img"
                             alt="No Image">
                    @endif

                    {{-- BODY --}}
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>

                        <p class="card-text text-muted">
                            {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                        </p>

                        <p class="text-primary font-weight-bold mb-3">
                            ₹{{ number_format($product->price, 2) }}
                        </p>

                        <a href="{{ route('user.products.show', $product->id) }}"
                           class="btn btn-sm btn-primary mt-auto">
                            View Details
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">
                    No products found.
                </div>
            </div>
        @endforelse
    </div>

</div>

@endsection
