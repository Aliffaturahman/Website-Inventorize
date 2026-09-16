@extends('../layout.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Transaksi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
        </ol>
    </div>

    <div class="card stok-card">
        <div class="card-body">
            <div class="stok-form-header">
                <div>
                    <h4>Data Transaksi</h4>
                    <p>Masukkan data kain, kertas, tanggal, dan keterangan transaksi.</p>
                </div>
                <div class="stok-header-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
            </div>

            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf

                <!-- STOK KAIN -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon">
                            <i class="fas fa-scroll"></i>
                        </span>
                        <div>
                            <h5>Stok Kain</h5>
                            <p>Pilih stok kain yang akan digunakan dalam transaksi.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select2SinglePlaceholder1">Stok Kain</label>
                        <select class="select2-single-placeholder1 form-control"
                            name="id_stok_kain"
                            id="select2SinglePlaceholder1"
                            onchange="buatFormKain()">
                            <option value=""></option>

                            @foreach ($stok_kains as $stok_kain)
                                @php
                                    $id_kain = $stok_kain->ID_KAIN;
                                    $nama_kain = App\Models\Kain::where('ID_KAIN', $id_kain)->value('NAMA_KAIN');

                                    $id_prod = $stok_kain->ID_PRODUKSI;
                                    $nama_prod = App\Models\Produksi::where('ID_PRODUKSI', $id_prod)->value('NAMA_PRODUKSI');

                                    $data = $nama_kain . '-' . $nama_prod;
                                @endphp

                                <option value="{{ $stok_kain->ID_STOK_KAIN }}">
                                    {{ $data }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_kain">Jumlah Kain</label>
                        <input id="jumlah_kain"
                            type="number"
                            class="form-control"
                            name="jumlah_kain"
                            min="0"
                            oninput="buatFormKain()">
                    </div>

                    <div id="formContainerKain"></div>
                </div>

                <!-- STOK KERTAS -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon">
                            <i class="fas fa-file-alt"></i>
                        </span>
                        <div>
                            <h5>Stok Kertas</h5>
                            <p>Pilih stok kertas yang akan digunakan dalam transaksi.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select2SinglePlaceholder3">Stok Kertas</label>
                        <select class="select2-single-placeholder3 form-control"
                            name="id_stok_kertas"
                            id="select2SinglePlaceholder3"
                            onchange="buatFormKertas()">
                            <option value=""></option>

                            @foreach ($stok_kertass as $stok_kertas)
                                @php
                                    $id_kertas = $stok_kertas->ID_KERTAS;
                                    $nama_kertas = App\Models\Kertas::where('ID_KERTAS', $id_kertas)->value('NAMA_KERTAS');

                                    $id_berat = $stok_kertas->ID_BERAT;
                                    $berat = App\Models\Berat::where('ID_BERAT', $id_berat)->value('BERAT');

                                    $data = $nama_kertas . '-' . $berat . ' kg (' . $stok_kertas->PANJANG . ' m x ' . $stok_kertas->LEBAR . ' m)';
                                @endphp

                                <option value="{{ $stok_kertas->ID_STOK_KERTAS }}">
                                    {{ $data }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_kertas">Jumlah Kertas</label>
                        <input id="jumlah_kertas"
                            type="number"
                            class="form-control"
                            name="jumlah_kertas"
                            min="0"
                            oninput="buatFormKertas()">
                    </div>

                    <div id="formContainerKertas"></div>
                </div>

                <!-- TANGGAL -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <div>
                            <h5>Tanggal Transaksi</h5>
                            <p>Tentukan tanggal transaksi.</p>
                        </div>
                    </div>

                    <div class="form-group" id="simple-date1">
                        <label for="simpleDataInput">Tanggal Transaksi</label>
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </span>
                            </div>
                            <input type="text"
                                class="form-control"
                                id="simpleDataInput"
                                name="tanggal">
                        </div>
                    </div>
                </div>

                <!-- KETERANGAN -->
                <div class="stok-section">
                    <div class="stok-section-title">
                        <span class="stok-icon">
                            <i class="fas fa-sticky-note"></i>
                        </span>
                        <div>
                            <h5>Keterangan</h5>
                            <p>Tambahkan keterangan jika diperlukan.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Keterangan</label>
                        <textarea class="form-control"
                            id="exampleFormControlTextarea1"
                            rows="4"
                            name="keterangan"
                            placeholder="Masukkan keterangan transaksi..."></textarea>
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
                        <i class="fas fa-save mr-2"></i>Simpan Transaksi
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
        placeholder: "Select Kain",
        allowClear: true,
        width: '100%'
    });

    $('.select2-single-placeholder3').select2({
        placeholder: "Select Kertas",
        allowClear: true,
        width: '100%'
    });

    var currentDate = new Date();
    var day = String(currentDate.getDate()).padStart(2, '0');
    var month = String(currentDate.getMonth() + 1).padStart(2, '0');
    var year = currentDate.getFullYear();
    var today = year + '-' + month + '-' + day;

    document.getElementById("simpleDataInput").value = today;

    $('#simple-date1 .input-group.date').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true
    });
});

