@extends('../layout.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Tinta</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Tinta</li>
        </ol>
    </div>

    <div class="card stok-card">
        <div class="card-body">
            <div class="stok-form-header">
                <div>
                    <h4>Data Tinta</h4>
                    <p>Pilih tinta dan masukkan jumlah tinta yang akan digunakan.</p>
                </div>
                <div class="stok-header-icon">
                    <i class="fas fa-fill-drip"></i>
                </div>
            </div>

            <form action="{{ route('tinta.store') }}" method="POST">
                @csrf

                <!-- PILIH TINTA -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon">
                            <i class="fas fa-palette"></i>
                        </span>
                        <div>
                            <h5>Pilih Tinta</h5>
                            <p>Pilih tinta berdasarkan warna, volume, dan stok yang tersedia.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select2SinglePlaceholderTinta">Tinta</label>
                        <select class="select2-single-placeholder-tinta form-control"
                            name="id_tinta"
                            id="select2SinglePlaceholderTinta">
                            <option value=""></option>

                            @foreach ($tintas as $tinta)
                                @php
                                    $id_warna = $tinta->ID_WARNA;
                                    $nama_warna = App\Models\Warna::where('ID_WARNA', $id_warna)->value('NAMA_WARNA');

                                    $id_vol = $tinta->ID_VOLUME;
                                    $vol = App\Models\Volume::where('ID_VOLUME', $id_vol)->value('VOLUME');

                                    $data = $nama_warna . '-' . $vol . ' ( Stok : ' . $tinta->JUMLAH_TINTA . ' )';
                                @endphp

                                <option value="{{ $tinta->ID_TINTA }}">
                                    {{ $data }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- JUMLAH TINTA -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon">
                            <i class="fas fa-boxes"></i>
                        </span>
                        <div>
                            <h5>Jumlah Tinta</h5>
                            <p>Tentukan jumlah tinta yang akan digunakan.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="touchSpinJumlah">Jumlah Tinta</label>
                        <input id="touchSpinJumlah"
                            type="number"
                            class="form-control"
                            name="jumlah_tinta">
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger stok-alert">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <strong>Terdapat kesalahan:</strong>
                        </div>

                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="stok-form-footer">
                    <button type="submit" class="btn btn-primary stok-btn-save">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('jsCode')
<script>
$(document).ready(function () {
    $('.select2-single-placeholder-tinta').select2({
        placeholder: "Select Tinta",
        allowClear: true,
        width: '100%'
    });

    $('#touchSpinJumlah').TouchSpin({
        min: 0,
        max: 1000000000,
        boostat: 5,
        maxboostedstep: 10,
        initval: 0
    });
});
</script>
@endsection