<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Http\Request;
use App\Models\UmkmBinaan;
use App\Http\Requests\UmkmBinaanRequest;
use Illuminate\Support\Str;
use File;

class UmkmBinaanController extends Controller
{
    
        private $param;
        
        public function __construct()
        {
            $this->param['title'] = 'UMKM Binaan';
            $this->param['pageTitle'] = 'UMKM Binaan';
            $this->param['pageIcon'] = 'user-friends';
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
                $getUmkmBinaan = UmkmBinaan::select('umkm_binaan.*', 'kota.nama_kota')
                                            ->join('kota', 'kota.id', 'umkm_binaan.id_kota')
                                            ->orderBy('nama', 'ASC');
    
                if ($keyword) {
                    $getUmkmBinaan->where('nama', 'LIKE', "%$keyword%");
                }
    
                $this->param['UmkmBinaan'] = $getUmkmBinaan->paginate(10);
            } catch (\Exception $e) {
                return redirect()->back()->withStatus('Terjadi Kesalahan');
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
        public function store(UmkmBinaanRequest $request)
        {
            try {
                if($request->file('foto') != null) {
                    $folder = 'upload/umkm-binaan/';
                    $file = $request->file('foto');
                    $filename = date('YmdHis').$file->getClientOriginalName();
                    // Get canonicalized absolute pathname
                    $path = realpath($folder);
    
                    // If it exist, check if it's a directory
                    if(!($path !== true AND is_dir($path)))
                    {
                        // Path/folder does not exist then create a new folder
                        mkdir($folder, 0755, true);
                    }
                    if($file->move($folder, $filename)) {
                        $newUmkm = new UmkmBinaan;
                        $newUmkm->nama = $request->get('nama');
                        $newUmkm->slug = Str::slug($request->get('nama'));
                        $newUmkm->id_kota = $request->get('id_kota');
                        $newUmkm->jenis_usaha = $request->get('jenis_usaha');
                        $newUmkm->alamat = $request->get('alamat');
                        $newUmkm->no_telp = $request->get('no_telp');
                        $newUmkm->deskripsi = $request->get('deskripsi');
                        $newUmkm->foto = $folder.'/'.$filename;

                        $newUmkm->save();
        
                        // UmkmBinaan::create($attr);
        
                        return redirect()->route('umkm-binaan.index')
                                ->withStatus('Berhasil menyimpan data');
                    }
                }
            } catch (\Exception $e) {
                return $e->getMessage();
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return $e->getMessage();
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
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
            try {
                $updateUmkm = UmkmBinaan::find($id);
                $currentFoto = $updateUmkm->foto;

                if($request->file('foto') != null) {
                    $folder = 'upload/umkm-binaan/';
                    $file = $request->file('foto');
                    $filename = date('YmdHis').$file->getClientOriginalName();
                    // Get canonicalized absolute pathname
                    $path = realpath($folder);

                    // If it exist, check if it's a directory
                    if(!($path !== true AND is_dir($path)))
                    {
                        // Path/folder does not exist then create a new folder
                        mkdir($folder, 0755, true);
                    }
                    if($currentFoto != null){
                        if(file_exists($currentFoto)){
                            if(File::delete($currentFoto)){
                                if($file->move($folder, $filename)) {
                                    $updateUmkm->foto = $folder.'/'.$filename;
                                }
                            }
                        }
                    }
                }
                
                $updateUmkm->nama = $request->get('nama');
                $updateUmkm->slug = Str::slug($request->get('nama'));
                $updateUmkm->id_kota = $request->get('id_kota');
                $updateUmkm->jenis_usaha = $request->get('jenis_usaha');
                $updateUmkm->alamat = $request->get('alamat');
                $updateUmkm->no_telp = $request->get('no_telp');
                $updateUmkm->deskripsi = $request->get('deskripsi');

                $updateUmkm->save();

                // $attr = $request->all();
                // $attr['slug'] = $request->get('nama');
                // $UmkmBinaan->update($attr);

                return redirect()
                            ->route('umkm-binaan.index')
                            ->withStatus('Berhasil menyimpan data'); 
            } catch (\Exception $e) {
                return $e->getMessage();
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return $e->getMessage();
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
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
            try {
                $umkm = UmkmBinaan::findOrFail($id);

                $foto = $umkm->foto;

                if($umkm->delete()){
                    File::delete($foto);
                    return redirect()->route('umkm-binaan.index')->withStatus('Data berhasil dihapus.');
                }
                else {
                    return redirect()->route('umkm-binaan.index')->withError('Data gagal dihapus.');
                }

            } catch (\Exception $e) {
                return redirect()->route('umkm-binaan.index')->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('umkm-binaan.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        }
    
    
}
