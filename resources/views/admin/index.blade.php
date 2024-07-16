@extends('admin.layouts.main')


@push('title')
    Dashboard
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins//toastr/toatr.css') }}">
@endpush
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome Admin!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Admin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @can('mahasiswa-only')
            <div class="row">
                <div class="col-xl-12 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h3>Selamat datang</h3>
                                    <h6>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores
                                        repellendus
                                        molestiae
                                        exercitationem voluptatem tempora quo dolore nostrum dolor consequuntur itaque, alias
                                        fugit.
                                        Architecto rerum animi velit, beatae corrupti quos nam saepe asperiores aliquid quae
                                        culpa
                                        ea reiciendis ipsam numquam laborum aperiam. Id tempore consequuntur velit vitae
                                        corporis,
                                        aspernatur praesentium ratione! Lorem, ipsum dolor sit amet consectetur adipisicing
                                        elit. Aliquam delectus quam praesentium reprehenderit temporibus sint optio aspernatur
                                        quisquam commodi ipsa nulla cupiditate libero eos, ad minus magnam doloremque, dolor
                                        natus?</h6>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('admin/assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan


        @can('admin-only')
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Mahasiswa</h6>
                                    <h3>50055</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('admin/assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Kerja Praktek</h6>
                                    <h3>50+</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('admin/assets/img/icons/dash-icon-02.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Tugas Akhir</h6>
                                    <h3>30+</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('admin/assets/img/icons/dash-icon-03.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Dosen</h6>
                                    <h3>505</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('admin/assets/img/icons/dash-icon-04.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Dosen</h6>
                                    <h3>505</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('admin/assets/img/icons/dash-icon-04.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        <div class="row">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="card" style="background-color: #0a66c2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 ms-2 ">
                                <img src="http://127.0.0.1:8002/logo-unimal-min.png" alt="Deskripsi Gambar" width="100"
                                    height="150">
                            </div>
                            <div class="col-md-9 text-justify">
                                <p class="text-white">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores
                                    repellendus
                                    molestiae
                                    exercitationem voluptatem tempora quo dolore nostrum dolor consequuntur itaque, alias
                                    fugit.
                                    Architecto rerum animi velit, beatae corrupti quos nam saepe asperiores aliquid quae
                                    culpa
                                    ea reiciendis ipsam numquam laborum aperiam. Id tempore consequuntur velit vitae
                                    corporis,
                                    aspernatur praesentium ratione! Lorem, ipsum dolor sit amet consectetur adipisicing
                                    elit. Aliquam delectus quam praesentium reprehenderit temporibus sint optio aspernatur
                                    quisquam commodi ipsa nulla cupiditate libero eos, ad minus magnam doloremque, dolor
                                    natus?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">

                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Number of Students</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-blue"></span>Girls</li>
                                    <li><span class="circle-green"></span>Boys</li>
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="bar"></div>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
@push('js')
    <script src="{{ asset('admin/assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/toastr/toastr.js') }}"></script>
@endpush