function buatFormKain() {
    var jumlah = parseInt(document.getElementById("jumlah_kain").value) || 0;
    var formContainer = document.getElementById("formContainerKain");

    formContainer.innerHTML = '';

    if (jumlah <= 0) {
        return;
    }

    var idStokKain = document.getElementById("select2SinglePlaceholder1").value;

    if (!idStokKain) {
        return;
    }

    for (var j = 1; j <= jumlah; j++) {
        var formHtml =
            '<div class="roll-input-wrapper">' +
                '<div class="roll-number">' +
                    '<span>' + j + '</span>' +
                '</div>' +
                '<div class="roll-input-content">' +
                    '<label for="id_roll' + j + '">Roll Yard ' + j + '</label>' +
                    '<select name="id_roll[]" id="id_roll' + j + '" class="select-roll form-control">' +
                        '<option value="">Select</option>' +
                    '</select>' +
                '</div>' +
            '</div>';

        $("#formContainerKain").append(formHtml);

        (function (j) {
            $.ajax({
                url: '{{ route("get-rolls") }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    idStokKain: idStokKain
                },
                success: function (data) {
                    var html = '<option value="">Select Yard</option>';

                    if (data.length > 0) {
                        $.each(data, function (i, item) {
                            html += '<option value="' + item.ID_ROLL + '">' + item.YARD + '</option>';
                        });
                    } else {
                        html += '<option value="">Tidak ada data yang tersedia</option>';
                    }

                    $('#id_roll' + j).html(html);

                    $('#id_roll' + j).select2({
                        placeholder: "Select Yard",
                        allowClear: true,
                        width: '100%'
                    });
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        })(j);
    }
}

function buatFormKertas() {
    var jumlahKertas = parseInt(document.getElementById("jumlah_kertas").value) || 0;
    var formContainerKertas = document.getElementById("formContainerKertas");

    formContainerKertas.innerHTML = '';

    if (jumlahKertas <= 0) {
        return;
    }

    var idStokKertas = document.getElementById("select2SinglePlaceholder3").value;

    if (!idStokKertas) {
        return;
    }

    for (var j = 1; j <= jumlahKertas; j++) {
        var formHtml =
            '<div class="roll-input-wrapper">' +
                '<div class="roll-number">' +
                    '<span>' + j + '</span>' +
                '</div>' +
                '<div class="roll-input-content">' +
                    '<label for="id_panjang' + j + '">Panjang Kertas ' + j + '</label>' +
                    '<select name="id_panjang[]" id="id_panjang' + j + '" class="select-panjang form-control">' +
                        '<option value="">Select</option>' +
                    '</select>' +
                '</div>' +
            '</div>';

        $("#formContainerKertas").append(formHtml);

        (function (j) {
            $.ajax({
                url: '{{ route("get-panjang") }}',
                type: 'GET',
                dataType: 'json',
                data: {
                    idStokKertas: idStokKertas
                },
                success: function (data) {
                    var html = '<option value="">Select Panjang</option>';

                    if (data.length > 0) {
                        $.each(data, function (i, item) {
                            html += '<option value="' + item.ID_STOK_KERTAS + '">' +
                                item.PANJANG + ' m x ' +
                                item.LEBAR + ' cm ( Stok : ' +
                                item.JUMLAH_KERTAS + ')' +
                                '</option>';
                        });
                    } else {
                        html += '<option value="">Tidak ada data yang tersedia</option>';
                    }

                    $('#id_panjang' + j).html(html);

                    $('#id_panjang' + j).select2({
                        placeholder: "Select Panjang",
                        allowClear: true,
                        width: '100%'
                    });
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        })(j);
    }
}
</script>
@endsection