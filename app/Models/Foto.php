<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'path'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class)->withTimestamps();
    }
}
