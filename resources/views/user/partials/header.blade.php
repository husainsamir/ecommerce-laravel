<div class="container-fluid">
    <div class="row align-items-center py-3 px-xl-5">

        <!-- LOGO -->
        <div class="col-lg-3 col-12 text-center text-lg-left mb-3 mb-lg-0">
            <a href="{{ route('user.products.index') }}" class="text-decoration-none text-dark">
                <h1 class="m-0 display-5 font-weight-semi-bold">
                    <span class="text-primary border px-3 mr-1">E</span>Shopper
                </h1>
            </a>
        </div>

        <!-- SEARCH BAR -->
        <div class="col-lg-6 col-12 mb-3 mb-lg-0">
            <form action="{{ route('user.products.index') }}" method="GET">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search products"
                        value="{{ request('search') }}"
                    >
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- LOGIN / LOGOUT + CART -->
        <div class="col-lg-3 col-12 text-center text-lg-right">

            {{-- AUTH --}}
            @auth
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm mr-2">
                        Logout
                    </button>
                </form>
            @else
                <!-- LOGIN POPUP BUTTON -->
                <button
                    class="btn btn-outline-primary btn-sm mr-2"
                    data-toggle="modal"
                    data-target="#loginModal">
                    Login
                </button>
            @endauth

            {{-- CART --}}
            @php
                use App\Models\Cart;

                $cartCount = auth()->check()
                    ? Cart::where('user_id', auth()->id())->sum('quantity')
                    : 0;
            @endphp

            <a href="{{ route('cart.index') }}" class="btn border position-relative">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge badge-danger position-absolute"
                      style="top:-8px; right:-8px;">
                    {{ $cartCount }}
                </span>
            </a>

        </div>

    </div>
</div>
