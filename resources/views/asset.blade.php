<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ secure_asset('assets/compiled/css/app.css') }}">
  <link rel="stylesheet" href="{{ secure_asset('assets/compiled/css/app-dark.css') }}">
</head>
<body>

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
          <div class="card-body text-center">
            <h5 class="mb-4">Qr Code</h5>
                <img src="{{ asset('assets/qr/'. $asset->qr_code) }}" alt="QR Code" >
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

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-3 text-primary">
                    STATUS PEMINJAMAN SAAT INI
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                            @if ($status == 'user')
                            <th>Nama</th>
                            @else
                            <th>Division</th>
                            @endif
                                <th>Asset</th>
                                <th>Kode Asset</th>
                                <th>Ditambahkan</th>
                                <th>Lampiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($status == 'user')
                            <tr>
                                <td>{{ $ownership->user->first_name }}</td>
                                <td>{{ $ownership->asset->name }}</td>
                                <td>{{ $ownership->asset->code_asset }}</td>
                                <td>{{ $ownership->added_date }}</td>
                                <td></td>
                            </tr>
                            @elseif ($status == 'division')
                            <tr>
                                <td>{{ $ownership->division->name }}</td>
                                <td>{{ $ownership->asset->name }}</td>
                                <td>{{ $ownership->asset->code_asset }}</td>
                                <td>{{ $ownership->added_date }}</td>
                                <td></td>
                            </tr>
                            @else
                                <tr>

                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
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

    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
</body>
</html>
