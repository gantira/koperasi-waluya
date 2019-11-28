<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Akun extends Model
{
	use SoftDeletes;

	protected $date = ['deleted_at'];

    protected $fillable = [
        'kode', 
        'kategori_id', 
        'nama', 
        'keterangan'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
