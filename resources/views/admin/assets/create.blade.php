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
                <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="one_unit_many_unit" value="{{ request('one_unit_many_unit') }}">

                        @if (request('one_unit_many_unit') == 'one-unit')
                        <div class="form-group col-6">
                            <label for="stock">Stock<span class="text-danger">*</span> <small class="text-muted fst-italic">Otomatis Terisi!</small></label>
                            <input type="number" class="form-control " id="stock" placeholder="Masukan nama depan" name="stock" value="1" readonly>
                        </div>
                        @else
                        <div class="form-group col-6">
                            <label for="stock">Stock<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="stock" placeholder="Masukan jumlah stock" name="stock" value="{{ old('stock') }}">
                            @error('stock')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @endif

                        <div class="form-group col-6">
                            <label for="name">Nama Asset<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Masukan nama asset" name="name" value="{{ old('name') }}">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="type">Type<span class="text-danger">*</span></label>
                            <select class="form-select" id="type" name="type">
                                <option selected disabled>Pilih type</option>
                                <option value="Asset Bergerak" @if(old('type') == 'Asset Bergerak') selected @endif>Asset Bergerak</option>
                                <option value="Asset Baku" @if(old('type') == 'Asset Baku') selected @endif>Asset Baku</option>
                            </select>
                            @error('type')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="category">Categori<span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category">
                                <option selected disabled>Pilih categori</option>
                                @foreach ($categorys as $category)
                                <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="added_date">Diberikan Tanggal<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="added_date" placeholder="Masukan nama asset" name="added_date" value="{{ old('added_date', date('Y-m-d')) }}">
                            @error('added_date')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" id="description" width="2" placeholder="Masukan deskripsi">{{old('description')}}</textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="picture">Gambar Aset<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="picture" name="picture">
                            @error('picture')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="pic_payment">Gambar Bukti Pembelian @if (request('one_unit_many_unit') == 'one-unit')<span class="text-danger">*</span> @endif</label>
                            <input type="file" class="form-control" id="pic_paymente" name="pic_payment">
                            @error('pic_payment')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @if (request('one_unit_many_unit') == 'one-unit')
                        <h4 class="card-title mt-3">Detail <button type="button" class="btn btn-link p-0 mb-2 btn-lg" id="add-button"><i class="bi bi-plus-circle"></i></button></h4>

                        <div id="input-container">

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

             {{-- SCRIPT --}}
                        <script>
                        document.getElementById('add-button').addEventListener('click', function () {
                        const container = document.getElementById('input-container');
                        const inputGroup = document.createElement('div');
                        inputGroup.classList.add('row', 'mb-3');

                        const index = container.children.length;

                        const createInputColumn = (labelText, placeholderText, name) => {
                            const col = document.createElement('div');
                            col.classList.add('col-lg-6');

                            const label = document.createElement('label');
                            label.innerHTML = `${labelText}<span class="text-danger">*</span>`;

                            const input = document.createElement('input');
                            input.type = 'text';
                            input.classList.add('form-control');
                            input.setAttribute('placeholder', placeholderText);
                            input.name = `details[${index}][${name}]`;
                            input.required = true;

                            col.appendChild(label);
                            col.appendChild(input);
                            return col;
                        };

                        const titleCol = createInputColumn('Title', 'Enter Title', 'title');
                        const descriptionCol = createInputColumn('Description', 'Enter Description', 'description');

                        inputGroup.appendChild(titleCol);
                        inputGroup.appendChild(descriptionCol);
                        container.appendChild(inputGroup);
                        });
                        </script>

@endsection
