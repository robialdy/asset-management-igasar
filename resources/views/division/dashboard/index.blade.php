@extends('template.template-division')

@section('title', $title)

@section('content')


    <section class="section">
        <h1>Dashboard Division</h1>

        <div class="row mt-3">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-start ">
                                    <i class="bi bi-box-seam-fill fs-1 ms-2"></i>
                                </div>
                                <div class="col-8">
                                    <h6 class="text-muted font-semibold">Jumlah Asset</h6>
                                    <h6 class="font-extrabold mb-0">{{ $count_asset }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-start ">
                                    <i class="bi bi-plus-circle-fill fs-1 ms-2"></i>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Pengadaan</h6>
                                    <h6 class="font-extrabold mb-0">{{ $count_procurement }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-start ">
                                    <i class="bi bi-plus-circle-fill fs-1 ms-2"></i>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Peminjaman</h6>
                                    <h6 class="font-extrabold mb-0">{{ $count_borrowing }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-start ">
                                    <i class="bi bi-exclamation-circle-fill fs-1 ms-2"></i>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Issue</h6>
                                    <h6 class="font-extrabold mb-0">{{ $count_issue }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>

@endsection
