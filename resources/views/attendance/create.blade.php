@extends('layouts.app', ['title' => __('Create User')])

@section('content')
    @include('layouts.partials.header', [
        'title' => __('Hello,') . ' '. auth()->user()->name,
        'description' => __('Here is add new lecturer page'),
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Create New Subject') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('attendance.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Subject information') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group {{ $errors->has('code') ? ' has-danger' : '' }}">
                                    <label for="input-code">{{ __('Subject Code') }}</label>
                                    <select name="subject_id" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}"  id="input-code">
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->code.' '.$subject->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date">{{ __('Class Date') }}</label>
                                    <input type="text" name="date" id="input-date" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="{{ __('Choose class date') }}" value="{{ old('date') }}" required autofocus>

                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
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
    <script src="{{ asset('argon') }}/js/picker.js"></script>
    <script src="{{ asset('argon') }}/js/picker.date.js"></script>
    <script>
        $('#input-date').on('click', function () {
            $('#input-date').pickadate({
                // Escape any “rule” characters with an exclamation mark (!).
                format: 'You selecte!d: dddd, dd mmm, yyyy',
                formatSubmit: 'yyyy/mm/dd',
                hiddenPrefix: 'prefix__',
                hiddenSuffix: '__suffix',
                editable: false
            })
        })
    </script>
@endpush
