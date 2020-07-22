@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('layouts.partials.header', [
        'title' => __('Hello,') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">List Of Created Class</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('attendance.create') }}" class="btn btn-sm btn-primary">Create Class</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Subject Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Class Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendances as $attendance)
                                <tr data-href="{{ route('attendance.show', $attendance->id) }}">
                                    <td>{{ $attendance->subject->code }}</td>
                                    <td>{{ $attendance->subject->name }}</td>
                                    <td>{{ $attendance->status }}</td>
                                    <td>{{ $attendance->class_date->format('d F Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $attendances->links() }}
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
