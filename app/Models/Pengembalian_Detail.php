<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian_Detail extends Model
{
    use HasFactory;

    protected $table = 'pengembalian_detail';
    protected $primaryKey = 'id_pengembalian_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_pengembalian_detail',
        'id_pengembalian',
        'id_alat',
        'qty',
        'kode_kondisi',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Pengembalian::class, 'id_pengembalian', 'id_pengembalian');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat', 'id_alat');
    }

    public function ref_kondisi()
    {
        return $this->belongsTo(Ref_Kondisi::class, 'kode_kondisi', 'kode_kondisi');
    }
}
