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
                        @if (Auth::user()->avatar == null)
                            <img src="default.jpg" style="width: 150px" class="rounded mx-auto d-block" alt="...">
                        @else
                            <img src="{{Storage::url(Auth::user()->avatar)}}" style="width: 150px" class="rounded mx-auto d-block" alt="...">
                        @endif
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
            </div>
        </div>
    </div>
@endsection
