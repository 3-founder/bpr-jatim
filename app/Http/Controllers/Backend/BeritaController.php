<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Berita;
use App\Models\User;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Berita';
        $this->param['pageTitle'] = 'Berita';
        $this->param['pageIcon'] = 'newspaper';
    }
    
    public function index(Request $request)
    {
        
        $this->param['btnRight']['text'] = 'Tambah Berita';
        $this->param['btnRight']['link'] = route('berita.create');

        try {
            $keyword = $request->get('keyword');
            $getBerita = Berita::orderBy('judul', 'ASC');

            if ($keyword) {
                $getBerita->where('judul', 'LIKE', "%$keyword%")
                        ->orWhere('konten', 'LIKE', "%$keyword%")
                        ->orWhere('kategori', 'LIKE', "%$keyword%");
            }

            $this->param['data'] = $getBerita->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.berita.index', $this->param);
    }

    public function create()
    {
        
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('berita.index');

        return \view('backend.berita.create', $this->param);
    }

    public function show($id)
    {
        try {
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('berita.index');

            $this->param['konten'] = Berita::find($id);
            
            return \view('backend.berita.detail', $this->param);
        }
        catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan');
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan');
        }
    }

    public function store(Request $request)
    {
        return $request->get('konten');
        $validatedData = $request->validate(
            [
                'judul' => 'required',
                'cover' => 'required',
                'konten' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'judul' => 'Judul',
                'cover' => 'Cover',
                'konten' => 'Konten',
            ]
        );
        try {
            if($request->file('cover') != null) {
                $folder = 'upload/berita/';
                $file = $request->file('cover');
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
                    $newBerita = new Berita;

                    $newBerita->id_user = auth()->user()->id;
                    $newBerita->judul = $request->get('judul');
                    $newBerita->slug = Str::slug($request->get('judul'));
                    $newBerita->kategori = $request->get('kategori');
                    $newBerita->cover = $folder.$filename;
                    $newBerita->konten = $request->get('konten');
                    $newBerita->telah_dilihat = 0;

                    $newBerita->save();       
                }
            }

            return redirect()->route('berita.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('berita.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('berita.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('berita.index');

            $this->param['konten'] = Berita::find($id);
            
            return \view('backend.berita.edit', $this->param);
        }
        catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan');
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan');
        }
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);

        $isUnique = $berita->judul == $request->get('judul') ? '' : '|unique:berita,judul';

        $validatedData = $request->validate(
            [
                'judul' => 'required',
                'konten' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'judul' => 'Judul',
                'konten' => 'Konten',
            ]
        );
        try {
            if($request->file('cover') != null) {
                $folder = 'upload/berita/';
                $file = $request->file('cover');
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
                    $berita->cover = $folder.$filename;
                }
            }

            $berita->id_user = auth()->user()->id;
            $berita->judul = $request->get('judul');
            $berita->slug = Str::slug($request->get('judul'));
            $berita->kategori = $request->get('kategori');
            $berita->konten = $request->get('konten');

            $berita->save();   

            return redirect()->route('berita.index')->withStatus('Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('berita.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('berita.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $berita = Berita::find($id);

            $cover = $berita->cover;
            if($cover != null){
                if(file_exists($cover)){
                    if(File::delete($cover)){
                        $berita->delete();
                    }
                }
            }
            return redirect()->back()->withStatus('Berhasil menghapus data.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
