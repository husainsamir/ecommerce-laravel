
 @extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Image</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('product.images.update', $image->id) }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Current Image</label><br>
                <img src="{{ asset('storage/'.$image->image_path) }}" width="120">
            </div>

            <div class="mb-3">
                <label>New Image (optional)</label>
                <input type="file" name="image"
                       class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_primary" value="1"
                       class="form-check-input" id="is_primary"
                       {{ $image->is_primary ? 'checked' : '' }}>
                <label class="form-check-label" for="is_primary">
                    Set as Primary Image
                </label>
            </div>

            <button class="btn btn-primary">Update Image</button>
        </form>
    </div>
</div>
@endsection
