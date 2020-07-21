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
                                <h3 class="mb-0">List Of Available Subjects</h3>
                            </div>
                            @hasanyrole('lecturer')
                            <div class="col-4 text-right">
                                <a href="{{ route('subject.create') }}" class="btn btn-sm btn-primary">Add subject</a>
                            </div>
                            @endhasanyrole
                        </div>
                    </div>

                    <div class="col-12">
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Subject Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->code }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->created_at->format('d F Y') }}</td>
                                    @hasanyrole('student')
                                    @if(in_array($subject->id, auth()->user()->subjectStudents->pluck('subject_id')->toArray()))
                                        <td>
                                            <button type="button" class="btn btn-secondary btn-block" disabled>
                                                Enrolled
                                            </button>
                                        </td>
                                    @else
                                        <td>
                                            <button type="button" class="btn btn-primary btn-block enroll"
                                                    data-id="{{ $subject->id }}">Enroll
                                            </button>
                                        </td>
                                    @endif
                                    @endhasanyrole
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $('.enroll').on('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Enroll!'
            }).then((result) => {

                $.ajax({
                    url: "{{ route('subject.enroll') }}",
                    data: {'subject_id': $(this).data('id')},
                    method: 'POST',
                    success: function (data) {
                        if (result.value) {
                            Swal.fire(
                                'Enrolled!',
                                'Successfully enrolled for class '+ data +'.',
                                'success'
                            ).then(function () {
                                location.reload()
                            })
                        }
                    }
                })
            })
        })
    </script>
@endpush
