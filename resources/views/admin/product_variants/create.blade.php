
 @extends('admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Add Product Variant</h3>
    </div>

    <div class="card-body">

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('productVariant.store') }}" method="POST">
            @csrf

            {{-- Product --}}
            <div class="mb-3">
                <label class="form-label">Select Product</label>
                <select name="product_id"
                        class="form-control @error('product_id') is-invalid @enderror">
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->product_name }}
                        </option>
                    @endforeach
                </select>

                @error('product_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Color --}}
            <div class="mb-3">
                <label class="form-label">Color (Optional)</label>
                <input type="text"
                       name="color"
                       class="form-control @error('color') is-invalid @enderror"
                       value="{{ old('color') }}"
                       placeholder="e.g. Red, Black">

                @error('color')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Size --}}
            <div class="mb-3">
                <label class="form-label">Size (Optional)</label>
                <input type="text"
                       name="size"
                       class="form-control @error('size') is-invalid @enderror"
                       value="{{ old('size') }}"
                       placeholder="e.g. S, M, L">

                @error('size')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label class="form-label">Variant Price</label>
                <input type="number"
                       step="0.01"
                       name="price"
                       class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price') }}"
                       placeholder="Enter variant price">

                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Stock --}}
            <div class="mb-3">
                <label class="form-label">Stock Quantity</label>
                <input type="number"
                       name="stock_quantity"
                       class="form-control @error('stock_quantity') is-invalid @enderror"
                       value="{{ old('stock_quantity') }}"
                       placeholder="Enter stock quantity">

                @error('stock_quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">
                Add Variant
            </button>

            <a href="{{ route('productVariant.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </form>
    </div>
</div>

@endsection
