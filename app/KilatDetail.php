<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KilatDetail extends Model
{
    protected $fillable = [
        'kilat_id', 
        'tanggal', 
        'bayar', 
        'jasa',
        'subtotal',
    ];

    public function kilat()
    {
        return $this->belongsTo(Kilat::class);
    }

}