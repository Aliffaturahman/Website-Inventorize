<?php

namespace App\Http\Controllers;

use App\Models\Kain;
use App\Models\Roll;
use App\Models\Berat;
use App\Models\Tinta;
use App\Models\Warna;
use App\Models\Kertas;
use App\Models\Volume;
use App\Models\Produksi;
use App\Models\StokKain;
use App\Models\Transaksi;
use App\Models\StokKertas;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TableController extends Controller
{
    public function show($link)
    {
        $arr = explode("_", $link);
        $model_name = (count($arr) == 1) ? $arr[0] : $arr[0] . $arr[1];
        // $table_name = strtolower($link);
        // $data_db = DB::table($table_name)->get();
        if ($model_name == 'Berat') {
            $data_db1 = Berat::all();
        } else if ($model_name == 'Kain') {
            $data_db1 = Kain::all();
        } else if ($model_name == 'Kertas') {
            $data_db1 = Kertas::all();
        } else if ($model_name == 'Produksi') {
            $data_db1 = Produksi::all();
        } else if ($model_name == 'Roll') {
            $data_db1 = Roll::all();
            foreach ($data_db1 as $temp) {
                $id_kain = StokKain::where('ID_STOK_KAIN', $temp->ID_STOK_KAIN)->value('ID_KAIN');
                $temp->nama_kain = Kain::where('ID_KAIN', $id_kain)->value('NAMA_KAIN');
            }
        } else if ($model_name == 'StokKain') {
            $data_db1 = StokKain::all();
            foreach ($data_db1 as $temp) {
                $temp->nama_produksi = Produksi::where('ID_PRODUKSI', $temp->ID_PRODUKSI)->value('NAMA_PRODUKSI');
                $temp->nama_kain = Kain::where('ID_KAIN', $temp->ID_KAIN)->value('NAMA_KAIN');
            }
        } else if ($model_name == 'StokKertas') {
            $data_db1 = StokKertas::all();
            foreach ($data_db1 as $temp) {
                $temp->berat = Berat::where('ID_BERAT', $temp->ID_BERAT)->value('BERAT');
                $temp->nama_kertas = Kertas::where('ID_KERTAS', $temp->ID_KERTAS)->value('NAMA_KERTAS');
            }
        } else if ($model_name == 'Tinta') {
            $data_db1 = Tinta::all();
            foreach ($data_db1 as $temp) {
                $temp->nama_kertas = Warna::where('ID_WARNA', $temp->ID_WARNA)->value('NAMA_WARNA');
                $temp->volume = Volume::where('ID_VOLUME', $temp->ID_VOLUME)->value('VOLUME');
            }
        } else if ($model_name == 'Transaksi') {
            $data_db1 = Transaksi::all();
            foreach ($data_db1 as $temp) {
                $id_kain = StokKain::where('ID_STOK_KAIN', $temp->ID_STOK_KAIN)->value('ID_KAIN');
                $temp->nama_kain = Kain::where('ID_KAIN', $id_kain)->value('NAMA_KAIN');

                $id_kertas = StokKertas::where('ID_STOK_KERTAS', $temp->ID_STOK_KERTAS)->value('ID_KERTAS');
                $temp->nama_kertas = Kertas::where('ID_KERTAS', $id_kertas)->value('NAMA_KERTAS');
            }
        } else if ($model_name == 'Volume') {
            $data_db1 = Volume::all();
        } else if ($model_name == 'Warna') {
            $data_db1 = Warna::all();
        } else if ($model_name == 'Riwayat') {
            $data_db1 = Riwayat::all();
        }

        return view('table/' . $link . "Table", [
            "user1" => "Admin",
            "user2" => "Karyawan",
            "title" => (count($arr) == 1) ? "Tabel " . $arr[0] : "Tabel " . $arr[0] . " " . $arr[1],
            "data" => $data_db1
        ]);
    }
}
