@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Ownership</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ownership</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>



<div class="d-flex justify-content-between mb-3">
    <div>
        <a href="{{ route('ownership.attachment') }}" class="btn btn-danger fw-bold me-2"><i class="bi bi-download"></i> Lampiran</a>
        <a href="{{ route('ownership.return-attachment') }}" class="btn btn-danger fw-bold"><i class="bi bi-download"></i> Return Lampiran</a>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
    data-bs-target="#modal-create">
        Tambah Kepemilikan
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
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#user" role="tab"
                            aria-controls="user" aria-selected="true">Guru/Staff</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#division" role="tab"
                            aria-controls="division" aria-selected="false">Divisi</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="one-tab">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Picture</th>
                                <th>Code</th>
                                <th>Nama Asset</th>
                                <th>Stok</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <th>Return</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asset_users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('assets/static/images/assets/' . $user->asset->picture) }}" alt="asset" width="150" style="object-fit: cover;"></td>
                                <td>{{ $user->asset->code_asset }}</td>
                                <td>{{ $user->asset->name }}</td>
                                <td>{{ $user->asset->stock }}</td>
                                <td>{{ $user->user->first_name }} {{ $user->user->last_name }}</td>
                                <td>{{ $user->added_date }}</td>
                                <td>{{ $user->asset->type }}</td>
                                <td>
                                    @if (!$user->attachment)
                                        <span class="badge bg-warning">Lampiran Kosong!</span>
                                    @else
                                        <span class="badge bg-info">Baik!</span>
                                    @endif
                                </td>

                                 <td style="vertical-align: middle; white-space: nowrap;">
                                    <a href="{{ route('ownership.detail', $user->asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-info-square-fill fs-4"></i>
                                    </a>
                                    <a href="{{ route('ownership.edit', $user->asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-pencil-square fs-4"></i>
                                    </a>
                                    <form action="{{ route('ownership.delete', $user->id) }}" method="POST" onsubmit="return confirm('Asset akan dihapus yakin?')" style="display: inline-block; vertical-align: middle; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 text-danger border-0 bg-transparent" style="vertical-align: middle;">
                                            <i class="bi bi-trash-fill fs-4"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    @if ($user->attachment)
                                    <a href="{{ route('ownership.return', $user->asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-arrow-counterclockwise fs-4"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


             <div class="tab-pane fade show" id="division" role="tabpanel" aria-labelledby="one-tab">
                <div class="table-responsive">
                    <table class="table" id="table3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Picture</th>
                                <th>Code</th>
                                <th>Nama Asset</th>
                                <th>Stok</th>
                                <th>Nama Divisi</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                                <th>Return</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asset_divisions as $division)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('assets/static/images/assets/' . $division->asset->picture) }}" alt="asset" width="150" style="object-fit: cover;"></td>
                                <td>{{ $division->asset->code_asset }}</td>
                                <td>{{ $division->asset->name }}</td>
                                <td>{{ $division->asset->stock }}</td>
                                <td>{{ $division->division->name }}</td>
                                <td>{{ $division->added_date }}</td>
                                <td>{{ $division->asset->type }}</td>
                                <td style="vertical-align: middle; white-space: nowrap;">
                                    <a href="{{ route('ownership.detail', $division->asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-info-square-fill fs-4"></i>
                                    </a>
                                    <a href="{{ route('ownership.edit', $division->asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-pencil-square fs-4"></i>
                                    </a>
                                    <form action="{{ route('ownership.delete', $division->id) }}" method="POST" onsubmit="return confirm('Asset akan dihapus yakin?')" style="display: inline-block; vertical-align: middle; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 text-danger border-0 bg-transparent" style="vertical-align: middle;">
                                            <i class="bi bi-trash-fill fs-4"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                        <a href="{{ route('ownership.return', $division->asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                            <i class="bi bi-arrow-counterclockwise fs-4"></i>
                                        </a>
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



        <div class="modal fade" id="modal-create" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Pilih</h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ownership.create') }}" method="get">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="route" id="satuan" value="guru-staff">
                                <label class="form-check-label" for="satuan">
                                    Guru/Staff
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="route" id="borongan" value="division">
                                <label class="form-check-label" for="borongan">
                                    Divisi
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

    </section>

@endsection
