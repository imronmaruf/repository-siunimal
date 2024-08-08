@extends('admin.layouts.main')

@push('title')
    Pengaturan Data Akun
@endpush

@push('css')
    <style>
        .profile-header {
            text-align: center;
        }

        .profile-user-info {
            text-align: center;
        }

        .profile-image img {
            max-width: 150px;
        }

        #password_tab {
            display: none;
        }

        #password_tab.active {
            display: block;
        }

        #biodata_tab {
            display: none;
        }

        #biodata_tab.active {
            display: block;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="profile-header">
                            <div class="profile-image">
                                @if (Auth::check() && Auth::user()->mahasiswa)
                                    <img src="{{ asset('admin/img/foto/' . Auth::user()->mahasiswa->foto) }}" alt="Foto"
                                        class="rounded-circle">
                                @else
                                    <img class="rounded-circle" alt="User Image"
                                        src="{{ asset('admin/assets/img/fav.png') }}">
                                @endif
                            </div>
                            <div class="profile-user-info mt-3">
                                <h4 class="user-name mb-0">{{ Auth::user()->name }}</h4>
                                <h6 class="text-muted">{{ Auth::user()->mahasiswa->nim ?? Auth::user()->role }}</h6>
                                <div class="user-location"><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</div>
                            </div>
                        </div>

                        <div class="profile-menu mt-2">
                            <ul class="nav nav-tabs nav-tabs-solid flex-column">
                                @if (Auth::user()->role != 'admin')
                                    <li class="nav-item">
                                        <a class="nav-link @if (Auth::user()->role == 'mahasiswa') active @endif"
                                            data-bs-toggle="tab" href="#biodata_tab" id="about-tab">About</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link @if (Auth::user()->role == 'admin' ||
                                            (Auth::user()->role == 'mahasiswa' && request()->route()->getName() === 'password')) active @endif" data-bs-toggle="tab"
                                        href="#password_tab" id="password-tab">Password</a>
                                </li>
                            </ul>
                        </div>

                        @if (Auth::user()->role != 'admin')
                            <div class="table mt-2">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Status Kerja Praktek</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($dataKp && $dataKp->laporan)
                                                    <span class="badge bg-success">Selesai</span>
                                                    <a href="{{ asset('/admin/repo/kp/laporan/' . $dataKp->laporan) }}"
                                                        class="btn btn-link text-primary" target="__blank">
                                                        <i class="far fa-file-pdf me-1 text-primary"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">Belum Selesai</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status Tugas Akhir</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($dataTga)
                                                    <span class="badge bg-success">Selesai</span>
                                                    <a href="{{ asset('/admin/repo/tga/laporan/' . $dataTga->laporan) }}"
                                                        class="btn btn-link text-primary ms-2" target="__blank">
                                                        <i class="far fa-file-pdf me-1">file</i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">Belum Selesai</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-6">
                @if (Auth::user()->role != 'admin')
                    <div id="biodata_tab" class="card mb-4 @if (Auth::user()->role == 'mahasiswa') active @endif">
                        <div class="card-header">
                            <h3 class="card-title d-flex justify-content-between">
                                <span>Biodata</span>
                                <a class="edit-link" data-bs-toggle="modal" href="#editProfile"><i
                                        class="far fa-edit me-1"></i>Edit</a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>HP</th>
                                        <td>{{ $mahasiswa->hp ?? '_' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dosen Pembimbing KP</th>
                                        <td>{{ $mahasiswa->dosenPembimbingKp->name ?? '_' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dosen Pembimbing Utama TGA</th>
                                        <td>{{ $mahasiswa->dosenPembimbingTga1->name ?? '_' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dosen Pembimbing Pendamping TGA</th>
                                        <td>{{ $mahasiswa->dosenPembimbingTga2->name ?? '_' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dosen Penguji TGA Utama</th>
                                        <td>{{ $mahasiswa->dosenPengujiTga1->name ?? '_' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dosen Penguji TGA Pendamping</th>
                                        <td>{{ $mahasiswa->dosenPengujiTga2->name ?? '_' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                <div id="password_tab" class="card @if (Auth::user()->role == 'admin') active @endif">
                    <div class="card-body">
                        <h5 class="card-title">Rubah Password</h5>
                        <form id="update-password-form" action="{{ route('profile-setting.update-password') }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" name="old_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>
                            <button id="save-password-btn" class="btn btn-primary" type="button">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    @include('admin.profile-setting.modal')
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordTab = document.getElementById('password_tab');
            const biodataTab = document.getElementById('biodata_tab');

            // Atur tab aktif berdasarkan role user
            if ({{ Auth::user()->role == 'admin' ? 'true' : 'false' }}) {
                passwordTab.classList.add('active');
                biodataTab.classList.remove('active');
            } else {
                biodataTab.classList.add('active');
                passwordTab.classList.remove('active');
            }

            // Tambahkan event listener untuk tab
            document.querySelectorAll('.profile-menu .nav-link').forEach(tab => {
                tab.addEventListener('click', function() {
                    if (this.id === 'password-tab') {
                        biodataTab.classList.remove('active'); // Sembunyikan biodata
                        passwordTab.classList.add('active'); // Tampilkan password
                    } else {
                        biodataTab.classList.add('active'); // Tampilkan biodata
                        passwordTab.classList.remove('active'); // Sembunyikan password
                    }
                });
            });

            document.getElementById('save-password-btn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Yakin untuk mengubah password?',
                    text: "Perubahan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('update-password-form').submit();
                    }
                });
            });
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
