@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('layouts.partials.header', [
            'title' => __('Hello,') . ' '. auth()->user()->name,
            'description' => __('Please wait at least 10 - 15 seconds for face recognition to fully load.'),
            'class' => 'col-lg-7'
        ])

    <style>
        canvas {
            position: absolute;
            top: 0;
            left: 1rem;
            z-index: 10;
        }
    </style>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col" id="canvas">
                                <input type="hidden" id="class_id" value="{{ $class->id}}" data-href="{{ route('attendance.isAttend') }}" data-subject="{{ route('attendance.student', $class->subject->id) }}">
                                <video id="video" style="object-fit: fill" width="680" height="480" autoplay muted></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Attendance</h6>
                                <h2 class="mb-0">Present</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group" id="present"></ul>
                    </div>
                </div>
            </div>
        </div>
    @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
    <script defer src="{{ asset('argon') }}/js/face-api.min.js"></script>
    <script defer src="{{ asset('argon') }}/js/script.js"></script>
@endpush
