@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Return Kepmilikan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ownership') }}">Ownership</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Return Kepmilikan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('ownership.return_update', $ownership->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <input type="hidden" name="route" value="{{ $route }}">

                        <div class="form-group col-6">
                            <label for="return_attachment">Lampiran Bukti Pengembalian<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="return_attachment" name="return_attachment">
                            @error('return_attachment')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="notes">Catatan</label>
                            <textarea name="notes" id="notes" class="form-control">{{ old('notes') }}</textarea>
                            @error('notes')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2">Send</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>

@endsection
