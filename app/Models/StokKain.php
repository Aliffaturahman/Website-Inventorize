<?php

namespace App\Models;

use App\Models\Kain;
use App\Models\Produksi;
use App\Models\Transaksi;
use App\Models\Roll;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StokKain extends Model
{
    use HasFactory;
    protected $table = 'stok_kain';
    protected $primaryKey = 'ID_STOK_KAIN';
    public $timestamps = true;

    protected $fillable = ['ID_PRODUKSI', 'ID_KAIN', 'TOTAL_ROLL', 'TOTAL_YARD'];

    public function produksi()
    {
        return $this->belongsTo(Produksi::class, 'ID_PRODUKSI');
    }

    public function kain()
    {
        return $this->belongsTo(Kain::class, 'ID_KAIN');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'ID_TRANSAKSI');
    }

    public function roll()
    {
        return $this->hasMany(Roll::class, 'ID_ROLL');
    }
}
