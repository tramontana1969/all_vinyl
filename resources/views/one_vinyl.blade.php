@extends('main')
@section('content')
    <style>
        .btn-link {
            border: none;
            outline: none;
            background: none;
            cursor: pointer;
            color: #0000EE;
            padding: 0;
            text-decoration: underline;
            font-family: inherit;
            font-size: inherit;
        }
    </style>
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
        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    @if(count($vinyl->comment) > 0)
                        <div class="headings d-flex justify-content-between align-items-center mb-3">
                            <h5>Comments</h5>
                        </div>
                        @foreach($vinyl->comment as $comment)
                            <div class="card p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user d-flex flex-row align-items-center">
                                        <img src="{{$comment->user->avatar}}" width="70" class="user-img rounded-circle mr-2">
                                        <span style="padding-left: 10px">
                                            <h6 class="font-weight-bold">{{$comment->user->name}}</h6>
                                            <p class="font-weight-bold">{{$comment->text}}</p>
                                        </span>
                                    </div> <small>{{$comment->date}}</small>
                                </div>
                                @role('admin|user')
                                @if(Auth::user()->id == $comment->user_id || Auth::user()->hasRole('admin'))
                                <div class="action d-flex justify-content-between mt-2 align-items-center">
                                    <div class="reply px-4">
                                        <small>
                                            <form action='{{url("/vinyl/comment/$comment->id")}}' method="post" >
                                                @method('delete')
                                                {{csrf_field()}}
                                                <button type="submit" class="btn-link">Remove</button>
                                            </form>
                                        </small>
                                    </div>
                                    <div class="icons align-items-center"> <i class="fa fa-star text-warning"></i> <i class="fa fa-check-circle-o check-icon"></i> </div>
                                </div>
                                @endif
                                @endrole
                            </div>
                        @endforeach
                    @else
                        <div class="headings d-flex justify-content-between align-items-center mb-3">
                            <h5>There are no comments yet</h5>
                        </div>
                    @endif
                        <br>
                    @if(Auth::user())
                    <div style="margin-top: 20px">
                        <form action="{{$vinyl->id}}/add_comment" method="post" >
                            @csrf
                            <div class="mb-3">
                                <label for="text" class="form-label">Add Comment</label>
                                <input style="height: 65px" type="text" name="text" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    @else
                        <div style="margin-top: 20px">
                            <h6>Please, <a href="/redirect">Sign in</a> if you want to leave a comment</h6>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
