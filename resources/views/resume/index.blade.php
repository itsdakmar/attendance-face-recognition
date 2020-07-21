@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <img src="{{ asset('argon/img/resume-1.jpg') }}" class="img-fluid mb-3">
                <img src="{{ asset('argon/img/resume-2.png') }}" class="img-fluid mb-3">
            </div>
        </div>
    </div>
@endsection
