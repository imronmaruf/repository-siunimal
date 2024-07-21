@extends('admin.layouts.main')


@push('title')
    Data Mahasiswa
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
                            <li class="breadcrumb-item active">Data Mahasiswa</li>
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
                                <h3 class="page-title">Data Mahasiswa</h3>
                                {{-- <p class="card-text"> -
                                    Untuk menambahkan <code>Data Mahasiswa</code> silahkan tambahkan terlebih dahulu
                                    <code>Data User</code>.
                                    <br> - Setelah <code>Data User</code> ditambahkan atau Mahasiswa sendiri yang melakukan
                                    <code>Registrasi</code> maka data otomatis terisi di
                                    <code>Data Mahasiswa</code>
                                    </br>
                                </p> --}}
                            </div>
                            {{-- <div class="col-auto text-end float-end ms-auto download-grp">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalAdd"
                                    class="btn btn-outline-primary me-2"><i class="fas fa-plus"></i>
                                    Tambah</button>
                            </div> --}}
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered mb-0">
                                            <tr>
                                                <th>Nama </th>
                                                <th class="text-center">:</th>
                                                <td>{{ $dataMhs->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIM</th>
                                                <th class="text-center">:</th>
                                                <td>{{ $dataMhs->nim ?? '_' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Foto</th>
                                                <th class="text-center">:</th>
                                                <td><img src="{{ asset('admin/img/foto/' . $dataMhs->foto) }}"
                                                        alt="foto" class="img-fluid rounded"
                                                        style="max-width: 15%; height: auto;"></td>
                                            </tr>
                                            <tr>
                                                <th>HP</th>
                                                <th class="text-center">:</th>
                                                <td>{{ $dataMhs->hp ?? '_' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Dosen Pembimbing KP</th>
                                                <th class="text-center">:</th>
                                                <td>{{ $dataMhs->dosenPembimbingKp->name ?? '_' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Dosen Pembimbing Utama TGA </th>
                                                <th class="text-center">:</th>
                                                <td>{{ $dataMhs->dosenPembimbingTga1->name ?? '_' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Dosen Pembimbing Pendamping TGA </th>
                                                <th class="text-center">:</th>
                                                <td>{{ $dataMhs->dosenPembimbingTga2->name ?? '_' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Dosen Penguji TGA Utama </th>
                                                <th class="text-center">:</th>
                                                <td>{{ $dataMhs->dosenPengujiTga1->name ?? '_' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Dosen Penguji TGA Pendamping </th>
                                                <th class="text-center">:</th>
                                                <td>{{ $dataMhs->dosenPegujiTga2->name ?? '_' }}</td>
                                            </tr>


                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('data-mahasiswa.index') }}" class="btn btn-dark">&laquo;
                                        Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- @include('admin.data-dosen.modal') --}}
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
