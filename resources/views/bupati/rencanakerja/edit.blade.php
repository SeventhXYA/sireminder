@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Rencana Kerja</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Rencana Kerja</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form onsubmit="$('#submit').prop('disabled',true)"
                        action="/kelolarencanakerja/update/{{ $rencanakerja->id }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-6" class="col-form-label">Mulai Kegiatan</label>
                            </div>
                            <div class="col-lg-8">
                                <input class="form-control mb-4 mb-md-0" name="start_date"
                                    data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="yyyy-mm-dd HH:MM:ss"
                                    autocomplete="off" value="{{ $rencanakerja->start_date }}" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-2" class="col-form-label">Selesai Kegiatan</label>
                            </div>
                            <div class="col-lg-8">
                                <input class="form-control mb-4 mb-md-0" name="end_date"
                                    data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="yyyy-mm-dd HH:MM:ss"
                                    autocomplete="off" value="{{ $rencanakerja->end_date }}" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-2" class="col-form-label">Rencana Kegiatan</label>
                            </div>
                            <div class="col-lg-8">
                                <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4"name="rencana" maxlength="255" rows="8"
                                    required>{{ $rencanakerja->rencana }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-2" class="col-form-label">Lokasi</label>
                            </div>
                            <div class="col-lg-8">
                                <textarea id="maxlength-textarea-1" class="form-control" id="defaultconfig-4"name="lokasi" maxlength="255"
                                    rows="4" required>{{ $rencanakerja->lokasi }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-2" class="col-form-label">Kategori</label>
                            </div>
                            <div class="col-lg-8">
                                <select class="js-example-basic-single form-select" name="kategori" data-width="100%">
                                    <option selected disabled value="{{ $rencanakerja->kategori }}">
                                        @if ($rencanakerja->kategori == 1)
                                            Luar Daerah Luar Provinsi
                                        @elseif($rencanakerja->kategori == 2)
                                            Luar Daerah Dalam Provinsi
                                        @else
                                            Dalam Daerah Dalam Kabupaten
                                        @endif
                                    </option>
                                    <option value="1">Luar Daerah Luar Provinsi</option>
                                    <option value="2">Luar Daerah Dalam Provinsi</option>
                                    <option value="3">Dalam Daerah Dalam Kabupaten</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ url('/rencanakerja') }}" type="button" class="btn btn-secondary me-2"
                                style="width: 6rem">Kembali</a>
                            <button type="submit" class="btn btn-primary" style="width: 6rem">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/timepicker.js') }}"></script>
@endpush
