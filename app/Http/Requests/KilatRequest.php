<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KilatRequest extends FormRequest
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
            'tanggal'   => 'required|date', 
            'cicilan'   => 'required|numeric|min:0|',
            'pinjam'    => 'required|numeric|min:0', 
            'provisi'   => 'required|numeric|min:0',
            'administrasi'  => 'required|numeric|min:0',
            'pemupukan' => 'required|numeric|min:0',
        ];
    }
}