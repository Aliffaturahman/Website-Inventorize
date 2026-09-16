<?php

namespace App\Models;

use App\Models\Tinta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warna extends Model
{
    use HasFactory;
    protected $table = 'warna';
    protected $primaryKey = 'ID_WARNA';
    public $timestamps = true;

    protected $fillable = ['WARNA'];

    public function tinta()
    {
        return $this->hasMany(Tinta::class, 'ID_TINTA');
    }
}
