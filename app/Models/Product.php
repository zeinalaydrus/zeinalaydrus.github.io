<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name',
        'image',
        'stock',
        'description'
    ];

    public function pengeluaranproducts()
    {
        return $this->hasMany(PengeluaranProduct::class);
    }

    public function pemasukanproducts()
    {
        return $this->hasMany(PemasukanProduct::class);
    }
}
