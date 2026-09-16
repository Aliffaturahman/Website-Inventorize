<?php

namespace App\Http\Controllers;

use App\Models\Tinta;
use App\Models\Warna;
use App\Models\Volume;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class StokTintaController extends Controller
{
    public function store(Request $request)
    {
        // validasi input
        $request->validate(
            [
                'id_warna' => 'required_without:nama_warna',
                'nama_warna' => 'required_without:id_warna',
                'id_volume' => 'required_without:volume',
                'volume' => 'required_without:id_volume',
                'jumlah_tinta' => 'required|integer|min:1',
            ],
            [
                'id_warna' => 'Pilih salah satu data warna atau gunakan switch button untuk mengisi data warna secara manual',
                'nama_warna' => 'Isi data warna secara manual atau gunakan switch button untuk memilih data warna',
                'id_volume' => 'Pilih salah satu data volume atau gunakan switch button untuk mengisi data volume secara manual',
                'volume' => 'Isi data volume secara manual atau gunakan switch button untuk memilih data volume',
                'jumlah_tinta' => 'Jumlah tinta tidak boleh kosong',
            ]
        );

        // CEK DATA WARNA DARI FORM DI TABEL WARNA
        $temp_warna = $request->id_warna; // nyimpen id warna
        if ($temp_warna == null) {
            if (Warna::where('NAMA_WARNA', $request->nama_warna)->first()) {
                $temp_warna = Warna::where('NAMA_WARNA', $request->nama_warna)->value('ID_WARNA');
            }
        }

        // CEK DATA VOLUME DARI FORM DI TABEL VOLUME 
        $temp_vol = $request->id_volume; // nyimpen id volume
        if ($temp_vol == null) {
            if (Volume::where('VOLUME', $request->volume)->first()) {
                $temp_vol = Volume::where('VOLUME', $request->volume)->value('ID_VOLUME');
            }
        }

        if (Tinta::where('ID_WARNA', $temp_warna)->where('ID_VOLUME', $temp_vol)->first()) { // ga nambah data tinta baru (kombinasi warna & volumenya udh ada)
            // dd(Tinta::where('ID_WARNA', $temp_warna)->where('ID_VOLUME', $temp_vol)->value('ID_TINTA'));
            $id_tinta = Tinta::where('ID_WARNA', $temp_warna)->where('ID_VOLUME', $temp_vol)->value('ID_TINTA');
            $tinta = Tinta::findOrFail($id_tinta);

            // perbarui kolom JUMLAH_TINTA pada tinta
            $tinta->JUMLAH_TINTA += $request->jumlah_tinta;
            $tinta->save();
        } else { // kalau nambahin data tinta baru (kombinasi warna & volumenya blm ada)
            $tinta = new Tinta;
            if ($temp_warna == null) {
                $new_warna = new Warna;
                $new_warna->NAMA_WARNA = $request->nama_warna;
                $new_warna->save();
                $temp_warna = $new_warna->ID_WARNA;
            }

            // VOLUME
            if ($temp_vol == null) {
                $new_vol = new Volume;
                $new_vol->VOLUME = $request->volume;
                $new_vol->save();
                $temp_vol = $new_vol->ID_VOLUME;
            }

            // ASSIGN DATA
            $tinta->ID_WARNA = $temp_warna;
            $tinta->ID_VOLUME = $temp_vol;
            $tinta->JUMLAH_TINTA = $request->jumlah_tinta;
            $tinta->save();
        }

        // TAMBAH DATA KE TABEL RIWAYAT SEBAGAI BARANG MASUK
        $new_record = new Riwayat;
        $new_record->JENIS_BARANG = "Tinta";
        $nama_barang = Warna::where('ID_WARNA', $temp_warna)->value('NAMA_WARNA');
        $nama_barang2 = Volume::where('ID_VOLUME', $temp_vol)->value('VOLUME');
        $new_record->NAMA_BARANG = "Tinta " . $nama_barang . " ( " . $nama_barang2 . " ml )";
        $new_record->JUMLAH_BARANG = $request->jumlah_tinta;
        $new_record->STATUS = "Masuk";
        $new_record->save();

        return redirect()->route('table.show', ['link' => 'Tinta'])
            ->with('success', 'Data berhasil ditambahkan.');
    }
}
