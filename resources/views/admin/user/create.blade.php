@extends('template.template-admin')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user') }}">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section mt-3">
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

                        <div class="form-group col-6">
                            <label for="last_name">Nama Belakang<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" placeholder="Masukan nama belakang" name="last_name" value="{{ old('last_name') }}">
                            @error('last_name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" placeholder="Masukan Email" name="email" value="{{ old('email') }}">
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="no_hp">No Hp<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+62</span>
                                <input type="number" class="form-control" id="no_hp" placeholder="Masukan No Hp" name="no_hp" value="{{ old('no_hp') }}">
                            </div>
                            @error('no_hp')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="form-group col-6">
                            <label for="role">Role<span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="role">
                                <option selected disabled>Pilih Role</option>
                                <option value="Admin" @if(old('role') == 'Admin') selected @endif>Admin (Sarana & Prasarana)</option>
                                <option value="Staff" @if(old('role') == 'Staff') selected @endif>User (Guru / Staff)</option>
                            </select>
                            @error('role')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="division">Division</label>
                            <select class="form-select" id="category" name="division">
                                <option selected disabled>Pilih Divisi</option>
                                @foreach ($divisions as $division)
                                <option value="{{ $division->id }}" @if(old('division') == $division->id) selected @endif>{{ $division->name }}</option>
                                @endforeach
                            </select>
                            @error('division')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="form-group col-6">
                            <label for="password">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" placeholder="Masukan password" name="password">
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="re_password">Konfirmasi Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="re_password" placeholder="Masukan konfirmasi password" name="re_password">
                            @error('re_password')
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
