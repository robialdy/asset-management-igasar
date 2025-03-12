@extends('template.template-user')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Asset Anda</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.user') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Asset Anda</li>
                    </ol>
                </nav>
            </div>
        </div>
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
                                <th>Gambar</th>
                                <th>Code</th>
                                <th>Nama</th>
                                <th>Tgl Ditambahkan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ownerships as $ownership)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('assets/static/images/assets/' . $ownership->asset->picture) }}" alt="asset" width="150" style="object-fit: cover;">
                                </td>
                                <td>{{ $ownership->asset->code_asset }}</td>
                                <td>{{ $ownership->asset->name }}</td>
                                <td>{{ $ownership->asset->added_date }}</td>
                                <td>{{ $ownership->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            </div>
        </div>

    </section>

@endsection
