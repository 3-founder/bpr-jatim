<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Profil;

class ProfilController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Profil';
        $this->param['pageTitle'] = 'Profil';
        $this->param['pageIcon'] = 'address-card';
    }

    public function index(Request $request)
    {

        try {
            $this->param['profil'] = Profil::first();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.profil.profil', $this->param);
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate(
            [
                'kantor_pusat' => 'required',
                'facebook' => 'required',
                'instagram' => 'required',
                'youtube' => 'required',
                'email' => 'required',
            ],
            [
                'kantor_pusat.required' => ':attribute tidak boleh kosong.',
                'facebook.required' => ':attribute tidak boleh kosong.',
                'instagram.required' => ':attribute tidak boleh kosong.',
                'youtube.required' => ':attribute tidak boleh kosong.',
                'email.required' => ':attribute tidak boleh kosong.',
            ],
            [
                'kantor_pusat' => 'Kantor pusat',
                'facebook' => 'Facebook',
                'instagram' => 'Instagram',
                'youtube' => 'Youtube',
                'email' => 'Email'
            ]
        );
        try {
            $profil = Profil::find($id);
                
            $profil->kantor_pusat = $request->get('kantor_pusat');
            $profil->facebook = $request->get('facebook');
            $profil->instagram = $request->get('instagram');
            $profil->youtube = $request->get('youtube');
            $profil->email = $request->get('email');
            $profil->telepon1 = $request->get('telepon1');
            $profil->telepon2 = $request->get('telepon2');
            $profil->telepon3 = $request->get('telepon3');
            $profil->save();

            return redirect()->route('profil.index')->withStatus('Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }
}
