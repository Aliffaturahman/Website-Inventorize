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
                    <h4>Data Stok Tinta</h4>
                    <p>Masukkan data warna, volume, dan jumlah tinta.</p>
                </div>
                <div class="stok-header-icon">
                    <i class="fas fa-fill-drip"></i>
                </div>
            </div>

            <form action="{{ route('stok_tinta.store') }}" method="POST">
                @csrf

                <!-- WARNA -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon"><i class="fas fa-palette"></i></span>
                        <div>
                            <h5>Warna</h5>
                            <p>Pilih warna yang sudah tersedia atau tambahkan warna baru.</p>
                        </div>
                    </div>

                    <div class="data-mode-wrapper">
                        <button type="button" class="data-mode active" id="warnaLamaBtn" onclick="pilihWarna('lama')">
                            <i class="fas fa-database"></i>
                            <div>
                                <strong>Data Lama</strong>
                                <small>Gunakan warna yang sudah tersedia</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>

                        <button type="button" class="data-mode" id="warnaBaruBtn" onclick="pilihWarna('baru')">
                            <i class="fas fa-plus-circle"></i>
                            <div>
                                <strong>Data Baru</strong>
                                <small>Tambahkan warna baru</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>
                    </div>

                    <div id="warnaLamaForm" class="data-form">
                        <label for="select2SinglePlaceholderWarna">Pilih Warna</label>
                        <select class="select2-single-placeholder-warna form-control" name="id_warna" id="select2SinglePlaceholderWarna">
                            <option value=""></option>
                            @foreach ($warnas as $warna)
                                <option value="{{ $warna->ID_WARNA }}">{{ $warna->NAMA_WARNA }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="warnaBaruForm" class="data-form" style="display:none;">
                        <label for="other-warna">Nama Warna Baru</label>
                        <input type="text" class="form-control" id="other-warna" name="nama_warna" placeholder="Masukkan nama warna baru" disabled>
                    </div>
                </div>

                <!-- VOLUME -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon"><i class="fas fa-flask"></i></span>
                        <div>
                            <h5>Volume</h5>
                            <p>Pilih volume yang sudah tersedia atau masukkan volume baru.</p>
                        </div>
                    </div>

                    <div class="data-mode-wrapper">
                        <button type="button" class="data-mode active" id="volumeLamaBtn" onclick="pilihVolume('lama')">
                            <i class="fas fa-database"></i>
                            <div>
                                <strong>Data Lama</strong>
                                <small>Gunakan volume yang sudah tersedia</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>

                        <button type="button" class="data-mode" id="volumeBaruBtn" onclick="pilihVolume('baru')">
                            <i class="fas fa-plus-circle"></i>
                            <div>
                                <strong>Data Baru</strong>
                                <small>Masukkan volume baru</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>
                    </div>

                    <div id="volumeLamaForm" class="data-form">
                        <label for="select2SinglePlaceholderVolume">Pilih Volume</label>
                        <select class="select2-single-placeholder-volume form-control" name="id_volume" id="select2SinglePlaceholderVolume">
                            <option value=""></option>
                            @foreach ($volumes as $volume)
                                <option value="{{ $volume->ID_VOLUME }}">{{ $volume->VOLUME . ' ml' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="volumeBaruForm" class="data-form" style="display:none;">
                        <label for="touchSpinVolume">Volume Baru</label>
                        <input id="touchSpinVolume" type="number" class="form-control" name="volume" placeholder="Masukkan volume" disabled>
                    </div>
                </div>

                <!-- JUMLAH TINTA -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon"><i class="fas fa-boxes"></i></span>
                        <div>
                            <h5>Jumlah Tinta</h5>
                            <p>Tentukan jumlah tinta yang akan ditambahkan ke stok.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="touchSpinJumlah">Jumlah Tinta</label>
                        <input id="touchSpinJumlah" type="number" class="form-control" name="jumlah_tinta">
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
    $('.select2-single-placeholder-warna').select2({
        placeholder: "Select Warna",
        allowClear: true,
        width: '100%'
    });

    $('.select2-single-placeholder-volume').select2({
        placeholder: "Select Volume",
        allowClear: true,
        width: '100%'
    });

    $('#touchSpinVolume').TouchSpin({
        min: 0,
        max: 1000000000,
        decimals: 1,
        step: 0.1,
        postfix: 'ml',
        initval: 0,
        boostat: 5,
        maxboostedstep: 10
    });

    $('#touchSpinJumlah').TouchSpin({
        min: 0,
        max: 1000000000,
        boostat: 5,
        maxboostedstep: 10,
        initval: 0
    });

    pilihWarna('lama');
    pilihVolume('lama');
});

function pilihWarna(mode) {
    const lamaBtn = document.getElementById('warnaLamaBtn');
    const baruBtn = document.getElementById('warnaBaruBtn');
    const lamaForm = document.getElementById('warnaLamaForm');
    const baruForm = document.getElementById('warnaBaruForm');
    const select = document.getElementById('select2SinglePlaceholderWarna');
    const input = document.getElementById('other-warna');

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
        $('.select2-single-placeholder-warna').val(null).trigger('change');
    }
}

function pilihVolume(mode) {
    const lamaBtn = document.getElementById('volumeLamaBtn');
    const baruBtn = document.getElementById('volumeBaruBtn');
    const lamaForm = document.getElementById('volumeLamaForm');
    const baruForm = document.getElementById('volumeBaruForm');
    const select = document.getElementById('select2SinglePlaceholderVolume');
    const input = document.getElementById('touchSpinVolume');

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
        $('.select2-single-placeholder-volume').val(null).trigger('change');
    }
}
</script>
@endsection