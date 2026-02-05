@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Images – {{ $product->name }}</h4>
        <a href="{{ route('product.images.create', $product->id) }}" class="btn btn-primary btn-sm">
            + Add Image
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Primary</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($images as $img)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- Product Name instead of Product ID --}}
                            <td>
                                {{ $img->product->name ?? 'N/A' }}
                            </td>

                            {{-- Image Preview --}}
                            <td>
                                <img src="{{ asset('storage/'.$img->image_path) }}"
                                     width="80" height="60"
                                     style="object-fit:cover;border:1px solid #ccc;border-radius:4px;">
                            </td>

                            {{-- Primary Flag --}}
                            <td>
                                @if($img->is_primary)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td>
                                <a href="{{ route('product.images.edit', $img->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('product.images.destroy', $img->id) }}"
                                      method="POST"
                                      style="display:inline-block"
                                      onsubmit="return confirm('Delete image?')">
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
                            <td colspan="5" class="text-center text-muted">
                                No images found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
