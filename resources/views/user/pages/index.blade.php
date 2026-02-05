@extends('layouts.app')

@section('content')

<div id="header-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}">
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="{{ asset('img/carousel-2.jpg') }}">
        </div>
    </div>
</div>

<div class="row pt-4">
    @for($i=1; $i<=4; $i++)
    <div class="col-md-3">
        <div class="card">
            <img src="{{ asset('img/product-'.$i.'.jpg') }}" class="card-img-top">
            <div class="card-body text-center">
                <h6>Stylish Shirt</h6>
                <p>$99</p>
                <a class="btn btn-primary btn-sm">Add To Cart</a>
            </div>
        </div>
    </div>
    @endfor
</div>

@endsection
