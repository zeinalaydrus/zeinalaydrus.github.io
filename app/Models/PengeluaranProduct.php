<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranProduct extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran_product';
    protected $fillable = [
        'raw_id',
        'raw_stock',
        'tanggal_keluar',
        'bukti',
        'description',
    ];

    public function raw()
    {
        return $this->belongsTo(Raw::class);
    }
}
