@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Surat Masuk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Surat Masuk</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('cetak.pdf.suratmasuk') }}" method="GET">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex inline  mb-3 me-2">
                                    <input type="date" class="form-control" name="start_date">
                                    <div><i class="link-icon icon-sm mt-3 mx-2" data-feather="minus"></i></div>
                                    <input type="date" class="form-control" name="end_date">
                                </div>
                                <button type="submit" class="btn btn-danger btn-icon-text mb-3"><i class="btn-icon-prepend"
                                        data-feather="printer"></i>Cetak PDF</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:1rem;">No</th>
                                    <th style="width:1rem;">Lihat</th>
                                    <th>Pengirim</th>
                                    <th style="width:1rem;">Tanggal Masuk</th>
                                    <th>Perihal</th>
                                    <th style="width:1rem;">Kategori</th>
                                    <th style="width:1rem;">Status</th>
                                    <th style="width:1rem;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratmasuk as $sm)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-secondary btn-icon btn-xs"
                                                data-bs-toggle="modal" data-bs-target="#lihatSurat-{{ $sm->id }}"><i
                                                    data-feather="eye" class="icon-sm"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <?php
                                            $num_char = 20;
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
                                        <td class="text-center">
                                            @if ($sm->id_status)
                                                @if ($sm->status->kategori == 1)
                                                    <span class="badge bg-danger text-white">Untuk Bupati</span>
                                                @elseif ($sm->status->kategori == 2)
                                                    <span class="badge bg-success text-white">Kegiatan Lain</span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary text-white">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($sm->id_status)
                                                @if ($sm->status->status == 0)
                                                    <span class="badge bg-secondary text-white">-</span>
                                                @elseif ($sm->status->status == 1)
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @elseif ($sm->status->status == 2)
                                                    <span class="badge bg-success text-white">Approved</span>
                                                @elseif ($sm->status->status == 3)
                                                    <span class="badge bg-danger text-white">Declined</span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary text-white">-</span>
                                            @endif
                                        </td>
                                        <td class="d-flex inline">
                                            @if ($sm->id_status)
                                                @if ($sm->status->status == 0 || $sm->status->status == 1)
                                                    <a href="/status/edit/{{ $sm->status->id }}"
                                                        class="btn btn-outline-warning btn-icon btn-xs me-2"><i
                                                            data-feather="edit" class="icon-sm"></i></a>
                                                    <form action="{{ route('move-data', ['id' => $sm->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-outline-danger btn-icon btn-xs"
                                                            data-id="{{ $sm->id }}"><i data-feather="trash"
                                                                class="icon-sm"></i></button>
                                                    </form>
                                                @endif
                                            @else
                                                <a href="/status/add/{{ $sm->id }}"
                                                    class="btn btn-outline-warning btn-icon btn-xs me-2"><i
                                                        data-feather="edit" class="icon-sm"></i></a>
                                                <form action="{{ route('move-data', ['id' => $sm->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-icon btn-xs"
                                                        data-id="{{ $sm->id }}"><i data-feather="trash"
                                                            class="icon-sm"></i></button>
                                                </form>

                                                {{-- <form name="delete" action="{{ route('suratmasuk.delete', $sm) }}"
                                                    method="POST">
                                                    @method('delete') @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-icon btn-xs"
                                                        data-id="{{ $sm->id }}"><i data-feather="trash"
                                                            class="icon-sm"></i></button>
                                                </form> --}}
                                            @endif
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
                                                        @if ($sm->no_surat)
                                                            <input type="text" class="form-control"
                                                                value="{{ $sm->no_surat }}" readonly
                                                                style="background-color: #f5f5f5;" />
                                                        @else
                                                            <input type="text" class="form-control" value="-"
                                                                readonly style="background-color: #f5f5f5;" />
                                                        @endif
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Tanggal Surat</label>
                                                        @if ($sm->tgl_surat)
                                                            <input type="text" class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($sm->tgl_surat)->format('d-M-Y') }}"
                                                                readonly style="background-color: #f5f5f5;" />
                                                        @else
                                                            <input type="text" class="form-control" value="-"
                                                                readonly style="background-color: #f5f5f5;" />
                                                        @endif
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Tanggal Masuk</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $sm->created_at->format('d-M-Y') }}" readonly
                                                            style="background-color: #f5f5f5;" />
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Perihal</label>
                                                        <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4" name="perihal" maxlength="255"
                                                            rows="8" readonly style="background-color: #f5f5f5;">{{ $sm->perihal }}</textarea>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Kategori</label><br>
                                                        @if ($sm->id_status)
                                                            @if ($sm->status->kategori == 1)
                                                                <span class="badge bg-danger text-white">Untuk
                                                                    Bupati</span>
                                                            @elseif ($sm->status->kategori == 2)
                                                                <span class="badge bg-success text-white">Kegiatan
                                                                    Lain</span>
                                                            @endif
                                                        @else
                                                            <span class="badge bg-secondary text-white">-</span>
                                                        @endif
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Status</label><br>
                                                        @if ($sm->id_status)
                                                            @if ($sm->status->status == 0)
                                                                <span class="badge bg-secondary text-white">-</span>
                                                            @elseif ($sm->status->status == 1)
                                                                <span class="badge bg-warning text-white">Pending</span>
                                                            @elseif ($sm->status->status == 2)
                                                                <span class="badge bg-success text-white">Approved</span>
                                                            @elseif ($sm->status->status == 3)
                                                                <span class="badge bg-danger text-white">Declined</span>
                                                            @endif
                                                        @else
                                                            <span class="badge bg-secondary text-white">-</span>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        @if (Session::has('success'))
            window.onload = () => showSwal('custom-position', '{{ Session::get('success') }}')
        @endif

        document.querySelectorAll('form[name="delete"]').forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault()
                Swal.fire({
                    title: 'Apa anda yakin?',
                    text: "Setelah data dihapus, data tidak bisa dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit()
                    }
                });
            });
        });
    </script>
@endpush
