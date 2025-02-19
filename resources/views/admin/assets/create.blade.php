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
                        <li class="breadcrumb-item"><a href="{{ route('asset') }}">Asset</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Assets</li>
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
                <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="row">
                        <div class="form-group col-6">
                            <label for="first_name">Name Depan<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" placeholder="Masukan nama depan" name="first_name" value="{{ old('first_name') }}">
                            @error('first_name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                                                <?php  $pilihan = request('satuan_borongan')?>
                        <h1>{{ $pilihan }}</h1>


                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2">Create</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>

@endsection
