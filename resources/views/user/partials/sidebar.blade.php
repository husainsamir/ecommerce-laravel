<div class="col-lg-3 col-md-4 col-12 mb-4">
    <div class="p-3 rounded shadow-sm" style="background:#fff5f8;">

        {{-- Categories --}}
        <h5 class="text-white p-3 mb-3 rounded text-center"
            style="background:#f06292;">
            Categories
        </h5>

        <div class="list-group list-group-flush mb-4">
            @forelse($categories as $category)
                <a
                    href="{{ route('user.category.products', $category->id) }}"
                    class="list-group-item list-group-item-action border-0 rounded mb-1 category-link"
                >
                    {{ $category->category_name }}
                </a>
            @empty
                <p class="text-muted text-center">No categories available</p>
            @endforelse
        </div>

        {{-- My Orders Button (ONLY if user is logged in) --}}
        @auth
            <a
                href="{{ route('orders.success') }}"
                class="btn w-100 py-2 fw-semibold my-orders-btn"
            >
                🛒 My Orders
            </a>
        @endauth

    </div>
</div>
