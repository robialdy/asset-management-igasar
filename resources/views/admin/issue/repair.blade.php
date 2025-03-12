@extends('template.template-user')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Repair {{ $issue->asset->name }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.issue') }}">Issue</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Repair {{ $issue->asset->name }}</li>
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
                <form action="{{ route('admin.issue.repairUpdate', $issue->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                        <div class="form-group col-12">
                            <label for="solution_pic">Bukti Biaya Perbaikan<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="solution_pic" placeholder="Masukan nama asset" name="solution_pic">
                            @error('solution_pic')
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
