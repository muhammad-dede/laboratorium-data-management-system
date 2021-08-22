<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $primaryKey = 'id_alat';
    public $timestamps = false;

    protected $fillable = [
        'id_alat',
        'kode',
        'alat',
        'satuan',
        'stok',
        'hilang',
        'rusak',
        'id_rak',
    ];

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak', 'id_rak');
    }
}
