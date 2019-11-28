<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $date = ['deleted_at'];

    protected $fillable = [
        'no_anggota', 
        'no_perahu', 
        'no_identitas', 
        'nama_depan', 
        'nama_belakang', 
        'jk', 
        'kota', 
        'provinsi', 
        'kode_pos', 
        'tempat_lahir', 
        'tanggal_lahir', 
        'alamat', 
        'hp', 
        'email', 
        'password', 
        'keterangan_anggota', 
        'role', 
        'biodata'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSearch($query, $s)
    {
        return  $query->where('no_anggota', 'like', '%'.$s.'%')
                       ->orWhere('no_identitas', 'like', '%'.$s.'%')
                        ->orWhere('nama_depan', 'like', '%'.$s.'%')
                         ->orWhere('nama_belakang', 'like', '%'.$s.'%');
    }

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }

    public function getNamaDepanAttribute($value='')
    {
        return $this->attributes['nama_depan'] = strtoupper($value);
    }

    public function getNamaBelakangAttribute($value='')
    {
        return $this->attributes['nama_belakang'] = strtoupper($value);
    }

    public function wajib()
    {
        return $this->hasMany(Wajib::class);
    }

    public function pokok()
    {
        return $this->hasMany(Pokok::class);
    }

    public function manasuka()
    {
        return $this->hasMany(Manasuka::class);
    }

    public function angsuran()
    {
        return $this->hasMany(Angsuran::class);
    }

    public function angsuranDetail()
    {
        return $this->hasManyThrough(AngsuranDetail::class, Angsuran::class);
    }

    public function kilat()
    {
        return $this->hasMany(Kilat::class);
    }

    public function kilatDetail()
    {
        return $this->hasManyThrough(KilatDetail::class, Kilat::class);
    }

    public function isAdmin()
    {
        if ($this->role == 'admin') {
            return true;
        }

        return false;
    }

    public function isAnggota()
    {
        if ($this->role == 'anggota') {
            return true;
        }

        return false;
    }

    public function isPengurus()
    {
        if ($this->role == 'pengurus') {
            return true;
        }

        return false;
    }
}
