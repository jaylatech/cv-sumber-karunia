<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama',
        'harga',
        'berat',
        'masa_penyimpanan',
        'deskripsi'
    ];

    public function stok()
    {
        return $this->hasOne(Stok::class, 'produk_id');
    }

    public function photos()
    {
        return $this->hasMany(Foto::class);
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'produk_kategori', 'produk_id', 'kategori_id')->withTimestamps();
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'produk_id')->withTimestamps();
    }

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
