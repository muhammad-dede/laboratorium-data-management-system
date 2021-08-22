<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    public $timestamps = false;

    protected $fillable = [
        'id_kelas',
        'kode_jurusan',
        'romawi',
        'grade',
        'kelas',
    ];

    public function ref_jurusan()
    {
        return $this->belongsTo(Ref_Jurusan::class, 'kode_jurusan', 'kode_jurusan');
    }
}
