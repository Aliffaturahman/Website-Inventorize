<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokKain;
use App\Models\Produksi;
use App\Models\Kain;
use App\Models\Roll;
use App\Models\Riwayat;

class StokKainController extends Controller
{
    public function store(Request $request)
    {
        // validasi input request
        $rules = [
            'id_kain' => 'required_without:nama_kain',
            'nama_kain' => 'required_without:id_kain',
            'id_produksi' => 'required_without:nama_produksi',
            'nama_produksi' => 'required_without:id_produksi',
            'total_roll' => 'required|integer|min:1'
        ];

        $total_yard = 0;
        for ($i = 1; $i <= $request->total_roll; $i++) {
            $rules["rollForm$i"] = "required|integer|min:1";
            $temp = 'rollForm' . $i;
            $total_yard += $request->$temp;
        }

        $messages = [
            'id_kain' => 'Pilih salah satu kain atau gunakan switch button untuk mengisi kain secara manual',
            'nama_kain' => 'Isi kain secara manual atau gunakan switch button untuk memilih kain',
            'id_produksi' => 'Pilih salah satu produksi atau gunakan switch button untuk mengisi produksi secara manual',
            'nama_produksi' => 'Isi data produksi secara manual atau gunakan switch button untuk memilih data produksi',
            'total_roll' => 'Total roll tidak boleh kosong'
        ];

        for ($i = 1; $i <= $request->total_roll; $i++) {
            $messages["rollForm$i"] = "Roll ke-$i tidak boleh kosong";
        }

        $request->validate($rules, $messages);
        // CEK DATA KAIN DARI FORM DI TABEL KAIN
        $temp_kain = $request->id_kain; // nyimpen id kain
        if ($temp_kain == null) {
            if (Kain::where('NAMA_KAIN', $request->nama_kain)->first()) {
                $temp_kain = Kain::where('NAMA_KAIN', $request->nama_kain)->value('ID_KAIN');
            }
        }

        // CEK DATA PRODUKSI DARI FORM DI TABEL PRODUKSI
        $temp_prod = $request->id_produksi; // nyimpen id produksi
        if ($temp_prod == null) {
            if (Produksi::where('NAMA_PRODUKSI', $request->nama_produksi)->first()) {
                $temp_prod = Produksi::where('NAMA_PRODUKSI', $request->nama_produksi)->value('ID_PRODUKSI');
            }
        }

        // if (StokKain::where('ID_KAIN', $temp_kain)->where('ID_PRODUKSI', $temp_prod)->first()) {
        // // perbarui kolom total pada tabel stok kain
        // $stok_kain->TOTAL_ROLL += $request->total_roll;
        // $stok_kain->TOTAL_YARD += $total_yard;
        // $stok_kain->save();
        // dd($id_stok_kain);
        // } 
        if (StokKain::where('ID_KAIN', $temp_kain)->where('ID_PRODUKSI', $temp_prod)->first() == null) {
            $stok_kain = new StokKain;
            if ($temp_kain == null) {
                $new_kain = new Kain;
                $new_kain->NAMA_KAIN = $request->nama_kain;
                $new_kain->save();
                $temp_kain = $new_kain->ID_KAIN;
            }

            if ($temp_prod == null) {
                $new_prod = new Produksi;
                $new_prod->NAMA_PRODUKSI = $request->nama_produksi;
                $new_prod->save();
                $temp_prod = $new_prod->ID_PRODUKSI;
            }

            // ASSIGN DATA
            $stok_kain->ID_KAIN = $temp_kain;
            $stok_kain->ID_PRODUKSI = $temp_prod;
            $stok_kain->TOTAL_ROLL = 0;
            $stok_kain->TOTAL_YARD = 0;
            $stok_kain->save();
        }

        $id_stok_kain = StokKain::where('ID_KAIN', $temp_kain)->where('ID_PRODUKSI', $temp_prod)->value('ID_STOK_KAIN');
        // TAMBAH DATA KE TABEL ROLL KEMUDIAN AKAN DITRIGGER KE TABEL STOK KAIN
        for ($i = 1; $i <= $request->total_roll; $i++) {
            $new_roll = new Roll;
            $new_roll->ID_STOK_KAIN = $id_stok_kain;
            $temp_roll = 'rollForm' . $i;
            $new_roll->YARD = $request->$temp_roll;
            $new_roll->save();
        }

        // TAMBAH DATA KE TABEL RIWAYAT SEBAGAI BARANG MASUK
        $new_record = new Riwayat;
        $new_record->JENIS_BARANG = "Kain";
        $nama_barang = Kain::where('ID_KAIN', $temp_kain)->value('NAMA_KAIN');
        $nama_barang2 = Produksi::where('ID_PRODUKSI', $temp_prod)->value('NAMA_PRODUKSI');
        $new_record->NAMA_BARANG = $nama_barang . " ( " . $nama_barang2 . " )";
        $new_record->JUMLAH_BARANG = $request->total_roll;
        $new_record->STATUS = "Masuk";
        $new_record->save();


        return redirect()->route('table.show', ['link' => 'Stok_Kain'])
            ->with('success', 'Data berhasil ditambahkan.');
    }
}
