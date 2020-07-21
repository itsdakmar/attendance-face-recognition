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
                <div class="card bg-secondary shadow mb-3">
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('Subject information') }}</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-code">{{ __('Subject Code') }}</label>
                                        <input type="text" name="code" id="input-code"
                                               class="form-control form-control-alternative"
                                               placeholder="{{ __('Subject Code') }}" value="{{ old('code', $subject->code) }}" readonly
                                               autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name"
                                               class="form-control form-control-alternative"
                                               placeholder="{{ __('Name') }}" value="{{ old('name', $subject->name) }}" readonly
                                               autofocus>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">New Enrollment Student</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="budget">Matric No</th>
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <tr>
                                <td class="budget">
                                    $2500 USD
                                </td>
                                <td class="budget">
                                    $2500 USD
                                </td>
                                <td>
                                  <span class="badge badge-dot mr-4">
                                    <i class="bg-warning"></i>
                                    <span class="status">pending</span>
                                  </span>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">View Profile</a>
                                            <a class="dropdown-item" href="#">Expel / Leave</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
