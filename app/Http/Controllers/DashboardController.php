<?php

namespace App\Http\Controllers;

use App\Models\Kain;
use App\Models\Kertas;
use App\Models\Riwayat;
use App\Models\StokKain;
use App\Models\Transaksi;
use App\Models\StokKertas;

class DashboardController extends Controller
{
    
    public function dashboard()
    {
        // Get the current month and year
        $month = date('m');
        $year = date('Y');

        // Query to get the total barang in and out for the current month
        $barangIn = Riwayat::where('STATUS', '=', 'Masuk')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('jumlah_barang');

        $barangOut = Riwayat::where('STATUS', '=', 'Keluar')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('jumlah_barang');

        $transaksi = Transaksi::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count('ID_TRANSAKSI');

        $newestTransaksi = Transaksi::latest('created_at')->take(5)->get();
        foreach ($newestTransaksi as $temp) {
            $id_stok_kain = $temp->ID_STOK_KAIN;
            $id_stok_kertas = $temp->ID_STOK_KERTAS;

            $stok_kain = StokKain::findOrFail($id_stok_kain);
            $stok_kertas = StokKertas::findOrFail($id_stok_kertas);

            $kain = Kain::findOrFail($stok_kain->ID_KAIN);
            $kertas = Kertas::findOrFail($stok_kertas->ID_KERTAS);

            $temp->nama_kain = $kain->NAMA_KAIN;
            $temp->nama_kertas = $kertas->NAMA_KERTAS;
        }

        $newestRiwayat = Riwayat::latest('created_at')->take(5)->get();

        // // Pass the data to the dashboard view
        return view('page.dashboard', ['barangIn' => $barangIn, 'barangOut' => $barangOut, 'transaksi' => $transaksi, 'newestTransaksi' => $newestTransaksi, 'newestRiwayat' => $newestRiwayat, 'title' => 'Dashboard']);
    }
}
