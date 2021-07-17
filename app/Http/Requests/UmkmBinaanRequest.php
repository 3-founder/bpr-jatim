<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UmkmBinaanRequest extends FormRequest
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
            'nama' => 'required',
            'id_kota'     => 'required|not_in:0',
            'jenis_usaha' => 'required',
            'alamat' => 'required',
            'no_telp'     => 'required',
            'deskripsi'     => 'required',
            'foto'     => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong.',
            'not_in'     => ':attribute harus dipilih.',
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama',
            'id_kota'     => 'Wilayah',
            'jenis_usaha' => 'Jenis Usaha',
            'alamat' => 'Alamat',
            'no_telp'     => 'Nomor Telepon',
            'deskripsi'     => 'Deskripsi',
            'foto'     => 'Foto'
        ];
    }
}
