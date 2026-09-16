<?php

namespace App\Models;

use App\Models\Warna;
use App\Models\Volume;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tinta extends Model
{
    use HasFactory;
    protected $table = 'tinta';
    protected $primaryKey = 'ID_TINTA';
    public $timestamps = true;

    protected $fillable = ['ID_WARNA', 'ID_VOLUME', 'JUMLAH_TINTA'];

    public function warna()
    {
        return $this->belongsTo(Warna::class, 'ID_WARNA');
    }

    public function volume()
    {
        return $this->belongsTo(Volume::class, 'ID_VOLUME');
    }
}
