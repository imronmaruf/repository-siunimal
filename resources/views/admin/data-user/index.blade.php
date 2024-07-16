@extends('admin.layouts.main')


@push('title')
    Data User
@endpush

@push('css')
    <style>
        .log {
            margin-left: 1.5 rem !important;
        }
    </style>
@endpush
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Data User</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Data User</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalAdd"
                                    class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i>
                                    Download</button>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-4 p-4 rounded-md">
                                <div class="d-flex align-items-center mb-2 gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" data-lucide="alert-triangle"
                                        class="lucide lucide-alert-triangle inline-block size-4 mt-0.5 shrink-0">
                                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z">
                                        </path>
                                        <path d="M12 9v4"></path>
                                        <path d="M12 17h.01"></path>
                                    </svg>
                                    <h6 class="mb-1">Ada kesalahan pada input anda!</h6>
                                </div>
                                <ul class="log mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    {{-- <div class="card-header">
                        <h5 class="card-title mb-2">Default Datatable</h5>
                        <p class="card-text">
                            This is the most basic example of the datatables with zero configuration. Use the
                            <code>.datatable</code> class to initialize datatables.
                        </p>
                    </div> --}}
                    <div class="card-body">

                        <div class="table-responsive">
                            <div id="DataTables">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="dataTable"
                                            class="display table border-0 star-student table-hover table-center mb-0  table-striped no-footer"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataUser as $data)
                                                    <tr>
                                                        <td>{{ $data->name }}</td>
                                                        <td>{{ $data->email }}</td>
                                                        <td>{{ $data->role }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <button type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#modalEdit{{ $data->id }}"
                                                                    class="btn btn-sm btn-warning text-white"><i
                                                                        class="feather-edit text-white"></i> Edit</button>
                                                                <a href="#"
                                                                    class="btn btn-sm btn-success text-white"><i
                                                                        class="feather-eye text-white"></i> Detail</a>
                                                                <form action="{{ route('data-user.destroy', $data->id) }}"
                                                                    method="POST" id="deleteForm{{ $data->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" data-tooltip="default"
                                                                        class="btn btn-sm btn-danger"
                                                                        onclick="confirmDelete('{{ $data->id }}')">
                                                                        <i class="feather-trash text-white"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.data-user.modal')
@endsection
@push('js')
    <script>
        function confirmDelete(id) {
            let form = document.getElementById('deleteForm' + id);
            Swal.fire({
                title: 'Apakah anda Yakin?',
                text: "Data akan dihapus secara permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

            let errorMessage = '{{ session('error') }}';
            if (errorMessage !== '') {
                Swal.fire({
                    icon: "error",
                    title: "Ooops!",
                    text: errorMessage,
                    showConfirmButton: true,
                });
            }
        }

        let errorMessage = '{{ session('error') }}';
        if (errorMessage !== '') {
            Swal.fire({
                icon: "error",
                title: "Ooops!",
                text: errorMessage,
                showConfirmButton: true,
            });
        }

        let successMessage = '{{ session('success') }}';
        if (successMessage !== '') {
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: successMessage,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
@endpush
