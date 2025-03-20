@extends('template.template-user')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pengadaan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.user') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengadaan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<div class="text-end mb-3">
    <a href="{{ route('user.procurement.create') }}" class="btn btn-primary">
        Request Pengadaan
    </a>
</div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3">
                    Table Pengadaan
                </h5>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" id="table3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alasan</th>
                                <th>Code</th>
                                <th>Tgl diajukan</th>
                                <th>Lihat Cakupan & Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($procurements as $procurement)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $procurement->user->first_name }}</td>
                                <td>{{ $procurement->reason }}</td>
                                <td>{{ $procurement->code }}</td>
                                <td>{{ $procurement->created_at }}</td>
                                <td>
                                    @if ($procurement->status == 'Menunggu Konfirmasi')
                                    <a href="{{ route('user.procurement.detail', $procurement->code) }}"><span class="badge bg-primary">Menunggu Konfirmasi</span></a>
                                    @else
                                        <a href="{{ route('user.procurement.detail', $procurement->code) }}"><span class="badge bg-warning">Proses</span></a>
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



        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3">
                    Table Pengadaan Success
                </h5>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alasan</th>
                                <th>Code</th>
                                <th>Tgl diajukan</th>
                                <th>Lihat Cakupan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historys as $history)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $history->user->first_name }}</td>
                                <td>{{ $history->reason }}</td>
                                <td>{{ $history->code }}</td>
                                <td>{{ $history->created_at }}</td>
                                <td>
                                    <a href="{{ route('user.procurement.detail', $history->code) }}"><span class="badge bg-primary">Details</span></a>
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
