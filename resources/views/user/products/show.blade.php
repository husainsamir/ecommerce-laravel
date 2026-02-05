@extends('user.layouts.app')

@section('content')

<div class="container">

    {{-- PRODUCT DETAILS --}}
    <div class="row mb-5">

        {{-- IMAGE --}}
        <div class="col-md-5">
            @if(\Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="img-fluid rounded border"
                     alt="{{ $product->name }}">
            @else
                <img src="{{ asset('img/no-image.png') }}"
                     class="img-fluid rounded border"
                     alt="No Image">
            @endif
        </div>

        {{-- DETAILS --}}
        <div class="col-md-7">
            <h2 class="mb-3">{{ $product->name }}</h2>

            <h4 class="text-primary mb-3">
                ₹{{ number_format($product->price, 2) }}
            </h4>

            <p class="text-muted">
                {{ $product->description }}
            </p>

            <p>
                <strong>Stock:</strong>
                @if($product->stock_quantity > 0)
                    <span class="text-success">In Stock</span>
                @else
                    <span class="text-danger">Out of Stock</span>
                @endif
            </p>

            {{-- ADD TO CART --}}
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
            </form>

            <a href="{{ route('user.products.index') }}"
               class="btn btn-outline-secondary btn-sm ml-2">
                Back
            </a>
        </div>

    </div>

    {{-- RELATED PRODUCTS --}}
    <h4 class="mb-4">Related Products</h4>

    <div class="row">
        @forelse($relatedProducts as $related)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">

                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists($related->image))
                        <img src="{{ asset('storage/' . $related->image) }}"
                             class="card-img-top"
                             style="height:160px; object-fit:cover;">
                    @else
                        <img src="{{ asset('img/no-image.png') }}"
                             class="card-img-top"
                             style="height:160px; object-fit:cover;">
                    @endif

                    <div class="card-body text-center">
                        <h6 class="mb-1">{{ $related->name }}</h6>

                        <p class="text-primary mb-2">
                            ₹{{ number_format($related->price, 2) }}
                        </p>

                        <a href="{{ route('user.products.show', $related->id) }}"
                           class="btn btn-sm btn-outline-primary">
                            View
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No related products found.
                </div>
            </div>
        @endforelse
    </div>

</div>

@endsection
