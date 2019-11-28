<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'no_identitas'   => 'required|unique:users',
           'no_perahu'      => 'sometimes|unique:users',
           'user_id'        => 'required',
           'nama_depan'     => 'required',
           'nama_belakang'  => 'sometimes',
           'jk'             => 'sometimes',
           'tempat_lahir'   => 'sometimes',
           'tanggal_lahir'  => 'sometimes',
           'alamat'         => 'sometimes',
           'kota'           => 'sometimes',
           'provinsi'       => 'sometimes',
           'hp'             => 'sometimes',
           'email'          => 'sometimes',
           'kode_pos'       => 'sometimes',
           'biodata'        => 'sometimes',
           'password'       => 'required|min:6|confirmed',
           'role'           => 'required',
           'keterangan_anggota'           => 'required',
        ];
    }
}