<?php

namespace App\Http\Controllers;

use App\Models\Tinta;
use App\Models\Warna;
use App\Models\Volume;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TintaController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make(
            $request->all(),
            [
                'id_tinta' => 'required',
                'jumlah_tinta' => 'required|integer|min:1',
            ],
            [
                'id_tinta.required' => 'Pilih salah satu data tinta',
                'jumlah_tinta.required' => 'Jumlah tinta tidak boleh kosong',
            ]
        );

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('tinta.store')
                ->withErrors($validator);
        }

        // Cek JUMLAH_TINTA pada tinta
        $tinta = Tinta::findOrFail($request->id_tinta);
        if ($tinta->JUMLAH_TINTA < $request->jumlah_tinta) {
            $validator->after(function ($validator) {
                $validator->errors()->add('jumlah_tinta', 'Jumlah tinta melebihi stok yang tersedia.');
            });
        }

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('tinta.store')
                ->withErrors($validator);
        }

        // Perbarui kolom JUMLAH_TINTA pada tinta
        $tinta->JUMLAH_TINTA -= $request->jumlah_tinta;
        $tinta->save();

        // TAMBAH DATA KE TABEL RIWAYAT SEBAGAI BARANG KELUAR
        $new_record = new Riwayat;
        $new_record->JENIS_BARANG = "Tinta";
        $id_warna = Tinta::where('ID_TINTA', $request->id_tinta)->value('ID_WARNA');
        $nama_barang = Warna::where('ID_WARNA', $id_warna)->value('NAMA_WARNA');
        $id_volume = Tinta::where('ID_TINTA', $request->id_tinta)->value('ID_VOLUME');
        $nama_barang2 = Volume::where('ID_VOLUME', $id_volume)->value('VOLUME');
        $new_record->NAMA_BARANG = "Tinta " . $nama_barang . " ( " . $nama_barang2 . " ml )";
        $new_record->JUMLAH_BARANG = $request->jumlah_tinta;
        $new_record->STATUS = "Keluar";
        $new_record->save();

        return redirect()->route('table.show', ['link' => 'Tinta'])
            ->with('success', 'Data berhasil ditambahkan.');
    }
}
