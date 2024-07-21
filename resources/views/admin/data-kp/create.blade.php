@extends('admin.layouts.main')

@push('title')
    Data Mahasiswa
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Data Mahasiswa</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="page-title">Tambah Data Mahasiswa</h3>
                    </div>
                    <div class="card-body">
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

                    <div class="card-body">
                        <form action="{{ route('data-kp.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                @can('admin-only')
                                    <div class="col-md-12 mb-3">
                                        <label for="mahasiswa_id">Nama Lengkap</label>
                                        <select id="mahasiswa_id" name="mahasiswa_id"
                                            class="form-control form-select @error('mahasiswa_id') is-invalid @enderror"
                                            required>
                                            <option value="">Pilih Mahasiswa</option>
                                            @foreach ($mahasiswas as $mahasiswa)
                                                <option value="{{ $mahasiswa->id }}" data-nim="{{ $mahasiswa->nim }}"
                                                    data-dosen="{{ optional($mahasiswa->dosenPembimbingKp)->name }}">
                                                    {{ $mahasiswa->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('mahasiswa_id')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="hidden" id="dosen_pembimbing" name="dosen_pembimbing"
                                            value="{{ optional($mahasiswas->first()->dosenPembimbingKp)->name }}">
                                    </div>
                                @else
                                    <div class="col-md-6 mb-3">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ Auth::user()->name }}" readonly>
                                        <input type="hidden" name="mahasiswa_id"
                                            value="{{ optional($mahasiswas->first())->id }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nim">NIM</label>
                                        <input type="number" class="form-control" id="nim" name="nim"
                                            value="{{ $nim }}" required readonly>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="dosen_pembimbing">Dosen Pembimbing</label>
                                        <input type="text" class="form-control" id="dosen_pembimbing" name="dosen_pembimbing"
                                            value="{{ optional($mahasiswas->first()->dosenPembimbingKp)->name }}" required
                                            readonly>
                                    </div>
                                @endcan
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="judul_kp">Judul</label>
                                    <textarea id="judul_kp" name="judul_kp" rows="3" class="form-control @error('judul_kp') is-invalid @enderror"
                                        placeholder="Enter text here">{{ old('judul_kp') }}</textarea>
                                    @error('judul_kp')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="latar_belakang">Latar Belakang</label>
                                    <textarea id="latar_belakang" name="latar_belakang" rows="5"
                                        class="form-control @error('latar_belakang') is-invalid @enderror" placeholder="Enter text here">{{ old('latar_belakang') }}</textarea>
                                    @error('latar_belakang')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="nilai">Nilai akhir</label>
                                    <input id="nilai" name="nilai" type="number"
                                        class="form-control @error('nilai') is-invalid @enderror"
                                        value="{{ old('nilai') }}">
                                    @error('nilai')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="link_github">Link project Github</label>
                                    <input id="link_github" name="link_github" type="text"
                                        class="form-control @error('link_github') is-invalid @enderror"
                                        value="{{ old('link_github') }}">
                                    @error('link_github')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="link_gdrive">Link project GDrive <code>(.Zip, .rar)</code></label>
                                    <input id="link_gdrive" name="link_gdrive" type="text"
                                        class="form-control @error('link_gdrive') is-invalid @enderror"
                                        value="{{ old('link_gdrive') }}">
                                    @error('link_gdrive')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="laporan">Laporan KP <code>format : .pdf, .doc, .docx</code></label>
                                    <input id="laporan" name="laporan" type="file"
                                        class="form-control @error('laporan') is-invalid @enderror">
                                    @error('laporan')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="bukti_distribusi">Bukti Distribusi <code>scan .pdf</code></label>
                                    <input id="bukti_distribusi" name="bukti_distribusi" type="file"
                                        class="form-control @error('bukti_distribusi') is-invalid @enderror">
                                    @error('bukti_distribusi')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="bukti_nilai">File Nilai <code>scan .pdf</code></label>
                                    <input id="bukti_nilai" name="bukti_nilai" type="file"
                                        class="form-control @error('bukti_nilai') is-invalid @enderror">
                                    @error('bukti_nilai')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-danger">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mahasiswaSelect = document.getElementById('mahasiswa_id');
            const dosenPembimbingInput = document.getElementById('dosen_pembimbing');

            if (mahasiswaSelect) {
                mahasiswaSelect.addEventListener('change', function() {
                    const selectedOption = mahasiswaSelect.options[mahasiswaSelect.selectedIndex];
                    const dosenPembimbing = selectedOption.getAttribute('data-dosen');
                    dosenPembimbingInput.value = dosenPembimbing || '';
                });
            }
        });

        let errorMessage = '{{ session('error') }}';
        if (errorMessage) {
            Swal.fire({
                icon: "error",
                title: "Ooops!",
                text: errorMessage,
                showConfirmButton: true,
            });
        }

        let successMessage = '{{ session('success') }}';
        if (successMessage) {
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: successMessage,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
@endsection
