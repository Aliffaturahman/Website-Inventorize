<?php

namespace App\Models;

use App\Models\Tinta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Volume extends Model
{
    use HasFactory;
    protected $table = 'volume';
    protected $primaryKey = 'ID_VOLUME';
    public $timestamps = true;

    protected $fillable = ['VOLUME'];

    public function tinta()
    {
        return $this->hasMany(Tinta::class, 'ID_TINTA');
    }
}
