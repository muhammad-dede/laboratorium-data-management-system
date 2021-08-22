<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;

    protected $table = 'rak';
    protected $primaryKey = 'id_rak';
    public $timestamps = false;

    protected $fillable = [
        'id_rak',
        'rak',
        'lokasi',
    ];

    public function alat()
    {
        return $this->hasMany(Alat::class, 'id_rak', 'id_rak');
    }
}
