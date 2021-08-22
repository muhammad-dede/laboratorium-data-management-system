<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;

    protected $fillable = [
        'id_siswa',
        'nis',
        'nama',
        'jk',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'kode_jurusan',
        'id_kelas',
        'id_user',
    ];

    public function ref_jurusan()
    {
        return $this->belongsTo(Ref_Jurusan::class, 'kode_jurusan', 'kode_jurusan');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
