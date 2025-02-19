@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Divisi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Divisi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<div class="text-end mb-3">
    <a href="{{ route('division.create') }}" class="btn btn-primary">Create Divisi</a>
</div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
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
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisions as $division)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $division->name }}</td>
                                <td>{{ $division->description }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('division.edit', $division->name) }}">
                                        <i class="bi bi-pencil-square text-primary fs-4"></i>
                                    </a>
                                    <form action="{{ route('division.delete', $division->id) }}" method="POST" onsubmit="return confirm('Divisi akan dihapus yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 text-danger fs-4">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@endsection
