<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kilat extends Model
{
    protected $fillable = [
        'user_id', 
        'tanggal', 
        'pinjam', 
        'cicilan',
        'provisi',
        'administrasi',
        'jasa',
        'pemupukan',
        'flag_lunas',
        'kf',
    ];

    public function scopeSearch($query, $s)
    {
        return $query->whereHas('user', function ($query) use ($s) {
            $query->where('no_anggota', 'like', '%'.$s.'%')
                   ->orWhere('no_identitas', 'like', '%'.$s.'%')
                    ->orWhere('nama_depan', 'like', '%'.$s.'%')
                     ->orWhere('nama_belakang', 'like', '%'.$s.'%');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function kilatDetail()
    {
        return $this->hasMany(KilatDetail::class);
    }

}
