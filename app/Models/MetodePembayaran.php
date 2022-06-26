<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id', 'id');
    }
}
