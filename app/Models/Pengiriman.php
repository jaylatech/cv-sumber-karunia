<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'pengiriman';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function statusPengiriman()
    {
        return $this->hasOne(StatusPengiriman::class, 'pengiriman_id');
    }
}
