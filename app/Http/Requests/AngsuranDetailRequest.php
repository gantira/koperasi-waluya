<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AngsuranDetailRequest extends FormRequest
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
            'bayar'     => 'required|numeric|min:0',
            'jasa'    => 'required|numeric|min:0',
            'subtotal'   => 'required|min:0',
        ];
    }
}
