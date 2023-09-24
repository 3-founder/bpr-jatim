<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BeritaInfo;
use App\Models\PengaduanNasabah;
use Illuminate\Http\Request;

class BeritaInfoController extends Controller
{
    private $param;
    private $menu;
    
    public function __construct()
    {
        $this->param['title'] = 'Berita & Info';
        $this->param['pageTitle'] = 'Berita & Info';
        $this->param['pageIcon'] = 'landmark';
        $this->menu = 'Berita & Info - Berita';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($this->hasPermission($this->menu)){
            $tipe = $request->get('t');
            try {
                if (!$tipe) {
                    return redirect()->route('berita-info.index')->withError('Terjadi Kesalahan');
                }
                $this->param['data'] = BeritaInfo::where('tipe', $tipe)->get();
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('berita-info.index')->withError('Terjadi Kesalahan');
            }
    
            return \view('backend.berita-info.list-about', $this->param);
        } else return view('error_page.forbidden');
    }

    public function listPengaduanNasabah(Request $request)
    {
        
    }

    public function detailPengaduanNasabah($id)
    {
        
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
        //
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
