@extends('main')
@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{Storage::url($vinyl->cover)}}" alt="..." /></div>
                <div class="col-md-6">
                    <h2>{{$vinyl->author}}</h2>
                    <h5>{{$vinyl->year}}</h5>
                    <h1 class="display-5 fw-bolder">{{$vinyl->name}}</h1>
                    <div class="fs-5 mb-5">
                        <span>${{$vinyl->price}}</span>
                    </div>
                    <p class="lead">{{$vinyl->description}}</p>
                    <div class="d-flex">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
