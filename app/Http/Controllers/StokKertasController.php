<?php

namespace App\Http\Controllers;

use App\Models\Berat;
use App\Models\Kertas;
use App\Models\Riwayat;
use App\Models\StokKertas;
use Illuminate\Http\Request;

class StokKertasController extends Controller
{
    public function store(Request $request)
    {
        // validasi input request
        $request->validate(
            [
                'id_kertas' => 'required_without:nama_kertas',
                'nama_kertas' => 'required_without:id_kertas',
                'id_berat' => 'required_without:berat',
                'berat' => 'required_without:id_berat',
                'panjang' => 'required|integer|min:1',
                'lebar' => 'required|integer|min:1',
                'jumlah_kertas' => 'required|integer|min:1',
            ],
            [
                'id_kertas' => 'Pilih salah satu data kertas atau gunakan switch button untuk mengisi data kertas secara manual',
                'nama_kertas' => 'Isi data kertas secara manual atau gunakan switch button untuk memilih data kertas',
                'id_berat' => 'Pilih salah satu data berat atau gunakan switch button untuk mengisi data berat secara manual',
                'berat' => 'Isi data berat secara manual atau gunakan switch button untuk memilih data berat',
                'panjang' => 'Panjang tidak boleh kosong',
                'lebar' => 'Lebar tidak boleh kosong',
                'jumlah_kertas' => 'Jumlah kertas tidak boleh kosong',
            ]
        );

        // CEK DATA KERTAS DARI FORM DI TABEL KERTAS
        $temp_kertas = $request->id_kertas; // nyimpen id KERTAS
        if ($temp_kertas == null) {
            if (Kertas::where('NAMA_KERTAS', $request->nama_kertas)->first()) {
                $temp_kertas = Kertas::where('NAMA_KERTAS', $request->nama_kertas)->value('ID_KERTAS');
            }
        }

        // CEK DATA BERAT DARI FORM DI TABEL BERAT
        $temp_berat = $request->id_berat; // nyimpen id BERAT
        if ($temp_berat == null) {
            if (Berat::where('BERAT', $request->berat)->first()) {
                $temp_berat = Berat::where('BERAT', $request->berat)->value('ID_BERAT');
            }
        }

        if (StokKertas::where('ID_KERTAS', $temp_kertas)->where('ID_BERAT', $temp_berat)->where('PANJANG', $request->panjang)->where('LEBAR', $request->lebar)->first()) {
            $id_stok_kertas = StokKertas::where('ID_KERTAS', $temp_kertas)->where('ID_BERAT', $temp_berat)->where('PANJANG', $request->panjang)->where('LEBAR', $request->lebar)->value('ID_STOK_KERTAS');
            $stok_kertas = StokKertas::findOrFail($id_stok_kertas);

            // perbarui kolom total pada tabel stok kain
            $stok_kertas->JUMLAH_KERTAS += $request->jumlah_kertas;
            $stok_kertas->save();
            // dd($id_stok_kertas);
        } else {
            $stok_kertas = new StokKertas;
            if ($temp_berat == null) {
                $new_berat = new Berat;
                $new_berat->BERAT = $request->berat;
                $new_berat->save();
                $temp_berat = $new_berat->ID_BERAT;
            }

            if ($temp_kertas == null) {
                $new_kertas = new Kertas;
                $new_kertas->NAMA_KERTAS = $request->nama_kertas;
                $new_kertas->save();
                $temp_kertas = $new_kertas->ID_KERTAS;
            }

            // ASSIGN DATA
            $stok_kertas->ID_BERAT = $temp_berat;
            $stok_kertas->ID_KERTAS = $temp_kertas;
            $stok_kertas->PANJANG = $request->panjang;
            $stok_kertas->LEBAR = $request->lebar;
            $stok_kertas->JUMLAH_KERTAS = $request->jumlah_kertas;
            $stok_kertas->save();
        }

        // TAMBAH DATA KE TABEL RIWAYAT SEBAGAI BARANG MASUK
        $new_record = new Riwayat;
        $new_record->JENIS_BARANG = "Kertas";
        $nama_barang = Kertas::where('ID_KERTAS', $temp_kertas)->value('NAMA_KERTAS');
        $nama_barang2 = Berat::where('ID_BERAT', $temp_berat)->value('BERAT');
        $new_record->NAMA_BARANG = $nama_barang . " " . $nama_barang2 . "GSM" . " ( " . $request->panjang . " m x " . $request->lebar . " cm )";
        $new_record->JUMLAH_BARANG = $request->jumlah_kertas;
        $new_record->STATUS = "Masuk";
        $new_record->save();

        return redirect()->route('table.show', ['link' => 'Stok_Kertas'])
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function getPanjang(Request $request)
    {
        $kertas = StokKertas::where('ID_STOK_KERTAS', $request->input('idStokKertas'))->value("ID_KERTAS");
        $berat = StokKertas::where('ID_STOK_KERTAS', $request->input('idStokKertas'))->value("ID_BERAT");

        $data = StokKertas::where('ID_KERTAS', $kertas)->where('ID_BERAT', $berat)->get();

        return response()->json($data);
    }
}
