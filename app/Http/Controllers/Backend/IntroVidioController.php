<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\IntroVidio;

class IntroVidioController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Vidio Intro';
        $this->param['pageTitle'] = 'Vidio Intro';
        $this->param['pageIcon'] = 'film';
    }

    public function index(Request $request)
    {

        try {
            $this->param['vidio'] = IntroVidio::first();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.intro-vidio.edit-intro-vidio', $this->param);
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate(
            [
                'vidio_url' => 'required',
            ],
            [
                'vidio_url.required' => ':attribute tidak boleh kosong.',
            ],
            [
                'vidio_url' => 'Vidio URL',
            ]
        );
        try {
            $introVidio = IntroVidio::find($id);
                
            $introVidio->vidio_url = $request->get('vidio_url');
            
            $introVidio->save();

            return redirect()->route('intro-vidio.index')->withStatus('Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }
}
