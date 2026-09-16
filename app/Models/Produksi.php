<?php

namespace App\Models;

use App\Models\StokKain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produksi extends Model
{
    use HasFactory;
    protected $table = 'produksi';
    protected $primaryKey = 'ID_PRODUKSI';
    public $timestamps = true;

    protected $fillable = ['NAMA_PRODUKSI'];

    public function stokKain()
    {
        return $this->hasMany(StokKain::class, 'ID_STOK_KAIN');
    }
}
