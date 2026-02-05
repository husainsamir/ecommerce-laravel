
@php
    $product = \App\Models\Product::latest()->first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>@yield('title','Admin Panel')</title>

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('adminLTE-master/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminLTE-master/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminLTE-master/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

<!-- JS -->
<script src="{{ asset('adminLTE-master/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminLTE-master/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('adminLTE-master/dist/js/adminlte.min.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
     </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
  
      <!--end::Header-->
      @include('admin.layouts.header')

      @include('admin.layouts.sidebar')

              
        <div class="content-wrapper p-3">
        @yield('content')
    </div>

    @include('admin.layouts.footer')

</div>
</body>
</html>
