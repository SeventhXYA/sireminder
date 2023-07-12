@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Akun</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Akun Pengguna</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="d-flex justify-content-end">
                        <a href="{{ url('/akun/add') }}" type="button" class="btn btn-primary btn-icon-text mb-3">
                            <i class="btn-icon-prepend" data-feather="plus"></i>
                            Tambah
                        </a>
                    </div> --}}
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:1rem;">No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Check</th>
                                    <th>Hak Akses</th>
                                    {{-- <th>Hak Akses</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $pg)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pg->nama_pegawai }}</td>
                                        <td>
                                            @if ($pg->user_id)
                                                {{ $pg->user->email }}
                                            @endif
                                        </td>
                                        <td>{{ $pg->jabatan->jabatan }}</td>
                                        <td class="text-center">
                                            @if ($pg->user_id)
                                                <span class="badge bg-success text-white"><i data-feather="check-circle"
                                                        class="icon-sm"></i></span>
                                            @else
                                                <span class="badge bg-danger text-white"><i data-feather="x-circle"
                                                        class="icon-sm"></i></span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($pg->user_id)
                                                {{-- {{ $pg->user->role->id }} --}}
                                                @if ($pg->user->id_role == 1)
                                                    <span class="badge bg-danger text-white">Ajudan</span>
                                                @elseif ($pg->user->id_role == 2)
                                                    <span class="badge bg-success text-white">Staff</span>
                                                @else
                                                    <span class="badge bg-primary text-white">Bupati</span>
                                                @endif
                                            @else
                                            @endif
                                        </td>
                                        <td class="d-flex inline">
                                            @if ($pg->user_id)
                                                <button type="button" class="btn btn-outline-secondary btn-icon btn-xs"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#lihatUser-{{ $pg->user->id }}"><i data-feather="eye"
                                                        class="icon-sm"></i>
                                                </button>
                                                <div class="modal fade" id="lihatUser-{{ $pg->user->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                    Detail Akun Pengguna</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="btn-close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col mb-3">
                                                                    <label class="form-label fw-bold">Nama Pegawai</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $pg->nama_pegawai }}" readonly
                                                                        style="background-color: #f5f5f5;" />
                                                                </div>
                                                                <div class="col mb-3">
                                                                    <label class="form-label fw-bold">Username</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $pg->user->username }}" readonly
                                                                        style="background-color: #f5f5f5;" />
                                                                </div>
                                                                <div class="col mb-3">
                                                                    <label class="form-label fw-bold">Hak Akses</label><br>
                                                                    @if ($pg->user->id_role == 1)
                                                                        <span
                                                                            class="badge bg-danger text-white">Ajudan</span>
                                                                    @elseif ($pg->user->id_role == 2)
                                                                        <span
                                                                            class="badge bg-success text-white">Staff</span>
                                                                    @else
                                                                        <span
                                                                            class="badge bg-primary text-white">Bupati</span>
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
                                                <a href="/akun/edit/{{ $pg->user->id }}"
                                                    class="btn btn-outline-warning btn-icon btn-xs mx-2"><i
                                                        data-feather="edit" class="icon-sm"></i></a>
                                                <form name="delete" action="{{ route('user.delete', $pg->user) }}"
                                                    method="POST">
                                                    @method('delete') @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-icon btn-xs"data-id="{{ $pg->user->id }}"><i
                                                            data-feather="trash" class="icon-sm"></i></button>
                                                </form>
                                            @else
                                                <a href="/akun/add/{{ $pg->id }}"
                                                    class="btn btn-outline-primary btn-icon btn-xs me-2"><i
                                                        data-feather="plus" class="icon-sm"></i></a>
                                            @endif
                                        </td>
                                    </tr>
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
