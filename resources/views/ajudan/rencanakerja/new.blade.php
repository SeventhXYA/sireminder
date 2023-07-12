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
    @php
        use Carbon\Carbon;
    @endphp
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Rencana Kerja</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Rencana Kerja</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form onsubmit="$('#submit').prop('disabled',true)" action="{{ route('kelolarencanakerja.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-6" class="col-form-label">Surat Masuk</label>
                            </div>
                            <div class="col-lg-8">
                                <button type="button" class="btn btn-primary btn-sm btn-icon-text"
                                    style="width: 6rem"data-bs-toggle="modal"
                                    data-bs-target="#lihatSurat-{{ $suratmasuk->id }}"><i class="btn-icon-prepend"
                                        data-feather="eye"></i>Lihat
                                </button>
                                <div class="modal fade" id="lihatSurat-{{ $suratmasuk->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                    Detail Surat Masuk</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Pengirim</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $suratmasuk->pengirim }}" readonly
                                                        style="background-color: #f5f5f5;" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Nomor Surat</label>
                                                    @if ($suratmasuk->no_surat)
                                                        <input type="text" class="form-control"
                                                            value="{{ $suratmasuk->no_surat }}" readonly
                                                            style="background-color: #f5f5f5;" />
                                                    @else
                                                        <input type="text" class="form-control" value="-" readonly
                                                            style="background-color: #f5f5f5;" />
                                                    @endif
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Tanggal Surat</label>
                                                    @if ($suratmasuk->tgl_surat)
                                                        <input type="text" class="form-control"
                                                            value="{{ \Carbon\Carbon::parse($suratmasuk->tgl_surat)->format('d-M-Y') }}"
                                                            readonly style="background-color: #f5f5f5;" />
                                                    @else
                                                        <input type="text" class="form-control" value="-" readonly
                                                            style="background-color: #f5f5f5;" />
                                                    @endif
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Tanggal Masuk</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $suratmasuk->created_at->format('d-M-Y') }}" readonly
                                                        style="background-color: #f5f5f5;" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Perihal</label>
                                                    <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4" name="perihal" maxlength="255"
                                                        rows="8" readonly style="background-color: #f5f5f5;">{{ $suratmasuk->perihal }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-6" class="col-form-label">Mulai Kegiatan</label>
                            </div>
                            <div class="col-lg-8">
                                <input class="form-control" id="start_date" name="start_date" type="datetime-local"
                                    autocomplete="off" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-6" class="col-form-label">Selesai Kegiatan</label>
                            </div>
                            <div class="col-lg-8">
                                <input class="form-control" id="end_date" name="end_date" type="datetime-local"
                                    autocomplete="off" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-2" class="col-form-label">Rencana Kegiatan</label>
                            </div>
                            <div class="col-lg-8">
                                <textarea id="maxlength-textarea-2" class="form-control" id="defaultconfig-4"name="rencana" maxlength="255"
                                    rows="8" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-2" class="col-form-label">Lokasi</label>
                            </div>
                            <div class="col-lg-8">
                                <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4"name="lokasi" maxlength="255"
                                    rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-2" class="col-form-label">Kategori</label>
                            </div>
                            <div class="col-lg-8">
                                <select class=" form-select" name="kategori" data-width="100%">
                                    <option selected disabled>Pilih</option>
                                    <option value="1">Luar Daerah Luar Provinsi</option>
                                    <option value="2">Luar Daerah Dalam Provinsi</option>
                                    <option value="3">Dalam Daerah Dalam Kabupaten</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <input class="form-control" maxlength="50" name="color" value="{{ old('color') }}"
                                    id="defaultconfig-3" type="text" readonly required hidden>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <input class="form-control" maxlength="50" name="id_suratmasuk"
                                    value={{ $suratmasuk->id }} id="defaultconfig-3" type="text" required hidden>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ url('/kelolarencanakerja') }}" type="button" class="btn btn-secondary me-2"
                                style="width: 6rem">Kembali</a>
                            <button type="submit" class="btn btn-primary" style="width: 6rem">Tambah</button>
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
    <script>
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        startDateInput.addEventListener('change', function() {
            endDateInput.min = this.value; // Set minimum value of end_date input to the selected start_date
        });

        endDateInput.addEventListener('change', function() {
            startDateInput.max = this.value; // Set maximum value of start_date input to the selected end_date
        });
    </script>
@endpush
