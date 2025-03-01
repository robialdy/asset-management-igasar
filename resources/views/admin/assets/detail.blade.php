@extends('template.template-admin')

@section('title', $title)

@section('content')


    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Assets</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('asset') }}">Assets</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

  <div class="container mt-3">

    <div class="row">
      <div class="col-lg-4 ">
        <div class="card mb-4">
          <div class="card-body text-center">
                <img src="{{ asset('assets/static/images/assets/' . $asset->picture) }}" alt="gambar"
         class="img-fluid" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
              <p class="text-muted mt-2"></p>
            <h5 class="my-3"></h5>
          </div>
        </div>

        <div class="card mb-4 p-0">
          <div class="card-body">
            <h5 class="mb-4">Detail Asset</h5>
            @foreach ($details as $detail)
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">{{ $detail->title }}</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0">{{ $detail->description }}</p>
              </div>
            </div>
            <hr>
            @endforeach
          </div>
        </div>

      </div>

      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
              <h5 class="mb-4">Asset</h5>

            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Name</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0">{{ $asset->name }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Code Asset</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0">{{ $asset->code_asset }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Stok</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0">{{ $asset->stock }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Jenis</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0">{{ $asset->type }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Kategori</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0">{{ $asset->category->name }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Tanggal ditambahkan</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0">{{ $asset->added_date }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Status</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0">{{ $asset->status }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Bon bukti pembayaran</p>
              </div>
              <div class="col-sm-8">
                <button type="button" class="btn btn-link mb-0 p-0" data-bs-toggle="modal" data-bs-target="#modal-detail">{{ Str::limit($asset->pic_payment, 40, '...') }}</button>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <p class="mb-0">Deskripsi</p>
              </div>
              <div class="col-sm-8">
                <p class="text-muted mb-0">{{ $asset->description }}</p>
              </div>
            </div>
            <hr>

          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Pilih Jenis Barang</h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body text-center">

                <img src="{{ asset('assets/static/images/pic_payment/' . $asset->pic_payment) }}" alt="image-detail" width="1000" style="object-fit: cover;">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
