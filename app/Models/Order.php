<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'order_id');
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class, 'order_id');
    }

    public function riwayat()
    {
        return $this->hasOne(Riwayat::class, 'order_id');
    }
}
