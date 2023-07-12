@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Jabatan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Jabatan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{-- <h6 class="card-title">Basic Form</h6> --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('/jabatan/add') }}" type="button" class="btn btn-primary btn-icon-text mb-3">
                            <i class="btn-icon-prepend" data-feather="plus"></i>
                            Tambah
                        </a>
                        {{-- <a href="{{ url('') }}" class="badge bg-info card-title">
                            <h6><i data-feather="plus" class="icon-sm"></i>
                                Tambah</h6>
                        </a> --}}
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:1rem;">No</th>
                                    <th>Jabatan</th>
                                    <th style="width:2rem;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jabatan as $jb)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jb->jabatan }}</td>
                                        <td class="d-flex inline">
                                            <a href="/jabatan/edit/{{ $jb->id }}"
                                                class="btn btn-outline-warning btn-icon btn-xs me-2"><i data-feather="edit"
                                                    class="icon-sm"></i></a>
                                            <form name="delete" action="{{ route('jabatan.delete', $jb) }}" method="POST">
                                                @method('delete') @csrf
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-icon btn-xs"data-id="{{ $jb->id }}"><i
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
