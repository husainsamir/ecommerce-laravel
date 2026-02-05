@extends('admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Products List</h3>
        <a href="{{ route('product.addproduct') }}" class="btn btn-primary">
            + Add Product
        </a>
    </div>

    <div class="card-body">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- ✅ Product Image --}}
                        <td class="text-center">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     alt="{{ $product->name }}"
                                     width="80"
                                     height="60"
                                     style="object-fit:cover; border-radius:4px; border:1px solid #ddd;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>

                        <td>{{ $product->name }}</td>

                        <td>
                            {{ $product->category->category_name ?? 'N/A' }}
                        </td>

                        <td>₹ {{ number_format($product->price, 2) }}</td>

                        <td>
                            @if($product->stock_quantity > 0)
                                {{ $product->stock_quantity }}
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                        </td>

                        <td>
                            @if($product->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('product.edit', $product->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('product.destroy', $product->id) }}"
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
                        <td colspan="8" class="text-center">No Products Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
