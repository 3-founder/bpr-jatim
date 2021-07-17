<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Http\Request;
use App\Models\UmkmBinaan;

class UmkmBinaanController extends Controller
{
    
        private $param;
        
        public function __construct()
        {
            $this->param['title'] = 'Master Wilayah';
            $this->param['pageTitle'] = 'Master Wilayah';
            $this->param['pageIcon'] = 'city';
        }
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
            $this->param['btnRight']['text'] = 'Tambah Konten';
            $this->param['btnRight']['link'] = route('umkm-binaan.create');
    
            try {
                $keyword = $request->get('keyword');
                $getUmkmBinaan = UmkmBinaan::orderBy('nama', 'ASC');
    
                if ($keyword) {
                    $getUmkmBinaan->where('nama', 'LIKE', "%$keyword%");
                }
    
                $this->param['UmkmBinaan'] = $getUmkmBinaan->paginate(10);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withStatus('Terjadi Kesalahan');
            }
    
            return \view('backend.umkm-binaan.index', $this->param);
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('umkm-binaan.index');
            $this->param['kota'] = Kota::all();
            // dd($this->param['kota']);
            return \view('backend.umkm-binaan.create', $this->param);
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            if ($request->hasFile('foto')) {
                $resource = $request->file('foto');
                $name = $resource->getClientOriginalName();
                $resource->move(\base_path(). "/public/images", $name);
                
                $attr = $request->all();
                $attr['foto'] = $name;

                UmkmBinaan::create($attr);

                return back()
                        ->withStatus('berhasil ditambah');
            }
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
            try {
                $this->param['title'] = 'Edit Wilayah';
                $this->param['pageTitle'] = 'Edit Wilayah';
                $this->param['pageIcon'] = 'boxes';
                $this->param['btnRight']['text'] = 'Lihat Data';
                $this->param['btnRight']['link'] = route('umkm-binaan.index');
                $this->param['UmkmBinaan'] = UmkmBinaan::find($id);
                $this->param['kota'] = Kota::all();
    
                return \view('backend.umkm-binaan.edit', $this->param);
            } catch (\Exception $e) {
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
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
            $UmkmBinaan = UmkmBinaan::find($id);

            if ($request->hasFile('foto') != null) {
                $path = public_path(). '/images/';

                // remove old image
                if ($UmkmBinaan->foto != '' && $UmkmBinaan->foto != null) {
                    $images_old = $path.$UmkmBinaan->foto;
                    unlink($images_old);
                    // updload new images
                    $file = $request->file('foto');
                    $image_name = $file->getClientOriginalName();
                    $file->move($path, $image_name);
                }
                if ($UmkmBinaan->foto == null) {
                    $file = $request->file('foto');
                    $image_name = $file->getClientOriginalName();
                }

                $attr = $request->all();
                $attr['foto'] = $image_name;
                $UmkmBinaan->update($attr);

                return redirect()
                            ->route('umkm-binaan.index')
                            ->withStatus('Berhasil di update'); 
              

            }
            
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Request $request, $id)
        {
            $data = UmkmBinaan::findOrFail($id);
            $image_path = public_path(). '/images/'. $data->foto;
            unlink($image_path);
            $data->delete();

            return back();
        }
    
    
}
