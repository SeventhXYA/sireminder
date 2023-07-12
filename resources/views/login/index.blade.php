@extends('layout.master2')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper"
                                style="background-image: url({{ asset('assets/images/login.png') }})">

                            </div>
                        </div>
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">SI<span>REMINDER</span></a>
                                <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                <form action="{{ route('authenticate') }}" method="post" class="forms-sample">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="userEmail" name="username"
                                            placeholder="Username" autocomplete="off" autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="userPassword"
                                            autocomplete="current-password" name="password"placeholder="Password">
                                    </div>
                                    {{-- <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="authCheck">
                                        <label class="form-check-label" for="authCheck">
                                            Remember me
                                        </label>
                                    </div> --}}
                                    <div>
                                        <input class="btn btn-primary me-2 mb-2 mb-md-0" type="submit" value="Login" />
                                        <a href="{{ route('forget') }}">Lupa password</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush
@push('custom-scripts')
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <script>
        @if (Session::has('loginError'))
            window.onload = () => showSwal('title-and-text', '{{ Session::get('loginError') }}')
        @endif
    </script>
@endpush
