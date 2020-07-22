@extends('layouts.app', ['title' => __('Create User')])

@section('content')
    @include('layouts.partials.header', [
        'title' => __('Hello,') . ' '. auth()->user()->name,
        'description' => __('Here is add new lecturer page'),
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                @if (session('status'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div id="webcam" style="display: none">
                                    <div id="my_camera" style="width:320px; height:240px;"></div>
                                </div>
                                <div id="my_result"></div>

                                @if($student->studentImages)
                                    <img id="img-profile" src="{{ asset('argon') }}/student/img/{{ $student->staff_id.'/'.$student->studentImages->path }}" class="card-img-top" width="auto" alt="default">
                                @else
                                    <img id="img-profile" src="{{ asset('argon') }}/img/default.jpg" class="card-img-top" width="auto" alt="default">
                                @endif
                                <button type="button" class="btn btn-secondary mt-4" id="photo">Update Photo (Webcam)</button>
                                <button type="button" class="btn btn-primary mt-4" id="take-photo">Take picture</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('student.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Lecturer information') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <input id="input-img" type="hidden" name="img" value="">

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="{{ __('Name') }}" value="{{ old('name', $student->name) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="input-staffId">{{ __('Student Id') }}</label>
                                    <input type="text" name="staff_id" id="input-staff_id" class="form-control form-control-alternative" placeholder="{{ __('Staff Id') }}" value="{{ old('staff_id', $student->staff_id) }}" readonly autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="{{ __('Email') }}" value="{{ old('email', $student->email) }}" readonly autocomplete="off">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-block mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/js/webcam.min.js" type="application/javascript"></script>
<script>

    $('#photo').on('click', function (e) {
        e.preventDefault();
        $('#img-profile').hide();
        $('#webcam').show();
        $('#input-img').val('');
        $('#my_result').html('');
        init();
    });

    $('#take-photo').on('click', function (e) {
        e.preventDefault();
        take_snapshot();
    });

    function init(){
        Webcam.set({
            width: 640,
            height: 480,
            dest_width: 1280,
            dest_height: 720,
            image_format: 'jpeg',
            jpeg_quality: 90,
            force_flash: false
        });
        Webcam.attach( '#my_camera' );
    }

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            let raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
            $('#input-img').val(raw_image_data);
            Webcam.reset();
            $('#webcam').hide();
            $('#my_result').html('<img class="img-fluid" src="'+data_uri+'"/>');
        } );
    }

</script>
@endpush
