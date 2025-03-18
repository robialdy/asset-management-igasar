@extends('template.template-division')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Peminjaman</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.division', Auth::user()->division->name) }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<div class="text-end mb-3">
    <a href="{{ route('borrowing.create', Auth::user()->division->name) }}" class="btn btn-primary">
        Tambah Peminjaman
    </a>
</div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3">
                    Table
                </h5>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Divisi</th>
                                <th>Code Asset</th>
                                <th>Asset</th>
                                <th>Nama</th>
                                <th>Alasan</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($borrowings as $borrowing)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $borrowing->division->name }}</td>
                                <td>{{ $borrowing->asset->code_asset }}</td>
                                <td>{{ $borrowing->asset->name }}</td>
                                <td>{{ $borrowing->name }}</td>
                                <td>{{ $borrowing->reason }}</td>
                                <td>{{ $borrowing->added_date }}</td>
                                <td>{{ $borrowing->return_date }}</td>
                                <td>
                                    <form action="{{ route('borrowing.updateStatus', ['division' => Auth::user()->division->name, 'id' => $borrowing->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('yakin sudah Selesai?')">Tandai Selesai</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3">
                    Table, Peminjaman Selesai
                </h5>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" id="table3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Divisi</th>
                                <th>Code Asset</th>
                                <th>Asset</th>
                                <th>Nama</th>
                                <th>Alasan</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Pengembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($borrowings_done as $borrowing)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $borrowing->division->name }}</td>
                                <td>{{ $borrowing->asset->code_asset }}</td>
                                <td>{{ $borrowing->asset->name }}</td>
                                <td>{{ $borrowing->name }}</td>
                                <td>{{ $borrowing->reason }}</td>
                                <td>{{ $borrowing->added_date }}</td>
                                <td>{{ $borrowing->return_date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@endsection
