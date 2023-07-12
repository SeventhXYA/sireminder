@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                        </div>
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">SI<span>REMINDER</span></a>
                                <h5 class="text-muted fw-normal mb-4">
                                    Masukkan username Anda untuk mengembalikan akun.
                                </h5>
                                <form action="{{ route('sendemail') }}" method="post" class="forms-sample">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('username')) is-invalid @endif"
                                            id="username" name="username" placeholder="Username" autocomplete="off"
                                            autofocus>
                                        @if ($errors->has('username'))
                                            <div id="feedback" class="invalid-feedback">
                                                <span class="error">{{ $errors->first('username') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <input class="btn btn-primary me-2 mb-2 mb-md-0" type="submit"
                                            value="Konfirmasi" />
                                        <a href="{{ route('login') }}">Login</a>
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
