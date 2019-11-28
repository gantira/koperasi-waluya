<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AngsuranDetail extends Model
{
	protected $fillable = [
        'angsuran_id', 
        'tanggal', 
        'bayar', 
        'jasa',
        'subtotal',
    ];

    public function angsuran()
    {
        return $this->belongsTo(Angsuran::class);
    }

}
