<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\KebijakanPrivasi;

class KebijakanPrivasiController extends Controller
{
    private $param;
    private $menu;

    public function __construct()
    {
        $this->param['title'] = 'Kebijakan Privasi';
        $this->param['pageTitle'] = 'Kebijakan Privasi';
        $this->param['pageIcon'] = 'user-shield';
        $this->menu = 'Master Kebijakan Privasi';
    }

    public function index(Request $request)
    {
        if($this->hasPermission($this->menu)){
            try {
                $this->param['kebijakanPrivasi'] = KebijakanPrivasi::first();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withStatus('Terjadi Kesalahan');
            }
    
            return \view('backend.kebijakan-privasi.kebijakan-privasi', $this->param);
        } else return view('error_page.forbidden');
    }

    public function update(Request $request, $id)
    {
        if($this->hasPermission($this->menu)){
            
            $validatedData = $request->validate(
                [
                    'kebijakan_privasi' => 'required',
                ],
                [
                    'kebijakan_privasi.required' => ':attribute tidak boleh kosong.',
                ],
                [
                    'kebijakan_privasi' => 'Kebijakan privasi',
                ]
            );
            try {
                $kebijakanPrivasi = KebijakanPrivasi::find($id);
                    
                $kebijakanPrivasi->kebijakan_privasi = $request->get('kebijakan_privasi');
                $kebijakanPrivasi->save();
    
                return redirect()->route('kebijakan-privasi.index')->withStatus('Data berhasil diperbarui.');
            } catch (\Exception $e) {
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        } else return view('error_page.forbidden');
    }
}
