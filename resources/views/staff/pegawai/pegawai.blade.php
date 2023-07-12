@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pegawai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Pegawai</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('/pegawai/add') }}" type="button" class="btn btn-primary btn-icon-text mb-3">
                            <i class="btn-icon-prepend" data-feather="plus"></i>
                            Tambah
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:1rem;">No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No Hp</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                    {{-- <th style="width:2rem;">Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $pg)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pg->nama_pegawai }}</td>
                                        <td>{{ $pg->jk }}</td>
                                        <td>{{ $pg->nohp }}</td>
                                        <td>
                                            @if ($pg->user_id)
                                                {{ $pg->user->email }}
                                            @endif
                                        </td>
                                        <td>{{ $pg->jabatan->jabatan }}</td>
                                        <td class="d-flex inline">
                                            <a href="/pegawai/edit/{{ $pg->id }}"
                                                class="btn btn-outline-warning btn-icon btn-xs me-2"><i data-feather="edit"
                                                    class="icon-sm"></i></a>
                                            <form name="delete" action="{{ route('pegawai.delete', $pg) }}"
                                                method="POST">
                                                @method('delete') @csrf
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-icon btn-xs"data-id="{{ $pg->id }}"><i
                                                        data-feather="trash" class="icon-sm"></i></button>
                                            </form>
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
