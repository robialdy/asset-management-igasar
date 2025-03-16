    @extends('template.template-admin')

    @section('title', $title)

    @section('content')

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Konfirmasi Pengadaan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('procurement') }}">Pengadaan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Pengadaan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


    <section class="section">
        <form action="{{ route('procurement.update', $procurement->id) }}" method="POST">
            @csrf
            @method('PUT')
            @foreach ($detail_procurements as $dp)

            <input type="hidden" name="detail_id[]" value="{{ $dp->id }}">

            <div id="form-container">
                <div class="card form-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">{{ $loop->iteration }}</h5>
                        <div class="text-end">
                            <a href="#" onclick="event.preventDefault();
                                if(confirm('apakah anda yakin menghapus permintaan ini?')) {
                                    document.getElementById('delete-form-{{ $dp->id }}').submit();
                                    }" class="btn btn-danger btn-sm">
                                <i class="bi bi-dash-lg"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="title">Nama asset<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title[]" placeholder="Masukan nama asset" value="{{ old('title.' . $loop->index, $dp->title) }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="amount">Jumlah<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="amount[]" placeholder="Masukan jumlah" value="{{ old('amount.' . $loop->index, $dp->amount) }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="unit">Unit<span class="text-danger">*</span></label>
                                <select class="form-select" name="unit[]">
                                    <option selected disabled>Pilih type</option>
                                    <option value="Kg" {{ old('unit.' . $loop->index, $dp->unit) == 'Kg' ? 'selected' : '' }}>Kg</option>
                                    <option value="Pcs" {{ old('unit.' . $loop->index, $dp->unit) == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach



            <div class="text-end">
                <button type="submit" class="btn btn-success mt-2">Terima</button>
            </form>
                <form action="{{ route('procurement.rejected', $procurement->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger mt-2">Tolak</button>
                </form>
            </div>
    </section>

    @foreach ($detail_procurements as $dp)
        <form id="delete-form-{{ $dp->id }}" action="{{ route('procurement.delete', $dp->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

    @endsection
