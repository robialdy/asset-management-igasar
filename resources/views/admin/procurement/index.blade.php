@extends('template.template-admin')

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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengadaan</li>
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
                                <th>Divisi</th>
                                <th>Code Pengadaan</th>
                                <th>Alasan</th>
                                <th>Lihat Cakupan & Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($procurements as $procurement)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $procurement->user->first_name }}</td>
                                <td>
                                    @if ($procurement->name_division)
                                    {{ $procurement->user->division->name }}
                                    @else
                                    null
                                    @endif

                                </td>
                                <td>{{ $procurement->code }}</td>
                                <td>{{ $procurement->reason }}</td>
                                <td>
                                    @if ($procurement->status == 'Proses')
                                        <a href="{{ route('procurement.to-do', $procurement->code) }}"><span class="badge bg-warning">{{ $procurement->status }}</span></a>
                                    @else
                                        <a href="{{ route('procurement.confirm', $procurement->code) }}"><span class="badge bg-primary">{{ $procurement->status }}</span></a>
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
