<?php

namespace App\Models;

use App\Models\stokKain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roll extends Model
{
    use HasFactory;
    protected $table = 'roll';
    protected $primaryKey = 'ID_ROLL';
    public $timestamps = true;

    protected $fillable = ['ID_STOK_KAIN', 'YARD'];

    public function stokKain()
    {
        return $this->belongsTo(stokKain::class, 'ID_STOK_KAIN');
    }
}
