@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Add New Category</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('category.store') }}" method="POST">
            @csrf

            {{-- Category Name --}}
            <div class="mb-3">
                <label class="form-label">Category Name <span class="text-danger">*</span></label>
                <input type="text" name="category_name" 
                       class="form-control @error('category_name') is-invalid @enderror" 
                       value="{{ old('category_name') }}" placeholder="Enter category name">
                @error('category_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Parent Category --}}
            <div class="mb-3">
                <label class="form-label">Parent Category (Optional)</label>
                <select name="parent_cat_id" class="form-control @error('parent_cat_id') is-invalid @enderror">
                    <option value="">-- None (Top Level) --</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}" 
                            {{ old('parent_cat_id') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->category_name }}
                        </option>
                    @endforeach
                </select>
                @error('parent_cat_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
</div>
@endsection
