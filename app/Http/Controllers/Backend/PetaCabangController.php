<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PetaCabang;
use Illuminate\Http\Request;

class PetaCabangController extends Controller
{
    private $param;
    private $menu;
    
    public function __construct()
    {
        $this->param['title'] = 'Peta Cabang';
        $this->param['pageTitle'] = 'Peta Cabang';
        $this->param['pageIcon'] = 'map';
        $this->menu = 'Berita & Info - Peta Cabang';
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
                $this->param['peta'] = PetaCabang::first();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('peta-cabang.index')->withError('Terjadi Kesalahan');
            }
    
            return \view('backend.peta-cabang.index', $this->param);
        } else return view('error_page.forbidden');
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
                'judul' => 'required',
                'konten' => 'required'
            ], [
                'required' => ':attribute tidak boleh kosong.'
            ], [
                'judul' => 'Judul',
                'konten' => 'Url Peta'
            ]);
    
            try {
                $attr = $request->all();
                $petaUpdate = PetaCabang::find($id);
                $petaUpdate->judul = $request->get('judul');
                $petaUpdate->konten = $request->get('konten');
                $petaUpdate->save();
                // $petaUpdate->update($attr);
    
                return back()->withStatus('updated Successfully!');
            } catch (\Exception $e) {
                return $e->getMessage();
                return redirect()->route('peta-cabang.index')->withError('Terjadi Kesalahan');
            } catch (\Illuminate\Database\QueryException $e) {
                return $e->getMessage();
                return redirect()->route('peta-cabang.index')->withError('Terjadi Kesalahan');
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
