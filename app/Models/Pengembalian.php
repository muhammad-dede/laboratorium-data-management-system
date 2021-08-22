<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    public $timestamps = false;

    protected $fillable = [
        'id_pengembalian',
        'no_peminjaman',
        'tgl_pengembalian',
        'waktu_pengembalian',
        'id_petugas',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'no_peminjaman', 'no_peminjaman');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    public function pengembalian_detail()
    {
        return $this->hasMany(Pengembalian_Detail::class, 'id_pengembalian', 'id_pengembalian');
    }
}
