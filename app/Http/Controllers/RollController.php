<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use Illuminate\Http\Request;

class RollController extends Controller
{
    public function getRolls(Request $request)
    {
        $rolls = Roll::where('ID_STOK_KAIN', $request->input('idStokKain'))->get();

        return response()->json($rolls);
    }
}
