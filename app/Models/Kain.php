<?php

namespace App\Models;

use App\Models\StokKain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kain extends Model
{
    use HasFactory;
    protected $table = 'kain';
    protected $primaryKey = 'ID_KAIN';
    public $timestamps = true;

    protected $fillable = ['NAMA_KAIN'];

    public function stokKain()
    {
        return $this->hasMany(StokKain::class, 'ID_STOK_KAIN');
    }
}
