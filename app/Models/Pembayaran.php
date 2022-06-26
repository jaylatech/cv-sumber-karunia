<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id');
    }

    public function metodePembayaran()
    {
        return $this->hasOne(MetodePembayaran::class, 'pembayaran_id');
    }
}
