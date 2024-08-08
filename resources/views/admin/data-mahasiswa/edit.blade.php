@extends('admin.layouts.main')

@push('title')
    Data Mahasiswa
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
                                <p class="card-text">
                                    Data yang belum ada dapat diisi dilain waktu
                                    </br>
                                </p>
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

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <form class="needs-validation" novalidate=""
                                    action="{{ route('data-mahasiswa.update', $dataMhs->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label for="name">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name', $dataMhs->name) }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="foto">Foto</label>
                                            <input type="file" class="form-control mb-3" name="foto" id="foto"
                                                aria-label="file example" onchange="previewImage(event)">
                                            <div class="col-md-4">
                                                <img id="imgPreview"
                                                    src="{{ $dataMhs->foto ? asset('admin/img/foto/' . $dataMhs->foto) : '#' }}"
                                                    style="width: 600px; height: auto;" class="img-fluid img-thumbnail">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="nim">NIM <span class="text-danger">*</span> </label>
                                            <input id="nim" name="nim" type="number" class="form-control"
                                                value="{{ old('nim', $dataMhs->nim) }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="hp">No. Telp atau WhatsApp aktif</label>
                                            <input id="hp" name="hp" type="number" class="form-control"
                                                value="{{ old('hp', $dataMhs->hp) }}">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label for="dosen_pembimbing_kp">Dosen Pembimbing Kerja Praktek</label>
                                            <select
                                                class="form-control form-select @error('dosen_pembimbing_kp') is-invalid @enderror"
                                                name="dosen_pembimbing_kp" id="dosen_pembimbing_kp">
                                                <option value="">-- Pilih Dosen --</option>
                                                @foreach ($dataDosen as $dosen)
                                                    <option value="{{ $dosen->id }}"
                                                        {{ old('dosen_pembimbing_kp', $dataMhs->dosen_pembimbing_kp) == $dosen->id ? 'selected' : '' }}>
                                                        {{ $dosen->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="dosen_pembimbing_tga_1">Dosen Pembimbing Utama Tugas Akhir</label>
                                            <select
                                                class="form-control form-select @error('dosen_pembimbing_tga_1') is-invalid @enderror"
                                                name="dosen_pembimbing_tga_1" id="dosen_pembimbing_tga_1">
                                                <option value="">-- Pilih Dosen --
                                                </option>
                                                @foreach ($dataDosen as $dosen)
                                                    <option value="{{ $dosen->id }}"
                                                        {{ old('dosen_pembimbing_tga_1', $dataMhs->dosen_pembimbing_tga_1) == $dosen->id ? 'selected' : '' }}>
                                                        {{ $dosen->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="dosen_pembimbing_tga_2">Dosen Pembimbing Pendamping Tugas
                                                Akhir</label>
                                            <select
                                                class="form-control form-select @error('dosen_pembimbing_tga_2') is-invalid @enderror"
                                                name="dosen_pembimbing_tga_2" id="dosen_pembimbing_tga_2">
                                                <option value="">-- Pilih Dosen --
                                                </option>
                                                @foreach ($dataDosen as $dosen)
                                                    <option value="{{ $dosen->id }}"
                                                        {{ old('dosen_pembimbing_tga_2', $dataMhs->dosen_pembimbing_tga_2) == $dosen->id ? 'selected' : '' }}>
                                                        {{ $dosen->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="dosen_penguji_tga_1">Dosen Penguji Utama</label>
                                            <select
                                                class="form-control form-select @error('dosen_penguji_tga_1') is-invalid @enderror"
                                                name="dosen_penguji_tga_1" id="dosen_penguji_tga_1">
                                                <option value="">-- Pilih Dosen --</option>
                                                @foreach ($dataDosen as $dosen)
                                                    <option value="{{ $dosen->id }}"
                                                        {{ old('dosen_penguji_tga_1', $dataMhs->dosen_penguji_tga_1) == $dosen->id ? 'selected' : '' }}>
                                                        {{ $dosen->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="dosen_penguji_tga_2">Dosen Penguji Pendamping</label>
                                            <select
                                                class="form-control form-select @error('dosen_penguji_tga_2') is-invalid @enderror"
                                                name="dosen_penguji_tga_2" id="dosen_penguji_tga_2">
                                                <option value="">-- Pilih Dosen --</option>
                                                @foreach ($dataDosen as $dosen)
                                                    <option value="{{ $dosen->id }}"
                                                        {{ old('dosen_penguji_tga_2', $dataMhs->dosen_penguji_tga_2) == $dosen->id ? 'selected' : '' }}>
                                                        {{ $dosen->name }}</option>
                                                @endforeach
                                            </select>
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
        </div>
    </div>

@endsection

@push('script')
    <script>
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

        // Preview image before upload
        function previewImage(event) {
            const output = document.getElementById('imgPreview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        }
    </script>
@endpush
