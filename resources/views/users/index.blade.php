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
                                <h3 class="mb-0">Lecturer Available</h3>
                            </div>
                            @hasanyrole('administrator')
                            <div class="col-4 text-right">
                                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add lecturer</a>
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
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Staff Id</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->staff_id }}</td>
                                    <td>{{ $user->created_at->format('d F Y') }}</td>
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
