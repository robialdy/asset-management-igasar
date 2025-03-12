@extends('template.template-admin')

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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Issue</li>
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
                                <th>Nama</th>
                                <th>Type</th>
                                <th>Admin</th>
                                <th>Divisi</th>
                                <th>Code Asset</th>
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
                                <td>
                                    @if ($issue->id_admin)
                                        {{ $issue->admin->first_name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($issue->division_name)
                                    {{ $issue->division_name }}
                                    @else
                                    (Pribadi)
                                    @endif
                                </td>
                                <td>{{ $issue->asset->code_asset }}</td>
                                <td>{{ $issue->asset->name }}</td>
                                <td>{{$issue->description }}</td>
                                <td>
                                    @if ($issue->status == 'Menunggu Konfirmasi' || $issue->status == 'Proses')
                                        <span class="badge bg-warning">{{ $issue->status }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $issue->status }}</span>
                                    @endif
                                </td>
                               <td>
                                @if ($issue->status == 'Menunggu Konfirmasi')
                                    <div class="d-flex align-items-center gap-2">
                                        <form action="{{ route('admin.issue.updateStatus', $issue->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Proses">
                                            <button type="submit" class="btn btn-link text-success p-0" onclick="return confirm('Permintaan Permaslahaan akan diterima?')">
                                                <i class="bi bi-check-square-fill fs-4"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.issue.updateStatus', $issue->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Ditolak">
                                            <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Permintaan Permaslahaan akan di tolak yakin?')">
                                                <i class="bi bi-x-circle-fill fs-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    @if ($issue->type == 'Pengembalian')
                                    <a href="{{ route('ownership.return', $issue->asset->code_asset) }}" class="text-primary" style="display: inline-block; vertical-align: middle;">
                                        <i class="bi bi-arrow-counterclockwise fs-4"></i>
                                    </a>
                                    @else
                                    <a href="{{ route('admin.issue.repair', $issue->asset->code_asset) }}" class="text-primary"><i class="bi bi-wrench fs-4"></i></a>
                                    @endif
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
