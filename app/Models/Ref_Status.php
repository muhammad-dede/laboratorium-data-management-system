<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ref_Status extends Model
{
    use HasFactory;

    protected $table = 'ref_status';
    protected $primaryKey = 'kode_status';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kode_status',
        'status',
        'aktif',
    ];
}
