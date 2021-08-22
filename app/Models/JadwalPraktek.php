<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktek extends Model
{
    use HasFactory;

    protected $table = 'jadwal_praktek';
    protected $primaryKey = 'id_jadwal_praktek';
    public $timestamps = false;

    protected $fillable = [
        'id_jadwal_praktek',
        'id_mapel',
        'id_guru',
        'id_kelas',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
}
