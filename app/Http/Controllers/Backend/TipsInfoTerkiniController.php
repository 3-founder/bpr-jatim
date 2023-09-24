<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PengumumanLelangJaminan;
use App\Models\TipsKeamananInfoTerkini;
use Illuminate\Http\Request;

class TipsInfoTerkiniController extends Controller
{
    private $param;
    private $menu;
    
    public function __construct()
    {
        $this->param['title'] = 'Tips Keamanan & Info Terkini';
        $this->param['pageTitle'] = 'Tips Keamanan & Info Terkini';
        $this->param['pageIcon'] = 'info';
        $this->menu = 'Berita & Info - Tips Keamanan & Info Terkini';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->hasPermission($this->menu)){
            try {
                $this->param['data'] = TipsKeamananInfoTerkini::first();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('tips-info-terkini.index')->withError('Terjadi Kesalahan');
            }
    
            return \view('backend.tips-info-terkini.index', $this->param);
        } else
            return view('error_page.forbidden');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->hasPermission($this->menu)){
            $this->validate($request, [
                'judul_tips' => 'required',
                'konten' => 'required',
                'judul_info' => 'required',
                'konten_info' => 'required',
            ], [
                'required' => ':attribute tidak boleh kosong.'
            ], [
                'judul_tips' => 'Judul Tips Keamanan',
                'konten' => 'Konten Tips Keamanan',
                'judul_info' => 'Judul Info Terkini',
                'konten_info' => 'Konten Info Terkini',
            ]);
    
            try {
                $newData = TipsKeamananInfoTerkini::findOrFail($id);
                $newData->judul_tips_keamanan = $request->get('judul_tips');
                $newData->konten_tips_keamanan = $request->get('konten');
                $newData->judul_info_terkini = $request->get('judul_info');
                $newData->konten_info_terkini = $request->get('konten_info');
                $newData->save();
    
                return back()->withStatus('updated Successfully!');
            } catch (\Exception $e) {
                return $e->getMessage();
                return redirect()->route('tips-info-terkini.index')->withError('Terjadi Kesalahan');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('tips-info-terkini.index')->withError('Terjadi Kesalahan');
            }
        } else return view('error_page.forbidden');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
