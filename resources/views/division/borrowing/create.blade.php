@extends('template.template-division')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Peminjaman</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="">Peminjaman</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Peminjaman</li>
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
                <form action="{{ route('borrowing.store', Auth::user()->division->name) }}" method="POST">
                @csrf
                <div class="row">

                        <div class="form-group col-6">
                            <label for="asset">Asset<span class="text-danger">*</span></label>
                            <select class="form-select" id="asset" name="asset">
                                <option selected disabled>Pilih asset</option>
                                @foreach ($assets as $asset)
                                    <option value="{{ $asset->asset->id }}" @if(old('asset') == $asset->asset->id) selected @endif>{{ $asset->asset->name }}</option>
                                @endforeach
                            </select>
                            @error('asset')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Nama<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Enter nama" name="name" value="{{ old('name') }}">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="reason">Alasan<span class="text-danger">*</span></label>
                            <textarea name="reason" id="reason" class="form-control" placeholder="Enter alasan">{{ old('reason') }}</textarea>
                            @error('reason')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="return_date">Tanggal Dikembalikan<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="return_date" name="return_date" value="{{ old('return_date') }}">
                            @error('return_date')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2">Create</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>

@endsection
