<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
		'akun_id',
		'tanggal',
		'masuk',
        'keluar',
		'keterangan',
    ];	

    public function akun()
    {
    	return $this->belongsTo(Akun::class);
    }

    public function scopeSearch($query, $s)
    {
        return  $query->whereHas('akun', function ($query) use ($s) {
                    $query->where('nama', 'like', '%'.$s.'%')
                            ->orWhere('kode', 'like', '%'.$s.'%');
        });
    }

}	
    	
            
            
            