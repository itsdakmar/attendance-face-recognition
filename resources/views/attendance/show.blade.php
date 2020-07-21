@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('layouts.partials.header', [
        'title' => __('Hello,') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row mb-3">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('Code') }}</label>
                                    <input type="text"
                                           class="form-control form-control-alternative" value="{{ $class->subject->code }}"
                                           readonly >
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('Subject Name') }}</label>
                                    <input type="text" id="input-name"
                                           class="form-control form-control-alternative" value="{{ $class->subject->name }}"
                                           readonly >
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('Class Date') }}</label>
                                    <input type="text" id="input-name"
                                           class="form-control form-control-alternative" value="{{ $class->class_date->format('d F Y') }}"
                                           readonly >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">List Of Student Enrolled</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('attendance.live', $class->id) }}" class="btn btn-sm btn-primary">Start Live Attendance</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Student Matric No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Attend / Absent</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($class[0]->students as $student)
                                    <tr>
                                        <td>{{ $student->user->staff_id }}</td>
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $student->is_attend }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
    <script>
        $('tr').on('click', function () {
            window.location.href = $(this).data('href');
        })
    </script>
@endpush
