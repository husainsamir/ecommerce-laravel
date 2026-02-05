<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="{{ asset('adminLTE-master/dist/css/adminlte.css') }}">
<link rel="stylesheet" href="{{ asset('adminLTE-master/plugins/bootstrap-icons/font/bootstrap-icons.css') }}">
<link rel="stylesheet" href="{{ asset('adminLTE-master/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
</head>

<body class="register-page bg-body-secondary">

<div class="register-box">
<div class="card card-outline card-primary">

<div class="card-header text-center">
<h1 class="mb-0"><b>Admin</b>LTE</h1>
</div>

<div class="card-body register-card-body">

  
<p class="register-box-msg">Register a new Admin account</p>

<form action="{{ route('admin.register.submit') }}" method="POST">
@csrf

{{-- Full Name --}}
<div class="input-group mb-2">
<input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control @error('full_name') is-invalid @enderror" placeholder="Full Name">
<div class="input-group-text"><span class="bi bi-person"></span></div>
</div>
@error('full_name')<small class="text-danger">{{ $message }}</small>@enderror

{{-- Email --}}
<div class="input-group mb-2">
<input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
<div class="input-group-text"><span class="bi bi-envelope"></span></div>
</div>
@error('email')<small class="text-danger">{{ $message }}</small>@enderror

{{-- Password --}}
<div class="input-group mb-2">
<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
<div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
</div>
@error('password')<small class="text-danger">{{ $message }}</small>@enderror

{{-- Phone Number --}}
<div class="input-group mb-2">
<input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone Number">
<div class="input-group-text"><span class="bi bi-telephone"></span></div>
</div>
@error('phone_number')<small class="text-danger">{{ $message }}</small>@enderror

{{-- Terms --}}
<div class="row mb-2">
<div class="col-8">
<div class="form-check">
<input class="form-check-input" type="checkbox">
<label class="form-check-label">I agree to the terms</label>
</div>
</div>

<div class="col-4">
<button type="submit" class="btn btn-primary w-100">Register</button>
</div>
</div>

<p class="mt-3 text-center">
<a href="{{ route('admin.login') }}">I already have an account</a>
</p>

</form>

</div>
</div>
</div>

<script src="{{ asset('adminLTE-master/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminLTE-master/dist/js/adminlte.js') }}"></script>
</body>
</html>
