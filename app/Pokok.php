<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pokok extends Model
{
    protected $fillable = [
        'user_id', 
        'tanggal', 
        'masuk', 
        'kf', 
        'keluar'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class)->withTrashed();
    }

    public function getMasukAttribute($masuk)
    {
    	return $this->attributes['masuk'] = number_format($masuk);
    }

    public function getKeluarAttribute($keluar)
    {
    	return $this->attributes['keluar'] = number_format($keluar);
    }

    public function scopeFilter($query, $awal, $akhir)
    {
        return $query->whereBetween('tanggal', [$awal, $akhir]);
    }

    public function scopeCekSaldo($query, $data, $jumlah)
    {
        return ($query->whereUserId($data->user_id)->selectRaw('sum(masuk) - sum(keluar) as total')->value('total')) >= $jumlah ? 1 : 0;
    }

    public function scopeSearch($query, $s)
    {
        return $query->whereHas('user', function ($query) use ($s) {
                    $query->where('nama_depan', 'like', '%'.$s.'%')
                            ->orWhere('nama_belakang', 'like', '%'.$s.'%')
                            ->orWhere('no_anggota', 'like', '%'.$s.'%');
        });
    }
}