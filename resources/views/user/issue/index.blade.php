@extends('template.template-user')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Issue</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.user') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Issue</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<div class="text-end mb-3">
    <a href="{{ route('issue.create') }}" class="btn btn-primary">
        Tambah Issue
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
                                <th>Nama</th>
                                <th>Type</th>
                                <th>Code asset</th>
                                <th>Asset</th>
                                <th>Issue</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($issues as $issue)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $issue->user->first_name }}</td>
                                <td>{{ $issue->type }}</td>
                                <td>{{ $issue->asset->code_asset }}</td>
                                <td>{{ $issue->asset->name }}</td>
                                <td>{{ $issue->description }}</td>
                                <td>
                                    @if ($issue->status == 'Menunggu Konfirmasi' || $issue->status == 'Proses')
                                        <span class="badge bg-warning">{{ $issue->status }}</span>
                                    @endif
                                </td>
                                <td style="vertical-align: middle; white-space: nowrap;">
                                    @if ($issue->status == 'Menunggu Konfirmasi')
                                    <a href="{{ route('issue.edit', $issue->asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-pencil-square fs-4"></i>
                                    </a>
                                    @endif
                                </td>
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
