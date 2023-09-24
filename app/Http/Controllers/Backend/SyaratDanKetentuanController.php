<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\SyaratDanKetentuan;

class SyaratDanKetentuanController extends Controller
{
    private $param;
    private $menu;

    public function __construct()
    {
        $this->param['title'] = 'Syarat dan Ketentuan';
        $this->param['pageTitle'] = 'Syarat dan Ketentuan';
        $this->param['pageIcon'] = 'user-shield';
        $this->menu = 'Master Syarat dan Ketentuan';
    }

    public function index(Request $request)
    {
        if($this->hasPermission($this->menu)){
            try {
                $this->param['sk'] = SyaratDanKetentuan::first();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withStatus('Terjadi Kesalahan');
            }
    
            return \view('backend.sk.sk', $this->param);
        } else return view('error_page.forbidden');
    }

    public function update(Request $request, $id)
    {
        if($this->hasPermission($this->menu)){
            $validatedData = $request->validate(
                [
                    'syarat_dan_ketentuan' => 'required',
                ],
                [
                    'syarat_dan_ketentuan.required' => ':attribute tidak boleh kosong.',
                ],
                [
                    'syarat_dan_ketentuan' => 'Syarat dan ketentuan',
                ]
            );
            try {
                $sk = SyaratDanKetentuan::find($id);
                    
                $sk->syarat_dan_ketentuan = $request->get('syarat_dan_ketentuan');
                $sk->save();
    
                return redirect()->route('sk.index')->withStatus('Data berhasil diperbarui.');
            } catch (\Exception $e) {
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        } else return view('error_page.forbidden');
    }
}
