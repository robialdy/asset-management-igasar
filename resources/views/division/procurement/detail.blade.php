@extends('template.template-division')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Request Pengadaan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.division', Auth::user()->division->name) }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('division.procurement', Auth::user()->division->name) }}">Pengadaan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Request Pengadaan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<section class="section">

    @foreach ($details as $detail)
        <div id="form-container">
            <div class="card form-card">
                <div class="card-header">
                    <h5 class="card-title">{{ $loop->iteration }}</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="title">Nama asset<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title[]" placeholder="Masukan nama asset" value="{{ $detail->title }}" disabled>
                        </div>

                        <div class="form-group col-6">
                            <label for="amount">Jumlah<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="amount[]" placeholder="Masukan jumlah" value="{{ $detail->amount }}" disabled>
                        </div>

                        <div class="form-group col-6">
                            <label for="unit">Unit<span class="text-danger">*</span></label>
                            <select class="form-select" name="unit[]" disabled>
                                <option disabled>Pilih type</option>
                                <option value="Kg" {{ $detail->unit == 'Kg' ? 'selected' : '' }}>Kg</option>
                                <option value="Pcs" {{ $detail->unit == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

</section>


@endsection
