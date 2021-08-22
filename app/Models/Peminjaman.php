<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'no_peminjaman';
    public $timestamps = false;

    protected $fillable = [
        'no_peminjaman',
        'id_jadwal_praktek',
        'id_siswa',
        'id_guru',
        'id_petugas',
        'tgl_peminjaman',
        'waktu_peminjaman',
        'kode_status',
    ];

    public function jadwal_praktek()
    {
        return $this->belongsTo(JadwalPraktek::class, 'id_jadwal_praktek', 'id_jadwal_praktek');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    public function ref_status()
    {
        return $this->belongsTo(Ref_Status::class, 'kode_status', 'kode_status');
    }

    public function peminjaman_detail()
    {
        return $this->hasMany(Peminjaman_Detail::class, 'no_peminjaman', 'no_peminjaman');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'no_peminjaman', 'no_peminjaman');
    }
}
