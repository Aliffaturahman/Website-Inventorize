<?php

namespace App\Models;

use App\Models\StokKain;
use App\Models\StokKertas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'ID_TRANSAKSI';
    public $timestamps = true;

    protected $fillable = ['ID_STOK_KERTAS', 'JUMLAH_KERTAS', 'ID_STOK_KAIN', 'JUMLAH_KAIN', 'TGL', 'KETERANGAN'];

    public function stokKertas()
    {
        return $this->belongsTo(StokKertas::class, 'ID_STOK_KERTAS');
    }

    public function stokKain()
    {
        return $this->belongsTo(StokKain::class, 'ID_STOK_KAIN');
    }
}
