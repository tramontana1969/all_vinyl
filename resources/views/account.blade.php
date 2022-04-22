@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Avatar') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    <img src="{{Auth::user()->avatar}}" style="width: 150px" class="rounded mx-auto d-block" alt="...">
                    </div>
                    <div class="card-header">{{ __('Name') }}</div>
                    <div class="card-body">
                        {{ (Auth::user()->name) }}
                    </div>
                    <div class="card-header">{{ __('Birthday') }}</div>
                    <div class="card-body">
                        {{ (Auth::user()->birthday) }}
                    </div>
                </div>
                <div style="margin-top: 15px;">
                    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">Edit Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form enctype="multipart/form-data" action="user-update/{{Auth::user()->id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{Auth::user()->id}}"/>
                                    <div class="modal-body">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}"/>
                                    </div>
                                    <div class="modal-body">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}"/>
                                    </div>
                                    <div class="modal-body">
                                        <label for="birthday" class="form-label">Birthday</label>
                                        <input type="date" class="form-control" name="birthday" value="{{Auth::user()->birthday}}"/>
                                    </div>
                                    <div class="modal-body">
                                        <label for="avatar" class="form-label">Avatar</label>
                                        <input type="file" class="form-control" name="avatar" value="{{Auth::user()->avatar}}"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
