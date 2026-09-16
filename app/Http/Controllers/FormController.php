<?php

namespace App\Http\Controllers;

use App\Models\Berat;
use App\Models\Kain;
use App\Models\Kertas;
use App\Models\Produksi;
use App\Models\StokKain;
use App\Models\StokKertas;
use App\Models\Tinta;
use App\Models\Volume;
use App\Models\Warna;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index($slug)
    {
        $arr = explode("_", $slug);
        return view('form/' . $slug . "Form", [
            "user1" => "Admin",
            "user2" => "Karyawan",
            "title" => (count($arr) == 1) ? "Form " . $arr[0] : "Form " . $arr[0] . " " . $arr[1],
            "stok_kains" => StokKain::all(),
            "stok_kertass" => StokKertas::all(),
            "tintas" => Tinta::all(),
            "produksis" => Produksi::all(),
            "kains" => Kain::all(),
            "kertass" => Kertas::all(),
            "berats" => Berat::all(),
            "volumes" => Volume::all(),
            "warnas" => Warna::all()
        ]);
    }
}
