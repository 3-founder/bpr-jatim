<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PromoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'judul' => 'required',
            'cover' => 'required|file|image',
            'konten' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong.',
        ];
    }
}
