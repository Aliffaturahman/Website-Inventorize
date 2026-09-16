@extends('../layout.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Stok Kertas</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Stok Kertas</li>
        </ol>
    </div>

    <div class="card stok-card">
        <div class="card-body">
            <div class="stok-form-header">
                <div>
                    <h4>Data Stok Kertas</h4>
                    <p>Masukkan data kertas, berat, ukuran, dan jumlah stok.</p>
                </div>
                <div class="stok-header-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>

            <form action="{{ route('stok_kertas.store') }}" method="POST">
                @csrf

                <!-- KERTAS -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon"><i class="fas fa-file-alt"></i></span>
                        <div>
                            <h5>Kertas</h5>
                            <p>Pilih kertas yang sudah tersedia atau tambahkan kertas baru.</p>
                        </div>
                    </div>

                    <div class="data-mode-wrapper">
                        <button type="button" class="data-mode active" id="kertasLamaBtn" onclick="pilihKertas('lama')">
                            <i class="fas fa-database"></i>
                            <div>
                                <strong>Data Lama</strong>
                                <small>Gunakan kertas yang sudah tersedia</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>

                        <button type="button" class="data-mode" id="kertasBaruBtn" onclick="pilihKertas('baru')">
                            <i class="fas fa-plus-circle"></i>
                            <div>
                                <strong>Data Baru</strong>
                                <small>Tambahkan kertas baru</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>
                    </div>

                    <div id="kertasLamaForm" class="data-form">
                        <label for="select2SinglePlaceholderKertas">Pilih Kertas</label>
                        <select class="select2-single-placeholder-kertas form-control" name="id_kertas" id="select2SinglePlaceholderKertas">
                            <option value=""></option>
                            @foreach ($kertass as $kertas)
                                <option value="{{ $kertas->ID_KERTAS }}">{{ $kertas->NAMA_KERTAS }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="kertasBaruForm" class="data-form" style="display:none;">
                        <label for="other-kertas">Nama Kertas Baru</label>
                        <input type="text" class="form-control" id="other-kertas" name="nama_kertas" placeholder="Masukkan nama kertas baru" disabled>
                    </div>
                </div>

                <!-- BERAT -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon"><i class="fas fa-weight-hanging"></i></span>
                        <div>
                            <h5>Berat</h5>
                            <p>Pilih berat yang sudah tersedia atau masukkan berat baru.</p>
                        </div>
                    </div>

                    <div class="data-mode-wrapper">
                        <button type="button" class="data-mode active" id="beratLamaBtn" onclick="pilihBerat('lama')">
                            <i class="fas fa-database"></i>
                            <div>
                                <strong>Data Lama</strong>
                                <small>Gunakan berat yang sudah tersedia</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>

                        <button type="button" class="data-mode" id="beratBaruBtn" onclick="pilihBerat('baru')">
                            <i class="fas fa-plus-circle"></i>
                            <div>
                                <strong>Data Baru</strong>
                                <small>Masukkan berat baru</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>
                    </div>

                    <div id="beratLamaForm" class="data-form">
                        <label for="select2SinglePlaceholderBerat">Pilih Berat</label>
                        <select class="select2-single-placeholder-berat form-control" name="id_berat" id="select2SinglePlaceholderBerat">
                            <option value=""></option>
                            @foreach ($berats as $berat)
                                <option value="{{ $berat->ID_BERAT }}">{{ $berat->BERAT . ' kg' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="beratBaruForm" class="data-form" style="display:none;">
                        <label for="touchSpinBerat">Berat Baru</label>
                        <input id="touchSpinBerat" type="number" class="form-control" name="berat" placeholder="Masukkan berat" disabled>
                    </div>
                </div>

                <!-- UKURAN -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon"><i class="fas fa-ruler-combined"></i></span>
                        <div>
                            <h5>Ukuran Kertas</h5>
                            <p>Masukkan panjang dan lebar kertas.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="touchSpinPanjang">Panjang</label>
                                <input id="touchSpinPanjang" type="number" class="form-control" name="panjang">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="touchSpinLebar">Lebar</label>
                                <input id="touchSpinLebar" type="number" class="form-control" name="lebar">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- JUMLAH -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon"><i class="fas fa-copy"></i></span>
                        <div>
                            <h5>Jumlah Kertas</h5>
                            <p>Tentukan jumlah kertas yang akan ditambahkan ke stok.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="touchSpinKertas">Jumlah Kertas</label>
                        <input id="touchSpinKertas" type="number" class="form-control" name="jumlah_kertas">
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
    $('.select2-single-placeholder-kertas').select2({
        placeholder: "Select Kertas",
        allowClear: true,
        width: '100%'
    });

    $('.select2-single-placeholder-berat').select2({
        placeholder: "Select Berat",
        allowClear: true,
        width: '100%'
    });

    $('#touchSpinKertas').TouchSpin({
        min: 0,
        max: 1000000000,
        boostat: 5,
        maxboostedstep: 10,
        initval: 0
    });

    $('#touchSpinPanjang').TouchSpin({
        min: 0,
        max: 1000000000,
        step: 1,
        postfix: 'cm',
        initval: 0,
        boostat: 5,
        maxboostedstep: 10
    });

    $('#touchSpinLebar').TouchSpin({
        min: 0,
        max: 1000000000,
        step: 1,
        postfix: 'cm',
        initval: 0,
        boostat: 5,
        maxboostedstep: 10
    });

    $('#touchSpinBerat').TouchSpin({
        min: 0,
        max: 1000000000,
        decimals: 1,
        step: 0.1,
        postfix: 'kg',
        initval: 0,
        boostat: 5,
        maxboostedstep: 10
    });

    pilihKertas('lama');
    pilihBerat('lama');
});

function pilihKertas(mode) {
    const lamaBtn = document.getElementById('kertasLamaBtn');
    const baruBtn = document.getElementById('kertasBaruBtn');
    const lamaForm = document.getElementById('kertasLamaForm');
    const baruForm = document.getElementById('kertasBaruForm');
    const select = document.getElementById('select2SinglePlaceholderKertas');
    const input = document.getElementById('other-kertas');

    if (mode === 'lama') {
        lamaBtn.classList.add('active');
        baruBtn.classList.remove('active');
        lamaForm.style.display = 'block';
        baruForm.style.display = 'none';
        select.disabled = false;
        input.disabled = true;
        input.value = '';
    } else {
        lamaBtn.classList.remove('active');
        baruBtn.classList.add('active');
        lamaForm.style.display = 'none';
        baruForm.style.display = 'block';
        select.disabled = true;
        input.disabled = false;
        $('.select2-single-placeholder-kertas').val(null).trigger('change');
    }
}

function pilihBerat(mode) {
    const lamaBtn = document.getElementById('beratLamaBtn');
    const baruBtn = document.getElementById('beratBaruBtn');
    const lamaForm = document.getElementById('beratLamaForm');
    const baruForm = document.getElementById('beratBaruForm');
    const select = document.getElementById('select2SinglePlaceholderBerat');
    const input = document.getElementById('touchSpinBerat');

    if (mode === 'lama') {
        lamaBtn.classList.add('active');
        baruBtn.classList.remove('active');
        lamaForm.style.display = 'block';
        baruForm.style.display = 'none';
        select.disabled = false;
        input.disabled = true;
        input.value = '';
    } else {
        lamaBtn.classList.remove('active');
        baruBtn.classList.add('active');
        lamaForm.style.display = 'none';
        baruForm.style.display = 'block';
        select.disabled = true;
        input.disabled = false;
        $('.select2-single-placeholder-berat').val(null).trigger('change');
    }
}
</script>
@endsection