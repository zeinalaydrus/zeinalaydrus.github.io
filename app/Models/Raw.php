<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raw extends Model
{
    use HasFactory;
    protected $table = 'raw';
    protected $fillable = [
        'name',
        'image',
        'stock',
        'description'
    ];
    public function pengeluaranraws()
    {
        return $this->hasMany(PengeluaranRaw::class);
    }

    public function pemasukanraws()
    {
        return $this->hasMany(PemasukanRaw::class);
    }
}
