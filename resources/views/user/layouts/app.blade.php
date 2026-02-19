<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Eshopper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('user/img/favicon.ico') }}" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
</head>
<body>

@include('user.partials.topbar')
@include('user.partials.header')

<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        @include('user.partials.sidebar')
        <div class="col-lg-9 col-12">
            @yield('content')
        </div>
    </div>
</div>

@include('user.partials.footer')

<!-- LOGIN MODAL -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form id="ajaxLoginForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                        <small class="text-danger error-email"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-danger error-password"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </form>

        </div>
    </div>
</div>

<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('user/js/main.js') }}"></script>

<!-- AJAX LOGIN SCRIPT -->
<script>
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    $('#ajaxLoginForm').submit(function (e) {
        e.preventDefault();

        $('.error-email').text('');
        $('.error-password').text('');

        $.ajax({
            url: "{{ url('/ajax-login') }}",
            type: "POST",
            data: $(this).serialize(),

            success: function () {
                location.reload();
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    if (errors.email) $('.error-email').text(errors.email[0]);
                    if (errors.password) $('.error-password').text(errors.password[0]);
                } else {
                    alert('Laravel server error — check storage/logs/laravel.log');
                }
            }
        });
    });

});
</script>

</body>
</html>
