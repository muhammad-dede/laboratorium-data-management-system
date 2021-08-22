<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman_Detail extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_detail';
    protected $primaryKey = 'id_peminjaman_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_peminjaman_detail',
        'no_peminjaman',
        'id_alat',
        'qty',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'no_peminjaman', 'no_peminjaman');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat', 'id_alat');
    }
}
