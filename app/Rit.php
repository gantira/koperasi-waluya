<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rit extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'jumlah_rit',
        'user_input',
        'kf',
    ];

    public function scopeSearch($query, $s)
    {
        return  $query->whereHas('user', function ($query) use ($s) {
                   $query->where('no_anggota', 'like', '%'.$s.'%')
                         ->orWhere('nama_depan', 'like', '%'.$s.'%')
                         ->orWhere('nama_belakang', 'like', '%'.$s.'%');
                });
    }

    public function user()
    {
    	return $this->belongsTo(User::class)->withTrashed();
    }

}
 
