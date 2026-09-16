<?php

namespace App\Models;

use App\Models\Berat;
use App\Models\Kertas;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StokKertas extends Model
{
    use HasFactory;
    protected $table = 'stok_kertas';
    protected $primaryKey = 'ID_STOK_KERTAS';
    public $timestamps = true;

    protected $fillable = ['ID_BERAT', 'ID_KERTAS', 'LEBAR', 'PANJANG', 'JUMLAH_KERTAS'];

    public function berat()
    {
        return $this->belongsTo(Berat::class, 'ID_BERAT');
    }

    public function kertas()
    {
        return $this->belongsTo(Kertas::class, 'ID_KERTAS');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'ID_TRANSAKSI');
    }
}
