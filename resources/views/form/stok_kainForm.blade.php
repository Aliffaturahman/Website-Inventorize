@extends('../layout.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Stok Kain</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Stok Kain</li>
        </ol>
    </div>

    <div class="card stok-card">
        <div class="card-body">
            <div class="stok-form-header">
                <div>
                    <h4>Data Stok Kain</h4>
                    <p>Masukkan data kain, produksi, dan jumlah roll yang akan ditambahkan.</p>
                </div>
                <div class="stok-header-icon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>

            <form method="POST" action="{{ route('stok_kain.store') }}">
                @csrf

                <!-- KAIN -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon"><i class="fas fa-scroll"></i></span>
                        <div>
                            <h5>Kain</h5>
                            <p>Pilih kain yang sudah tersedia atau tambahkan kain baru.</p>
                        </div>
                    </div>

                    <div class="data-mode-wrapper">
                        <button type="button" class="data-mode active" id="kainLamaBtn" onclick="pilihKain('lama')">
                            <i class="fas fa-database"></i>
                            <div>
                                <strong>Data Lama</strong>
                                <small>Gunakan kain yang sudah tersedia</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>

                        <button type="button" class="data-mode" id="kainBaruBtn" onclick="pilihKain('baru')">
                            <i class="fas fa-plus-circle"></i>
                            <div>
                                <strong>Data Baru</strong>
                                <small>Tambahkan kain baru</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>
                    </div>

                    <div id="kainLamaForm" class="data-form">
                        <label for="select2SinglePlaceholder2">Pilih Kain</label>
                        <select class="select2-single-placeholder2 form-control" name="id_kain" id="select2SinglePlaceholder2">
                            <option value="">Select</option>
                            @foreach ($kains as $kain)
                                <option value="{{ $kain->ID_KAIN }}">{{ $kain->NAMA_KAIN }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="kainBaruForm" class="data-form" style="display:none;">
                        <label for="other-kain">Nama Kain Baru</label>
                        <input type="text" class="form-control" id="other-kain" name="nama_kain" placeholder="Masukkan nama kain baru" disabled>
                    </div>
                </div>

                <!-- PRODUKSI -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon"><i class="fas fa-industry"></i></span>
                        <div>
                            <h5>Produksi</h5>
                            <p>Pilih produksi yang sudah tersedia atau tambahkan produksi baru.</p>
                        </div>
                    </div>

                    <div class="data-mode-wrapper">
                        <button type="button" class="data-mode active" id="produksiLamaBtn" onclick="pilihProduksi('lama')">
                            <i class="fas fa-database"></i>
                            <div>
                                <strong>Data Lama</strong>
                                <small>Gunakan produksi yang sudah tersedia</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>

                        <button type="button" class="data-mode" id="produksiBaruBtn" onclick="pilihProduksi('baru')">
                            <i class="fas fa-plus-circle"></i>
                            <div>
                                <strong>Data Baru</strong>
                                <small>Tambahkan produksi baru</small>
                            </div>
                            <span class="mode-check"><i class="fas fa-check"></i></span>
                        </button>
                    </div>

                    <div id="produksiLamaForm" class="data-form">
                        <label for="select2SinglePlaceholder1">Pilih Produksi</label>
                        <select class="select2-single-placeholder1 form-control" name="id_produksi" id="select2SinglePlaceholder1">
                            <option value="">Select</option>
                            @foreach ($produksis as $produksi)
                                <option value="{{ $produksi->ID_PRODUKSI }}">{{ $produksi->NAMA_PRODUKSI }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="produksiBaruForm" class="data-form" style="display:none;">
                        <label for="other-produksi">Nama Produksi Baru</label>
                        <input type="text" class="form-control" id="other-produksi" name="nama_produksi" placeholder="Masukkan nama produksi baru" disabled>
                    </div>
                </div>

                <!-- JUMLAH ROLL -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon"><i class="fas fa-layer-group"></i></span>
                        <div>
                            <h5>Jumlah Roll</h5>
                            <p>Tentukan jumlah roll kain yang akan dimasukkan.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="touchSpin1">Total Roll</label>
                        <input id="touchSpin1" type="number" class="form-control" name="total_roll" min="0" oninput="buatForm()">
                    </div>

                    <div id="formContainer"></div>
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
    $('.select2-single-placeholder1').select2({
        placeholder: "Select Produksi",
        allowClear: true,
        width: '100%'
    });

    $('.select2-single-placeholder2').select2({
        placeholder: "Select Kain",
        allowClear: true,
        width: '100%'
    });

    $('#touchSpin1').TouchSpin({
        min: 0,
        max: 1000000000,
        boostat: 5,
        maxboostedstep: 10,
        initval: 0
    });

    $("#touchSpin1").on("change input", function() {
        buatForm();
    });

    pilihKain('lama');
    pilihProduksi('lama');
});

function pilihKain(mode) {
    const lamaBtn = document.getElementById('kainLamaBtn');
    const baruBtn = document.getElementById('kainBaruBtn');
    const lamaForm = document.getElementById('kainLamaForm');
    const baruForm = document.getElementById('kainBaruForm');
    const select = document.getElementById('select2SinglePlaceholder2');
    const input = document.getElementById('other-kain');

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
        $('.select2-single-placeholder2').val(null).trigger('change');
    }
}

function pilihProduksi(mode) {
    const lamaBtn = document.getElementById('produksiLamaBtn');
    const baruBtn = document.getElementById('produksiBaruBtn');
    const lamaForm = document.getElementById('produksiLamaForm');
    const baruForm = document.getElementById('produksiBaruForm');
    const select = document.getElementById('select2SinglePlaceholder1');
    const input = document.getElementById('other-produksi');

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
        $('.select2-single-placeholder1').val(null).trigger('change');
    }
}

function buatForm() {
    var jumlah = parseInt(document.getElementById("touchSpin1").value) || 0;
    var formContainer = document.getElementById("formContainer");
    formContainer.innerHTML = '';

    for (var i = 1; i <= jumlah; i++) {
        var formHtml = '<div class="roll-input-wrapper">' +
            '<div class="roll-number"><span>' + i + '</span></div>' +
            '<div class="roll-input-content">' +
            '<label for="rollForm' + i + '">Roll ' + i + '</label>' +
            '<input type="number" id="rollForm' + i + '" name="rollForm' + i + '" class="form-control" min="0" placeholder="Masukkan jumlah yard">' +
            '</div></div>';

        $("#formContainer").append(formHtml);

        $('#rollForm' + i).TouchSpin({
            min: 0,
            max: 1000000000,
            postfix: 'yard',
            initval: 0,
            boostat: 5,
            maxboostedstep: 10
        });
    }
}
</script>
@endsection