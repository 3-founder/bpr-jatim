<?php

namespace App\Http\Requests\Api;

use App\Exceptions\Api\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PengajuanKreditRequest extends FormRequest
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
            'tenor' => 'required',
            'nominal' => 'required',
            'nama' => 'required',
            'telp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong.'
        ];   
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator->errors());
    }
}
