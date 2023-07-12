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
                                <h5 class="text-muted fw-normal mb-1">
                                    Halo {{ $reset->user->name }}!
                                </h5>
                                <p class="text-muted fw-normal mb-4">
                                    Silakan isi data berikut untuk mereset password Anda.
                                </p>
                                <form action="{{ route('reset') }}" method="post" class="forms-sample">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $reset->token }}">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control password" id="password"
                                            autocomplete="current-password" name="password"placeholder="Password Baru">
                                    </div>
                                    <div class="mb-3">
                                        <label for="passwordConfirmation" class="form-label">
                                            Konfirmasi Password Baru
                                        </label>
                                        <input type="password" class="form-control password" id="passwordConfirmation"
                                            autocomplete="current-password" name="password_confirmation"
                                            placeholder="Konfirmasi Password Baru">
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="passwordShow"
                                            onchange="handlePasswordShow(this)">
                                        <label class="form-check-label" for="passwordShow">
                                            Tampilkan Password
                                        </label>
                                    </div>
                                    <div>
                                        <input class="btn btn-primary me-2 mb-2 mb-md-0" type="submit"
                                            value="Konfirmasi" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function handlePasswordShow(checkbox) {
                document.querySelectorAll('.password').forEach(el => {
                    el.type = checkbox.checked ? 'text' : 'password'
                })
            }
        </script>
    </div>
@endsection
