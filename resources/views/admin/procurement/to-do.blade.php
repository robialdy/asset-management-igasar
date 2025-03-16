    @extends('template.template-admin')

    @section('title', $title)

    @section('content')

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>To-Do Pengadaan: {{ $procurement->code }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('procurement') }}">Pengadaan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">To Do List Pengadaan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


    <section class="section">
            <div id="form-container">
                <div class="card form-card">

                    <div class="card-body">
                            <h5 class="">
                                Tandai Produk yang sudah dituntaskan!
                            </h5>
                            <form action="{{ route('procurement.send-todo', $procurement->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="action-type" name="action" value="save">
                            <ul class="mt-3" style="list-style: none">
                                @foreach ($detail_procurements as $detail_procurement)
                                <li class="p-2">
                                    <input id="checkbox-{{ $loop->index }}" class="form-check-input me-1 checkbox-item" type="checkbox" value="{{ $detail_procurement->id }}" name="is_completed[]" @if ($detail_procurement->is_completed == 1) checked @endif>
                                    <label for="checkbox-{{ $loop->index }}">{{ $detail_procurement->title }}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                </div>
            </div>
    </section>

    <div class="text-end d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-success" id="submit-btn" onclick="setAction('completed')">Tandai Selesai</button>
            <button type="submit" class="btn btn-primary" onclick="setAction('save')">Save</button>
        </form>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkboxes = document.querySelectorAll(".checkbox-item");
        const submitBtn = document.getElementById("submit-btn");

        function checkCheckboxes() {
            // Cek apakah semua checkbox diceklis
            const allChecked = [...checkboxes].every(checkbox => checkbox.checked);
            submitBtn.disabled = !allChecked;
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", checkCheckboxes);
        });

        // Cek saat halaman pertama kali dimuat
        checkCheckboxes();
    });

        function setAction(action) {
        document.getElementById('action-type').value = action;
    }
</script>

    @endsection
