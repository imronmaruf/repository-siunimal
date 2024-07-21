@extends('admin.layouts.main')

@push('title')
    Data User
@endpush

@push('css')
    <style>
        .log {
            margin-left: 1.5rem !important;
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
                            <li class="breadcrumb-item active">Data Kerja Praktek</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- VIEW UNTUK ADMIN --}}
        @can('admin-only')
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Data Kerja Praktek</h3>
                                    <p class="card-text">Data yang belum lengkap dapat diupdate di kemudian hari pada halaman
                                        ini</p>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('data-kp.create') }}" class="btn btn-outline-primary me-2">
                                        <i class="fas fa-plus"></i> Tambah
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable"
                                    class="display table border-0 star-student table-hover table-center mb-0 table-striped no-footer"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Mahasiswa</th>
                                            <th>Dospem</th>
                                            <th>Judul</th>
                                            <th>Latar Belakang</th>
                                            <th>Laporan</th>
                                            <th>Nilai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataKp as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ optional($data->mahasiswa)->name ?? 'N/A' }}</td>
                                                <td>{{ optional($data->dosenPembimbing)->name ?? 'N/A' }}</td>
                                                <td>{{ $data->judul_kp ?? 'N/A' }}</td>
                                                <td>{{ $data->latar_belakang ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($data->laporan)
                                                        <a href="{{ asset('admin/repo/kp/laporan/' . $data->laporan) }}"
                                                            target="_blank">Download</a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $data->nilai ?? 'N/A' }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="{{ route('data-kp.edit', $data->id) }}"
                                                            class="btn btn-sm btn-warning text-white">
                                                            <i class="feather-edit text-white"></i> Edit
                                                        </a>
                                                        <a href="{{ route('data-kp.show', $data->id) }}"
                                                            class="btn btn-sm btn-success text-white">
                                                            <i class="feather-eye text-white"></i> Detail
                                                        </a>
                                                        <form action="{{ route('data-kp.destroy', $data->id) }}" method="POST"
                                                            id="deleteForm{{ $data->id }}">
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
                                            <th>No.</th>
                                            <th>Mahasiswa</th>
                                            <th>Dospem</th>
                                            <th>Judul</th>
                                            <th>Latar Belakang</th>
                                            <th>Laporan</th>
                                            <th>Nilai</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        {{-- VIEW UNTUK MAHASISWA --}}
        @can('mahasiswa-only')
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Data Kerja Praktek</h3>
                                    <p class="card-text">
                                        Data yang belum lengkap dapat diupdate di kemudian hari pada halaman ini<br>
                                        Kerja Praktek dan Tugas Akhir hanya bisa diupload sekali, jika ada kesalahan silahkan
                                        update kembali data anda!!
                                    </p>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('data-kp.create') }}" class="btn btn-outline-primary me-2">
                                        <i class="fas fa-plus"></i> Tambah
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable"
                                    class="display table border-0 star-student table-hover table-center mb-0 table-striped no-footer"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul</th>
                                            <th>Latar Belakang</th>
                                            <th>Nilai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dataKp as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->judul_kp ?? 'N/A' }}</td>
                                                <td>{{ $data->latar_belakang ?? 'N/A' }}</td>
                                                <td>{{ $data->nilai ?? 'N/A' }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="{{ route('data-kp.edit', $data->id) }}"
                                                            class="btn btn-sm btn-warning text-white">
                                                            <i class="feather-edit text-white"></i> Edit
                                                        </a>
                                                        <a href="{{ route('data-kp.show', $data->id) }}"
                                                            class="btn btn-sm btn-success text-white">
                                                            <i class="feather-eye text-white"></i> Detail
                                                        </a>
                                                        <form action="{{ route('data-kp.destroy', $data->id) }}" method="POST"
                                                            id="deleteForm{{ $data->id }}">
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
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul</th>
                                            <th>Latar Belakang</th>
                                            <th>Nilai</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Data Kerja Praktek </h3>
                                    <h6 class="text-primary">{{ Auth::user()->name }}</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($dataKp->isNotEmpty())
                                @php $firstData = $dataKp->first(); @endphp
                                <table class="table table-striped table-bordered mb-0">
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ optional($firstData->mahasiswa)->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIM</th>
                                        <td>{{ optional($firstData->mahasiswa)->nim ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dospem</th>
                                        <td>{{ optional($firstData->dosenPembimbing)->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Judul</th>
                                        <td>{{ $firstData->judul_kp ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Laporan</th>
                                        <td>
                                            @if ($firstData->laporan)
                                                <a
                                                    href="{{ asset('admin/repo/kp/laporan/' . $firstData->laporan) }}">Download</a>
                                            @else
                                                <span class="badge bg-danger">Belum Upload</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>GitHub Project</th>
                                        <td>
                                            @if ($firstData->link_github)
                                                <a href="{{ $firstData->link_github }}" target="__blank">GitHub</a>
                                            @else
                                                <span class="badge bg-danger">Belum Ditambahkan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Gdrive Project</th>
                                        <td>
                                            @if ($firstData->link_gdrive)
                                                <a href="{{ $firstData->link_gdrive }}" target="__blank">GDrive</a>
                                            @else
                                                <span class="badge bg-danger">Belum Ditambahkan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Distribusi</th>
                                        <td>
                                            @if ($firstData->bukti_distribusi)
                                                <a
                                                    href="{{ asset('admin/repo/kp/bukti-distribusi/' . $firstData->bukti_distribusi) }}">Download</a>
                                            @else
                                                <span class="badge bg-danger">Belum Upload</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nilai</th>
                                        <td>
                                            @if ($firstData->bukti_nilai)
                                                <a
                                                    href="{{ asset('admin/repo/kp/bukti-nilai/' . $firstData->bukti_nilai) }}">Download</a>
                                            @else
                                                <span class="badge bg-danger">Belum Upload</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            @else
                                <p class="text-center">Tidak ada data kerja praktek.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection

@push('js')
    <script>
        function confirmDelete(id) {
            let form = document.getElementById('deleteForm' + id);
            Swal.fire({
                title: 'Apakah anda yakin?',
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

        let warningMessage = '{{ session('warning') }}';
        if (warningMessage !== '') {
            Swal.fire({
                icon: "warning",
                title: "Perhatian!",
                text: warningMessage,
                showConfirmButton: true
            });
        }
        let infoMessage = '{{ session('info') }}';
        if (infoMessage) {
            Swal.fire({
                icon: "info",
                title: "Info",
                text: infoMessage,
                showConfirmButton: true,
            });
        }
    </script>
@endpush
