<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>User Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('adminLTE-master/dist/css/adminlte.css') }}">
<link rel="stylesheet" href="{{ asset('adminLTE-master/plugins/bootstrap-icons/font/bootstrap-icons.css') }}">
</head>

<body class="login-page bg-body-secondary">

<div class="login-box">
<div class="card card-outline card-primary">

<div class="card-header text-center">
<h1 class="mb-0"><b>User</b>LTE</h1>
</div>

<div class="card-body login-card-body">
<p class="login-box-msg">User Login</p>

@if(session('error'))
<div class="alert alert-danger py-2">{{ session('error') }}</div>
@endif

<form action="{{ route('user.login.submit') }}" method="POST">
@csrf

<!-- EMAIL -->
<div class="input-group mb-1">
<input type="email" name="email"
 value="{{ old('email') }}"
 class="form-control @error('email') is-invalid @enderror"
 placeholder="Email">
<div class="input-group-text"><span class="bi bi-envelope"></span></div>
</div>
@error('email')
<small class="text-danger">{{ $message }}</small>
@enderror

<!-- PASSWORD -->
<div class="input-group mb-1 mt-3">
<input type="password" name="password"
 class="form-control @error('password') is-invalid @enderror"
 placeholder="Password">
<div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
</div>
@error('password')
<small class="text-danger">{{ $message }}</small>
@enderror

<div class="row mt-3">
<div class="col-4 ms-auto">
<button type="submit" class="btn btn-primary w-100">Login</button>
</div>
</div>
</form>

</div>
</div>
</div>

<script src="{{ asset('adminLTE-master/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminLTE-master/dist/js/adminlte.js') }}"></script>
</body>
</html>
