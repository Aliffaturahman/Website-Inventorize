<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $table = 'riwayat';
    protected $primaryKey = 'ID_RIWAYAT';
    public $timestamps = true;

    protected $fillable = ['JENIS_BARANG', 'NAMA_BARANG', 'JUMLAH_BARANG', 'STATUS'];
}
