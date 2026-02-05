
@extends('admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Product Variants</h3>
        <a href="{{ route('productVariant.addproductVariants') }}" class="btn btn-primary">
            + Add Variant
        </a>
    </div>

    <div class="card-body">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($variants as $variant)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $variant->product->product_name ?? 'N/A' }}
                        </td>

                        <td>{{ $variant->color ?? '-' }}</td>

                        <td>{{ $variant->size ?? '-' }}</td>

                        <td>₹ {{ number_format($variant->price, 2) }}</td>

                        <td>
                            @if($variant->stock_quantity > 0)
                                {{ $variant->stock_quantity }}
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('product-variants.edit', $variant->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('product-variants.destroy', $variant->id) }}"
                                  method="POST"
                                  style="display:inline-block"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Variants Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
