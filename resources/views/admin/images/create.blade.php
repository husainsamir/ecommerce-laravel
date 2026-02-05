@extends('admin.layouts.sidebar')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add Image – {{ $product->name }}</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('product.images.store', $product->id) }}"
              method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Product Select --}}
            <div class="mb-3">
                <label>Product</label>
                <select name="product_id" class="form-control">
                	
                    @foreach($products as $p)
                        <option value="{{ $p->id }}"
                            {{ $p->id == $product->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image"
                       class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Primary --}}
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_primary" value="1"
                       class="form-check-input" id="is_primary">
                <label class="form-check-label" for="is_primary">
                    Set as Primary Image
                </label>
            </div>

            <button class="btn btn-primary">Save Image</button>
        </form>
    </div>
</div>
@endsection
