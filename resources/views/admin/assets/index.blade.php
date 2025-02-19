@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Assets</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Assets</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<div class="text-end mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
    data-bs-target="#modal-create">
        Tambah Asset
    </button>
</div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Table
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Picture</th>
                                <th>Kode Asset</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Tgl Ditambahkan</th>
                                <th>Status</th>
                                <th>Bon Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assets as $asset)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $asset->picture }}</td>
                                <td>{{ $asset->code_asset }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->description }}</td>
                                <td>{{ $asset->type }}</td>
                                <td>{{ $asset->category->name }}</td>
                                <td>{{ $asset->added_date }}</td>
                                <td>{{ $asset->status }}</td>
                                <td>{{ $asset->pic_payment }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Pilih Jenis Barang</h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('asset.create') }}" method="get">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="satuan_borongan" id="satuan" value="satuan">
                                <label class="form-check-label" for="satuan">
                                    Satuan
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="satuan_borongan" id="borongan" value="borongan">
                                <label class="form-check-label" for="borongan">
                                    Borongan
                                </label>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
