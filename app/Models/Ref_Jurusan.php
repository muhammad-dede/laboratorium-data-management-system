<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ref_Jurusan extends Model
{
    use HasFactory;

    protected $table = 'ref_jurusan';
    protected $primaryKey = 'kode_jurusan';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kode_jurusan',
        'jurusan',
        'kompetensi',
    ];
}
