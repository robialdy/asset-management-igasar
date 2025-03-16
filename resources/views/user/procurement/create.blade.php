@extends('template.template-user')

@section('title', $title)

@section('content')

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Request Pengadaan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.user') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('procurement') }}">Pengadaan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Request Pengadaan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

<section class="section">
    <form action="{{ route('user.procurement.store') }}" method="POST">
        @csrf

        <div id="form-container">
            <div class="card form-card">
                <div class="card-header">
                    <h5 class="card-title">1</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="title">Nama asset<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title[]" placeholder="Masukan nama asset">
                        </div>

                        <div class="form-group col-6">
                            <label for="amount">Jumlah<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="amount[]" placeholder="Masukan jumlah">
                        </div>

                        <div class="form-group col-6">
                            <label for="unit">Unit<span class="text-danger">*</span></label>
                            <select class="form-select" name="unit[]">
                                <option selected disabled>Pilih type</option>
                                <option value="Kg">Kg</option>
                                <option value="Pcs">Pcs</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="modal fade" id="modal-reason" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Pilih Jenis Barang</h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <label for="reason">Alasan Pengadaan<span class="text-danger">*</span></label>
                <textarea name="reason" id="reason" class="form-control" placeholder="Enter Alasan Pengadaan"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>


        <div class="text-end">
            <button type="button" class="btn btn-info text-white mt-2" id="add-form">Tambah Form</button>
                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                data-bs-target="#modal-reason">
                Submit
            </button>
        </div>
    </form>
</section>

<script>
    document.getElementById('add-form').addEventListener('click', function () {
        let formContainer = document.getElementById('form-container');
        let formCount = formContainer.getElementsByClassName('form-card').length + 1;

        let newForm = document.createElement('div');
        newForm.classList.add('card', 'form-card');
        newForm.innerHTML = `
            <div class="card-header">
                <h5 class="card-title">` + formCount + `</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label>Nama asset<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title[]" placeholder="Masukan nama asset">
                    </div>

                    <div class="form-group col-6">
                        <label>Jumlah<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="amount[]" placeholder="Masukan jumlah">
                    </div>

                    <div class="form-group col-6">
                        <label>Unit<span class="text-danger">*</span></label>
                        <select class="form-select" name="unit[]">
                            <option selected disabled>Pilih type</option>
                            <option value="Kg">Kg</option>
                            <option value="Pcs">Pcs</option>
                        </select>
                    </div>
                </div>
            </div>
        `;

        formContainer.appendChild(newForm);
    });
</script>

@endsection
