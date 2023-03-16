<?php

namespace App\Http\Requests\Api;

use App\Exceptions\Api\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PengaduanNasabahRequest extends FormRequest
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
        $genders = [
            'Laki-Laki', 'Perempuan',
        ];

        $rekenings = [
            'Tabungan', 'Deposito', 'ATM', 'Kredit', 'Lainnya',
        ];

        return [
            'id_kota' => 'required|exists:kota,id',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => [
                'required', Rule::in($genders),
            ],
            'jenis_identitas' => 'required',
            'nomor_identitas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'no_hp' => 'required',
            'no_fax' => 'required',
            'no_rekening' => 'required',
            'nama_perwakilan' => 'required',
            'tempat_lahir_perwakilan' => 'required',
            'tgl_lahir_perwakilan' => 'required|date',
            'jenis_kelamin_perwakilan' => [
                'required', Rule::in($genders),
            ],
            'jenis_identitas_perwakilan' => 'required',
            'nomor_identitas_perwakilan' => 'required',
            'alamat_perwakilan' => 'required',
            'no_telp_perwakilan' => 'required',
            'no_hp_perwakilan' => 'required',
            'no_fax_perwakilan' => 'required',
            'jenis_rekening' => [
                'required', Rule::in($rekenings),
            ],
            'detail_pengaduan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong.',
            'exists' => ':attribute tidak valid',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator->errors());
    }
}
