
 @extends('admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Coupons / Offers</h3>
        <a href="{{ route('coupons.create') }}" class="btn btn-primary">
            + Add Coupon
        </a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Coupon Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Validity</th>
                    <th>Status</th>
                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($coupons as $coupon)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $coupon->coupon_code }}</td>
                        <td>{{ ucfirst($coupon->discount_type) }}</td>
                        <td>
                            @if($coupon->discount_type == 'rate')
                                {{ $coupon->discount_value }} %
                            @else
                                ₹ {{ $coupon->discount_value }}
                            @endif
                        </td>
                        <td>
                            {{ $coupon->start_date }} <br>
                            {{ $coupon->end_date }}
                        </td>
                        <td>
                            <span class="badge bg-{{ $coupon->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($coupon->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('coupons.edit', $coupon->id) }}"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('coupons.destroy', $coupon->id) }}"
                                  method="POST"
                                  style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete coupon?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Coupons Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
