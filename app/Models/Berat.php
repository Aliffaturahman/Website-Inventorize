<?php

namespace App\Models;

use App\Models\StokKertas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berat extends Model
{
    use HasFactory;
    protected $table = 'berat';
    protected $primaryKey = 'ID_BERAT';
    public $timestamps = true;

    protected $fillable = ['berat'];

    public function stokKertas()
    {
        return $this->hasMany(StokKertas::class, 'ID_STOK_KERTAS');
    }
}
