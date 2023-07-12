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
            <li class="breadcrumb-item"><a href="#">Surat Masuk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Surat Masuk</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form onsubmit="$('#submit').prop('disabled',true)" action="/dokumentasi/store/{{ $rencanakerja->id }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="defaultconfig-6" class="col-form-label">Rencana Kerja</label>
                            </div>
                            <div class="col-lg-8">
                                <button type="button" class="btn btn-primary btn-sm btn-icon-text"
                                    style="width: 6rem"data-bs-toggle="modal"
                                    data-bs-target="#lihatSurat-{{ $rencanakerja->id }}"><i class="btn-icon-prepend"
                                        data-feather="eye"></i>Lihat
                                </button>
                                <div class="modal fade" id="lihatSurat-{{ $rencanakerja->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                    Detail Rencana Kerja</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Mulai
                                                        Kegiatan</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($rencanakerja->start_date)->format('d-M-Y H:i') }}"
                                                        readonly style="background-color: #f5f5f5;" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Selesai Kegiatan</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($rencanakerja->end_date)->format('d-M-Y H:i') }}"
                                                        readonly style="background-color: #f5f5f5;" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Rencana</label>
                                                    <textarea class="form-control" maxlength="255" rows="8" readonly style="background-color: #f5f5f5;">{{ $rencanakerja->rencana }}</textarea>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Lokasi</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $rencanakerja->lokasi }}" readonly
                                                        style="background-color: #f5f5f5;" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Kategori</label><br>
                                                    @if ($rencanakerja->kategori == 1)
                                                        <span class="badge bg-danger text-white">Luar Daerah Luar
                                                            Provinsi</span>
                                                    @elseif($rencanakerja->kategori == 2)
                                                        <span class="badge bg-primary text-white">Luar Daerah Dalam
                                                            Provinsi</span>
                                                    @else
                                                        <span class="badge bg-success text-white">Dalam Daerah Dalam
                                                            Kabupaten</span>
                                                    @endif
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
                                <label for="defaultconfig-2" class="col-form-label">Upload Dokumentasi</label>
                            </div>
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    {{-- <label class="form-label" for="formFile">File upload</label> --}}
                                    <input class="form-control" type="file" accept="image/*" name="foto" required
                                        id="pict">
                                    <div id="preview" class="my-3"
                                        style="aspect-ratio: 4/3; background-color:rgb(196, 196, 196);background-size: cover;scroll-snap-align: center;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <input class="form-control" maxlength="50" name="id_rencanakerja"
                                    value={{ $rencanakerja->id }} id="defaultconfig-3" type="text" required hidden>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ url('/kelolarencanakerja') }}" type="button" class="btn btn-secondary me-2"
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
    <script>
        document.getElementById('pict').addEventListener('change', function() {
            const [file] = document.getElementById('pict').files;
            document.getElementById('preview').style.backgroundImage = 'url(' + URL.createObjectURL(file) + ')';
        });
    </script>
@endpush
