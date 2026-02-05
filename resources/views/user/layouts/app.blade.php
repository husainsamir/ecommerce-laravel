<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Eshopper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('user/img/favicon.ico') }}" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
</head>

<body>

{{-- Topbar --}}
@include('user.partials.topbar')

{{-- Header --}}
@include('user.partials.header')

<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">

        {{-- Sidebar --}}
        @include('user.partials.sidebar')

        {{-- Page Content --}}
        <div class="col-lg-9 col-12">

            {{-- SMALL MESSAGE (CONTENT AREA ONLY) --}}
            @if(session('error'))
                <div class="alert alert-danger alert-sm py-2 px-3 mt-2">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-sm py-2 px-3 mt-2">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </div>

    </div>
</div>

{{-- Footer --}}
@include('user.partials.footer')

<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top">
    <i class="fa fa-angle-double-up"></i>
</a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('user/js/main.js') }}"></script>

</body>
</html>
