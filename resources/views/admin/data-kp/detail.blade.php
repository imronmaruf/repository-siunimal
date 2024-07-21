@extends('admin.layouts.main')

@push('title')
    Data Kerja Praktek
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
                            <li class="breadcrumb-item active">Detail Kerja Praktek</li>
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
                                <h3 class="page-title">Detail Kerja Praktek</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table">
                            <table class="table table-striped table-bordered mb-0">
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th class="text-center">:</th>
                                    <td>{{ $dataKp->mahasiswa->name ?? '_' }}</td>
                                </tr>
                                <tr>
                                    <th>NIM</th>
                                    <th class="text-center">:</th>
                                    <td>{{ $dataKp->mahasiswa->nim ?? '_' }}</td>
                                </tr>
                                <tr>
                                    <th>Judul Kerja Praktek</th>
                                    <th class="text-center">:</th>
                                    <td>{{ $dataKp->judul_kp ?? '_' }}</td>
                                </tr>
                                <tr>
                                    <th>Latar Belakang</th>
                                    <th class="text-center">:</th>
                                    <td>{{ $dataKp->latar_belakang ?? '_' }}</td>
                                </tr>
                                <tr>
                                    <th>Dosen Pembimbing</th>
                                    <th class="text-center">:</th>
                                    <td>{{ $dataKp->dosenPembimbing->name ?? '_' }}</td>
                                </tr>
                                <tr>
                                    <th>Nilai</th>
                                    <th class="text-center">:</th>
                                    <td>{{ $dataKp->nilai ?? '_' }}</td>
                                </tr>
                                <tr>
                                    <th>Link GitHub</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        @if ($dataKp->link_github)
                                            <a href="{{ $dataKp->link_github }}"
                                                target="_blank">{{ $dataKp->link_github }}</a>
                                        @else
                                            _
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Link Google Drive</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        @if ($dataKp->link_gdrive)
                                            <a href="{{ $dataKp->link_gdrive }}"
                                                target="_blank">{{ $dataKp->link_gdrive }}</a>
                                        @else
                                            _
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Laporan</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        @if ($dataKp->laporan)
                                            <a href="{{ asset('admin/repo/kp/laporan/' . $dataKp->laporan) }}"
                                                target="_blank">Download</a>
                                            <iframe class="mt-3"
                                                src="{{ asset('admin/repo/kp/laporan/' . $dataKp->laporan) }}"
                                                style="width:100%; height:400px;" frameborder="0"></iframe>
                                            <br>
                                        @else
                                            _
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bukti Distribusi</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        @if ($dataKp->bukti_distribusi)
                                            <a href="{{ asset('admin/repo/kp/bukti-distribusi/' . $dataKp->bukti_distribusi) }}"
                                                target="_blank">Download</a>
                                            <iframe class="mt-3"
                                                src="{{ asset('admin/repo/kp/bukti-distribusi/' . $dataKp->bukti_distribusi) }}"
                                                style="width:100%; height:400px;" frameborder="0"></iframe>
                                            <br>
                                        @else
                                            _
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bukti Nilai</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        @if ($dataKp->bukti_nilai)
                                            <a href="{{ asset('admin/repo/kp/bukti-nilai/' . $dataKp->bukti_nilai) }}"
                                                target="_blank">Download</a>
                                            <iframe class="mt-3"
                                                src="{{ asset('admin/repo/kp/bukti-nilai/' . $dataKp->bukti_nilai) }}"
                                                style="width:100%; height:400px;" frameborder="0"></iframe>
                                            <br>
                                        @else
                                            _
                                        @endif
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('data-kp.index') }}" class="btn btn-dark">&laquo; Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
