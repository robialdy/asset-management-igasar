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
                <h5 class="card-title mb-3">
                    Table
                </h5>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#one-unit" role="tab"
                            aria-controls="one-unit" aria-selected="true">Satu Unit</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#many-unit" role="tab"
                            aria-controls="many-unit" aria-selected="false">Banyak Unit</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">




        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="one-unit" role="tabpanel" aria-labelledby="one-tab">
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
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assets_one_unit as $asset)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('assets/static/images/assets/' . $asset->picture) }}" alt="asset" width="150" style="object-fit: cover;">
                                </td>
                                <td>{{ $asset->code_asset }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->description }}</td>
                                <td>{{ $asset->type }}</td>
                                <td>{{ $asset->category->name }}</td>
                                <td>{{ $asset->added_date }}</td>
                                <td>{{ $asset->stock }}</td>
                                <td>{{ $asset->status }}</td>
                                <td>{{ $asset->notes }}</td>
                                <td style="vertical-align: middle; white-space: nowrap;">
                                    <a href="{{ route('asset.detail', $asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-info-square-fill fs-4"></i>
                                    </a>
                                    <a href="{{ route('asset.edit', $asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-pencil-square fs-4"></i>
                                    </a>
                                    <form action="{{ route('asset.delete', $asset->id) }}" method="POST" onsubmit="return confirm('Divisi akan dihapus yakin?')" style="display: inline-block; vertical-align: middle; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 text-danger border-0 bg-transparent" style="vertical-align: middle;">
                                            <i class="bi bi-trash-fill fs-4"></i>
                                        </button>
                                    </form>
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade show" id="many-unit" role="tabpanel" aria-labelledby="many-tab">
                <div class="table-responsive">
                    <table class="table" id="table3">
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
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assets_many_unit as $asset)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('assets/static/images/assets/' . $asset->picture) }}" alt="asset" width="150" style="object-fit: cover;">
                                </td>
                                <td>{{ $asset->code_asset }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->description }}</td>
                                <td>{{ $asset->type }}</td>
                                <td>{{ $asset->category->name }}</td>
                                <td>{{ $asset->added_date }}</td>
                                <td>{{ $asset->stock }}</td>
                                <td>{{ $asset->status }}</td>
                                <td style="vertical-align: middle; white-space: nowrap;">
                                    <a href="{{ route('asset.detail', $asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-info-square-fill fs-4"></i>
                                    </a>
                                    <a href="{{ route('asset.edit', $asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-pencil-square fs-4"></i>
                                    </a>
                                    <form action="{{ route('asset.delete', $asset->id) }}" method="POST" onsubmit="return confirm('Asset akan dihapus yakin?')" style="display: inline-block; vertical-align: middle; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 text-danger border-0 bg-transparent" style="vertical-align: middle;">
                                            <i class="bi bi-trash-fill fs-4"></i>
                                        </button>
                                    </form>
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
                                <input class="form-check-input" type="radio" name="one_unit_many_unit" id="satuan" value="one-unit">
                                <label class="form-check-label" for="satuan">
                                    Satu Unit
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="one_unit_many_unit" id="borongan" value="many-unit">
                                <label class="form-check-label" for="borongan">
                                    Banyak Unit
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
