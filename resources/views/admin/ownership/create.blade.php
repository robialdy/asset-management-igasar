@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Assets</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ownership') }}">Ownership</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Kepemilikan</li>
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
                <form action="{{ route('ownership.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="route" value="{{ request('route') }}">

                        @if (request('route') == 'guru-staff')
                        <div class="form-group col-6">
                            <label for="user">Guru / Staff<span class="text-danger">*</span></label>
                            <select class="form-select" id="user" name="ownership">
                                <option selected disabled>Pilih Guru / Staff</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if(old('ownership') == $user->id) selected @endif>{{ $user->first_name }} {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                            @error('ownership')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @elseif (request('route') == 'division')
                        <div class="form-group col-6">
                            <label for="division">Divisi<span class="text-danger">*</span></label>
                            <select class="form-select" id="division" name="ownership">
                                <option selected disabled>Pilih divisi</option>
                                @foreach ($divisions as $divisi)
                                <option value="{{ $divisi->id }}" @if(old('ownership') == $divisi->id) selected @endif>{{ $divisi->name }}</option>
                                @endforeach
                            </select>
                            @error('ownership')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @endif

                        <div class="form-group col-6">
                            <label for="id_asset">Asset<span class="text-danger">*</span></label>
                            <select class="form-select" id="id_asset" name="id_asset">
                                <option selected disabled>Pilih Asset</option>
                                @foreach ($assets as $asset)
                                <option value="{{ $asset->id }}" @if(old('id_asset') == $asset->id) selected @endif>{{ $asset->name }}</option>
                                @endforeach
                            </select>
                            @error('id_asset')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @if (request('route') == 'guru-staff' || request('route' == 'division'))
                        <div class="form-group col-6">
                            <label for="added_date">Diserahkan Tanggal<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="added_date" placeholder="Masukan nama asset" name="added_date" value="{{ old('added_date', date('Y-m-d')) }}">
                            @error('added_date')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @endif


                        @if (request('route') == 'guru-staff')
                        <div class="form-group col-6">
                            <label for="attachment">Lampiran Bukti Serah Terima</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                            @error('attachment')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @endif

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2">Create</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>

@endsection
