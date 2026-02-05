
 @extends('admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Add Coupon</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('coupons.store') }}" method="POST">
            @csrf

            {{-- Coupon Code --}}
            <div class="mb-3">
                <label class="form-label">Coupon Code</label>
                <input type="text" name="coupon_code"
                       class="form-control @error('coupon_code') is-invalid @enderror"
                       value="{{ old('coupon_code') }}"
                       placeholder="SAVE100">

                @error('coupon_code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Discount Type --}}
            <div class="mb-3">
                <label class="form-label">Discount Type</label>
                <select name="discount_type"
                        class="form-control @error('discount_type') is-invalid @enderror">
                    <option value="">-- Select --</option>
                    <option value="fixed">Fixed</option>
                    <option value="rate">Percentage</option>
                </select>
            </div>

            {{-- Discount Value --}}
            <div class="mb-3">
                <label class="form-label">Discount Value</label>
                <input type="number" name="discount_value"
                       class="form-control @error('discount_value') is-invalid @enderror"
                       value="{{ old('discount_value') }}">
            </div>

            {{-- Dates --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date"
                           class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date"
                           class="form-control">
                </div>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="3"></textarea>
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button class="btn btn-primary">Save Coupon</button>
            <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Back</a>

        </form>

    </div>
</div>

@endsection
