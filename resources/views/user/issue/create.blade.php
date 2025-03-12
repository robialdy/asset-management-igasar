@extends('template.template-user')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Issue</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.user') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ownership') }}">Issue</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Issue</li>
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
                <form action="{{ route('issue.store') }}" method="POST">
                @csrf
                <div class="row">

                        <div class="form-group col-6">
                            <label for="id_user">Nama pengguna<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="id_user" placeholder="Masukan nama asset" name="id_user" value="{{ Auth::user()->first_name }}" disabled>
                            @error('id_user')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="form-group col-6">
                            <label for="type">Type<span class="text-danger">*</span></label>
                            <select class="form-select" id="type" name="type">
                                <option selected disabled>Pilih type</option>
                                <option value="Perbaikan" @if(old('type') == 'Perbaikan') selected @endif>Perbaikan</option>
                                <option value="Pengembalian" @if(old('type') == 'Pengembalian') selected @endif>Pengembalian</option>
                            </select>
                            @error('type')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="asset">Asset<span class="text-danger">*</span></label>
                            <select class="form-select" id="asset" name="asset">
                                <option selected disabled>Pilih asset</option>
                                @foreach ($ownerships as $ownership)
                                    <option value="{{ $ownership->id_asset }}" @if(old('type') == $ownership->id_asset) selected @endif>{{ $ownership->asset->name }}</option>
                                @endforeach
                            </select>
                            @error('asset')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="description">Deskripsi Issue<span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" placeholder="Masukan Deskripsi issue">{{ old('description') }}</textarea>
                            @error('description')
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
