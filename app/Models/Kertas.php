<?php

namespace App\Models;

use App\Models\StokKertas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kertas extends Model
{
    use HasFactory;
    protected $table = 'kertas';
    protected $primaryKey = 'ID_KERTAS';
    public $timestamps = true;

    protected $fillable = ['NAMA_KERTAS'];

    public function stokKertas()
    {
        return $this->hasMany(StokKertas::class, 'ID_STOK_KERTAS');
    }
}
