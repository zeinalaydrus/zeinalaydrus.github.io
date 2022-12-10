<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanProduct extends Model
{
    use HasFactory;
    protected $table = 'pemasukan_product';
    protected $fillable = [
        'raw_id',
        'stock',
        'tanggal_masuk',
        'bukti',
        'description',
    ];

    public function raw()
    {
        return $this->belongsTo(Raw::class);
    }
}
