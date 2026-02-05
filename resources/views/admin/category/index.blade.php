@extends('admin.layouts.app')

@section('content')
<div class="card">
<div class="card-header d-flex justify-content-between align-items-center">
    <span>All Categories</span>
    <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">+ Create Category</a>
</div>

<div class="card-body">
<table class="table table-bordered">
<tr>
<th>#</th>
<th>Name</th>
<th>Slug</th>
<th>Parent</th>
<th>Status</th>
<th>Action</th>
</tr>

@foreach($categories as $cat)
<tr>
<td>{{ $cat->id }}</td>
<td>{{ $cat->category_name }}</td>
<td>{{ $cat->url_slug }}</td>
<td>
@if($cat->parent_cat_id)
{{ App\Models\Category::find($cat->parent_cat_id)->category_name ?? '-' }}
@else
-
@endif
</td>
<td>
<span class="badge {{ $cat->status == 'active' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst($cat->status) }}</span>
</td>
<td>
<a href="{{ route('category.edit',$cat->id) }}" class="btn btn-sm btn-info">Edit</a>
<form action="{{ route('category.destroy',$cat->id) }}" method="POST" style="display:inline">
@csrf
@method('DELETE')
<button class="btn btn-sm btn-danger">Delete</button>
</form>
</td>
</tr>
@endforeach

</table>
</div>
</div>
@endsection
