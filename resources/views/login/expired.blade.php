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
                                <h5 class="text-muted fw-normal mb-2">
                                    Yah :(
                                </h5>
                                <p class="text-muted mb-4">
                                    Maaf, reset password Anda tidak tersedia. Ini dapat disebabkan karena link Anda sudah
                                    kadaluarsa atau sudah digunakan. Silahkan lakukan reset password kembali melalui tombol
                                    dibawah ini.
                                </p>
                                <div>
                                    <a class="btn btn-primary me-2 mb-2 mb-md-0" href="{{ route('forget') }}">
                                        Reset Password
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
