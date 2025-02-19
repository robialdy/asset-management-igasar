@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Users</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<div class="text-end mb-3">
    <a href="{{ route('user.create') }}" class="btn btn-primary">Create User</a>
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
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Divisi</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->division->name ?? 'null' }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="https://api.whatsapp.com/send/?phone={{ $user->no_hp }}" target="_blank">{{ $user->no_hp }}</a></td>
                                <td>{{ $user->role }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('user.edit', $user->slug) }}">
                                        <i class="bi bi-pencil-square text-primary fs-4"></i>
                                    </a>
                                     <form action="{{ route('user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Divisi akan dihapus yakin?')">
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
