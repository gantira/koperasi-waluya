<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'besar_angsuran',
        'administrasi_angsuran',
    	'administrasi_kilat',
        'jasa_angsuran',
        'provisi_angsuran',
        'pemupukan_angsuran',
        'besar_kilat',
        'jasa_kilat',
        'provisi_kilat',
        'pemupukan_kilat',
        'cek_pinjaman',
        'max_pinjaman',
        'jasa_pengurus',
        'jasa_pengawas',
        'shu_sosial',
        'shu_cadangan',
        'jasa_simpanan',
        'jasa_pinjaman',
        'rit_simpanan_manasuka',
        'rit_simpanan_wajib',
    ];
}


            