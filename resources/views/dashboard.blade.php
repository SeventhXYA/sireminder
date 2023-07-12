@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    @if (auth()->user()->id_role == 1)
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Jumlah Pengguna</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ url('/pegawai') }}" class="dropdown-item d-flex align-items-center"
                                                href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $akun }}</h3>
                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-primary" data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Surat Masuk Untuk Bupati Bulan Ini</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ url('/jabatan') }}" class="dropdown-item d-flex align-items-center"
                                                href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $suratmasukbupati }}</h3>
                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-warning" data-feather="mail"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Rencana Kerja Bulan Ini</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <a href="{{ url('/suratmasuk') }}"class="dropdown-item d-flex align-items-center"
                                                href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $rencanakerja }}</h3>

                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-success" data-feather="calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->

        <div class="row">
            <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Projects</h6>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th style="width:1rem;">No</th>
                                        <th>Lihat</th>
                                        <th>Pengirim</th>
                                        <th>Tgl Masuk</th>
                                        <th>Perihal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratmasuktable as $sm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-secondary btn-icon btn-xs"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#lihatSurat-{{ $sm->id }}"><i data-feather="eye"
                                                        class="icon-sm"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <?php
                                                $num_char = 30;
                                                $text = $sm->pengirim;
                                                if (strlen($text) > $num_char) {
                                                    $text = substr($text, 0, $num_char) . '...';
                                                }
                                                echo $text;
                                                ?>
                                            </td>
                                            <td>{{ $sm->created_at->format('d-M-Y') }}</td>
                                            <td>
                                                <?php
                                                $num_char = 30;
                                                $text = $sm->perihal;
                                                if (strlen($text) > $num_char) {
                                                    $text = substr($text, 0, $num_char) . '...';
                                                }
                                                echo $text;
                                                ?>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="lihatSurat-{{ $sm->id }}" tabindex="-1"
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
                                                                value="{{ $sm->pengirim }}" readonly
                                                                style="background-color: #f5f5f5;" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Nomor Surat</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $sm->no_surat }}" readonly
                                                                style="background-color: #f5f5f5;" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Tanggal Surat</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($sm->tgl_surat)->format('d-M-Y') }}"
                                                                readonly style="background-color: #f5f5f5;" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Tanggal Masuk</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $sm->created_at->format('d-M-Y') }}" readonly
                                                                style="background-color: #f5f5f5;" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Perihal</label>
                                                            <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4" name="perihal" maxlength="2500"
                                                                rows="10" readonly style="background-color: #f5f5f5;">{{ $sm->perihal }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Kategori Surat Masuk</h6>

                        </div>
                        {{-- <div id="storageChart"></div> --}}
                        <canvas id="chartjsDoughnut"></canvas>

                    </div>
                </div>
            </div>
        </div> <!-- row -->
    @endif
    {{-- ================================================================== --}}
    @if (auth()->user()->id_role == 2)
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Jumlah Pegawai</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ url('/pegawai') }}"
                                                class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $pegawai }}</h3>
                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-primary" data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Jabatan</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ url('/jabatan') }}"
                                                class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $jabatan }}</h3>
                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-warning" data-feather="list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Surat Masuk Bulan Ini</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <a href="{{ url('/suratmasuk') }}"class="dropdown-item d-flex align-items-center"
                                                href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $suratmasuk }}</h3>

                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-success" data-feather="mail"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->


        <div class="row">
            <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Surat Masuk</h6>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th style="width:1rem;">No</th>
                                        <th>Lihat</th>
                                        <th>Pengirim</th>
                                        <th>Tgl Masuk</th>
                                        <th>Perihal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratmasuktable as $sm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-secondary btn-icon btn-xs"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#lihatSurat-{{ $sm->id }}"><i
                                                        data-feather="eye" class="icon-sm"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <?php
                                                $num_char = 30;
                                                $text = $sm->pengirim;
                                                if (strlen($text) > $num_char) {
                                                    $text = substr($text, 0, $num_char) . '...';
                                                }
                                                echo $text;
                                                ?>
                                            </td>
                                            <td>{{ $sm->created_at->format('d-M-Y') }}</td>
                                            <td>
                                                <?php
                                                $num_char = 30;
                                                $text = $sm->perihal;
                                                if (strlen($text) > $num_char) {
                                                    $text = substr($text, 0, $num_char) . '...';
                                                }
                                                echo $text;
                                                ?>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="lihatSurat-{{ $sm->id }}" tabindex="-1"
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
                                                                value="{{ $sm->pengirim }}" readonly
                                                                style="background-color: #f5f5f5;" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Nomor Surat</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $sm->no_surat }}" readonly
                                                                style="background-color: #f5f5f5;" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Tanggal Surat</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($sm->tgl_surat)->format('d-M-Y') }}"
                                                                readonly style="background-color: #f5f5f5;" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Tanggal Masuk</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $sm->created_at->format('d-M-Y') }}" readonly
                                                                style="background-color: #f5f5f5;" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label class="form-label fw-bold">Perihal</label>
                                                            <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4" name="perihal" maxlength="2500"
                                                                rows="10" readonly style="background-color: #f5f5f5;">{{ $sm->perihal }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Kategori Surat Masuk</h6>
                        </div>
                        <canvas id="chartjsDoughnut"></canvas>

                    </div>
                </div>
            </div>
        </div> <!-- row -->
    @endif
    {{-- ================================================================== --}}
    @if (auth()->user()->id_role == 3)
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Surat Masuk Bulan Ini</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ url('/pegawai') }}"
                                                class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $suratmasuk }}</h3>
                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-primary" data-feather="mail"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Surat Masuk Perlu Persetujuan</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ url('/jabatan') }}"
                                                class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $pending }}</h3>
                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-warning" data-feather="clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Rencana Kerja Bulan Ini</h6>
                                    <div class="dropdown mb-2">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <a href="{{ url('/suratmasuk') }}"class="dropdown-item d-flex align-items-center"
                                                href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span
                                                    class="">View</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-8">
                                        <h3 class="mb-2">{{ $rencanakerja }}</h3>

                                    </div>
                                    <div class="col-4 col-md-12 col-xl-4">
                                        <i class="link-icon icon-xxl text-success" data-feather="calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
        <div class="row">
            <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class=" d-none d-md-flex justify-content-end">
                            <form action="{{ route('cetak.pdf.rencanakerja') }}" method="GET">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex inline  mb-3 me-2">
                                        <input type="date" class="form-control" name="start_date">

                                        <div><i class="link-icon icon-sm mt-3 mx-2" data-feather="minus"></i></div>
                                        <input type="date" class="form-control" name="end_date">
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-icon-text mb-3"><i
                                            class="btn-icon-prepend" data-feather="printer"></i>Cetak PDF</button>

                                </div>
                            </form>
                        </div>
                        <div class="d-inline d-md-none justify-content-end">
                            <form action="{{ route('cetak.pdf.rencanakerja') }}" method="GET">
                                <div class="d-flex inline  mb-3 me-2">
                                    <input type="date" class="form-control" name="start_date">

                                    <div><i class="link-icon icon-sm mt-3 mx-2" data-feather="minus"></i></div>
                                    <input type="date" class="form-control" name="end_date">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-danger btn-icon-text mb-3"><i
                                            class="btn-icon-prepend" data-feather="printer"></i>Cetak PDF</button>
                                </div>
                            </form>
                        </div>
                        <div id='fullcalendar'></div>
                    </div>
                </div>
                <div class="modal fade" id="lihatRencana" tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col mb-3">
                                    <label class="form-label fw-bold">Tanggal
                                        Mulai Kegiatan</label>
                                    <input type="text" class="form-control" id="start_date" readonly
                                        style="background-color: #f5f5f5;" />
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label fw-bold">Tanggal
                                        Selesai Kegiatan</label>
                                    <input type="text" class="form-control" id="end_date" readonly
                                        style="background-color: #f5f5f5;" />
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label fw-bold">Rencana</label>
                                    <textarea class="form-control" id="rencana" maxlength="255" rows="8" readonly
                                        style="background-color: #f5f5f5;"></textarea>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label fw-bold">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi" readonly
                                        style="background-color: #f5f5f5;" />
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Kategori Rencana Kerja</h6>
                        </div>

                        {{-- <div id="storageChart"></div> --}}
                        <canvas id="chartjsDoughnut2"></canvas>

                    </div>
                </div>
            </div>
        </div> <!-- row -->
    @endif
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>

    <script>
        var colors = {
            primary: "#6571ff",
            secondary: "#7987a1",
            success: "#05a34a",
            info: "#66d1d1",
            warning: "#fbbc06",
            danger: "#ff3366",
            light: "#e9ecef",
            dark: "#060c17",
            muted: "#7987a1",
            gridBorder: "rgba(77, 138, 240, .15)",
            bodyColor: "#000",
            cardBg: "#fff",
        };
        var fontFamily = "'Roboto', Helvetica, sans-serif";
        var ctx = document.getElementById('chartjsDoughnut').getContext('2d');
        var data1 = @json($data1);
        var data2 = @json($data2);

        var chart = new Chart(ctx, {
            // new Chart($("#chartjsDoughnut"), {
            type: "doughnut",
            data: {
                labels: ["Untuk Bupati", "Kegiatan Lain"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: [
                        colors.danger,
                        colors.success,
                        // colors.info,
                    ],
                    borderColor: colors.cardBg,
                    data: [data1, data2],
                }, ],
            },
            options: {
                aspectRatio: 1,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: colors.bodyColor,
                            font: {
                                size: "13px",
                                family: fontFamily,
                            },
                        },
                    },
                },
            },
        });
    </script>

    <script>
        var colors = {
            primary: "#6571ff",
            secondary: "#7987a1",
            success: "#05a34a",
            info: "#66d1d1",
            warning: "#fbbc06",
            danger: "#ff3366",
            light: "#e9ecef",
            dark: "#060c17",
            muted: "#7987a1",
            gridBorder: "rgba(77, 138, 240, .15)",
            bodyColor: "#000",
            cardBg: "#fff",
        };
        var fontFamily = "'Roboto', Helvetica, sans-serif";
        var ctx = document.getElementById('chartjsDoughnut2').getContext('2d');
        var rencana1 = @json($rencana1);
        var rencana2 = @json($rencana2);
        var rencana3 = @json($rencana3);

        var chart = new Chart(ctx, {
            // new Chart($("#chartjsDoughnut"), {
            type: "doughnut",
            data: {
                labels: ["LDLP", "LDDP", "DDDK"],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: [
                        colors.danger,
                        colors.primary,
                        colors.success,
                        // colors.info,
                    ],
                    borderColor: colors.cardBg,
                    data: [rencana1, rencana2, rencana3],
                }, ],
            },
            options: {
                aspectRatio: 1,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: colors.bodyColor,
                            font: {
                                size: "13px",
                                family: fontFamily,
                            },
                        },
                    },
                },
            },
        });
    </script>

    <script>
        $(document).ready(function() {
            var calendar = $('#fullcalendar').fullCalendar({
                editable: false,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: '/events',
                displayEventTime: false,
                selectable: true,
                selectHelper: true,

                eventRender: function(event, element) {
                    element.css('background-color', event.color);
                },
                eventClick: function(event) {
                    $.get('/events/' + event.id, function(data) {
                        $('#exampleModalScrollableTitle').text('Detail Rencana Kerja');
                        $('#lihatRencana').modal('show');
                        $('#start_date').val(moment(data.start_date).format(
                            'YYYY-MM-DD HH:mm:ss'));
                        $('#end_date').val(moment(data.end_date).format(
                            'YYYY-MM-DD HH:mm:ss'));
                        $('#rencana').val(data.rencana);
                        $('#lokasi').val(data.lokasi);
                    });
                },
            });
        });
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
@endpush
