@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Product</h3>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('product.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Product Name --}}
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $product->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id"
                        class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Current Image --}}
            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}"
                         width="120"
                         style="border-radius:6px; border:1px solid #ccc;">
                @else
                    <p class="text-muted">No image uploaded</p>
                @endif
            </div>

            {{-- New Image --}}
            <div class="mb-3">
                <label class="form-label">Change Image (optional)</label>
                <input type="file"
                       name="image"
                       class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                          rows="4"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number"
                       step="0.01"
                       name="price"
                       class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price', $product->price) }}">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Stock Quantity --}}
            <div class="mb-3">
                <label class="form-label">Stock Quantity</label>
                <input type="number"
                       name="stock_quantity"
                       class="form-control @error('stock_quantity') is-invalid @enderror"
                       value="{{ old('stock_quantity', $product->stock_quantity) }}">
                @error('stock_quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status"
                        class="form-control @error('status') is-invalid @enderror">
                    <option value="active"
                        {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="inactive"
                        {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">
                Update Product
            </button>

            <a href="{{ route('product.index') }}" class="btn btn-secondary">
                Back
            </a>

        </form>
    </div>
</div>
@endsection
