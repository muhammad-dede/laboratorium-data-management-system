<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ref_Kondisi extends Model
{
    use HasFactory;

    protected $table = 'ref_kondisi';
    protected $primaryKey = 'kode_kondisi';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kode_kondisi',
        'kondisi',
        'aktif',
    ];
}
