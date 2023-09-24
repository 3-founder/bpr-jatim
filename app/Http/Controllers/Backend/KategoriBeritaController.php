<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\KategoriBerita;

class KategoriBeritaController extends Controller
{
    private $param;
    private $menu;

    public function __construct()
    {
        $this->param['title'] = 'Kategori Berita';
        $this->param['pageTitle'] = 'Kategori Berita';
        $this->param['pageIcon'] = 'newspaper';
        $this->menu = 'Berita & Info - Kategori Berita';
    }

    public function index(Request $request)
    {
        if($this->hasPermission($this->menu)){
            
                    $this->param['btnRight']['text'] = 'Tambah';
                    $this->param['btnRight']['link'] = route('kategori-berita.create');
            
                    try {
                        $keyword = $request->get('keyword');
                        $getKategori = KategoriBerita::orderBy('id', 'DESC');
            
                        if ($keyword) {
                            $getKategori->Where('kategori', 'LIKE', "%$keyword%");
                        }
            
                        $this->param['data'] = $getKategori->paginate(10);
                    } catch (\Illuminate\Database\QueryException $e) {
                        return redirect()->back()->withStatus('Terjadi Kesalahan');
                    }
            
                    return \view('backend.kategori-berita.index', $this->param);
        } else return view('error_page.forbidden');
    }

    public function create()
    {
        if($this->hasPermission($this->menu)){
            
                    $this->param['btnRight']['text'] = 'Lihat Data';
                    $this->param['btnRight']['link'] = route('kategori-berita.index');
            
                    return \view('backend.kategori-berita.create', $this->param);
        } else return view('error_page.forbidden');
    }

    public function store(Request $request)
    {
        if($this->hasPermission($this->menu)){
            $validatedData = $request->validate(
                [
                    'kategori' => 'required|unique:kategori_berita',
                ],
                [
                    'required' => ':attribute tidak boleh kosong.',
                    'unique' => ':attribute telah terdaftar'
                ],
                [
                    'kategori' => 'Kategori',
                ]
            );
            try {
                $newKategoriBerita = new KategoriBerita;
    
                $newKategoriBerita->kategori = $request->get('kategori');
    
                $newKategoriBerita->save();
    
                return redirect()->route('kategori-berita.index')->withStatus('Data berhasil ditambahkan.');
            } catch (\Exception $e) {
                return redirect()->route('kategori-berita.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('kategori-berita.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        } else return view('error_page.forbidden');
    }

    public function edit($id)
    {
        if($this->hasPermission($this->menu)){
            try {
                $this->param['btnRight']['text'] = 'Lihat Data';
                $this->param['btnRight']['link'] = route('kategori-berita.index');
    
                $this->param['kategori'] = KategoriBerita::find($id);
    
                return \view('backend.kategori-berita.edit', $this->param);
            } catch (\Exception $e) {
                return redirect()->back()->withError('Terjadi kesalahan');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError('Terjadi kesalahan');
            }
        } else return view('error_page.forbidden');
    }

    public function update(Request $request, $id)
    {
        if($this->hasPermission($this->menu)){
            $kategori = KategoriBerita::find($id);
    
            $isUnique = $kategori->kategori == $request->get('kategori') ? '' : '|unique:kategori_berita';
    
            $validatedData = $request->validate(
                [
                    'kategori' => 'required',
                ],
                [
                    'required' => ':attribute tidak boleh kosong.',
                    'unique' => ':attribute telah terdaftar',
                ],
                [
                    'kategori' => 'Kategori',
                ]
            );
            try {
    
                $kategori->kategori = $request->get('kategori');
    
                $kategori->save();
    
                return redirect()->route('kategori-berita.index')->withStatus('Data berhasil disimpan.');
            } catch (\Exception $e) {
                return redirect()->route('kategori-berita.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('kategori-berita.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        } else return view('error_page.forbidden');
    }

    public function destroy($id)
    {
        if($this->hasPermission($this->menu)){
            try {
                $kategori = KategoriBerita::find($id);
    
                $kategori->delete();
    
                return redirect()->back()->withStatus('Berhasil menghapus data.');
            } catch (\Exception $e) {
                return redirect()->back()->withError($e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError($e->getMessage());
            }
        } else return view('error_page.forbidden');
    }
}
