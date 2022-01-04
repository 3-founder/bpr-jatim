<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penghargaan;
use Illuminate\Support\Str;
use File;

class PenghargaanController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Penghargaan';
        $this->param['pageTitle'] = 'Penghargaan';
        $this->param['pageIcon'] = 'newspaper';
    }
    
    public function index(Request $request)
    {
        
        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('penghargaan.create');

        try {
            $keyword = $request->get('keyword');
            $getPenghargaan = Penghargaan::orderBy('judul', 'ASC');

            if ($keyword) {
                $getPenghargaan->where('judul', 'LIKE', "%$keyword%")->orWhere('konten', 'LIKE', "%$keyword%");
            }

            $this->param['data'] = $getPenghargaan->paginate(10);
        } catch (\Exception $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.penghargaan.index', $this->param);
    }

    public function create()
    {
        
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('penghargaan.index');

        return \view('backend.penghargaan.create', $this->param);
    }

    public function show($id)
    {
        try {
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('penghargaan.index');

            $this->param['konten'] = Penghargaan::find($id);
            
            return \view('backend.penghargaan.detail', $this->param);
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
                $folder = 'public/upload/penghargaan/';
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
                    $newPenghargaan = new Penghargaan;

                    $newPenghargaan->judul = $request->get('judul');
                    $newPenghargaan->slug = Str::slug($request->get('judul'));
                    $newPenghargaan->cover = $folder.'/'.$filename;
                    $newPenghargaan->konten = $request->get('konten');

                    $newPenghargaan->save();       
                }
            }

            return redirect()->route('penghargaan.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('penghargaan.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('penghargaan.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('promo.index');

            $this->param['konten'] = Penghargaan::find($id);
            
            return \view('backend.penghargaan.edit', $this->param);
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
        $penghargaan = Penghargaan::find($id);

        $isUnique = $penghargaan->judul == $request->get('judul') ? '' : '|unique:penghargaan,judul';

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
                // mengecek apakah file sebelumnya ada
                if($penghargaan->cover != null) {
                    if(file_exists($penghargaan->cover)) {
                        $folder = 'public/upload/penghargaan/';
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
                            if(File::delete($penghargaan->cover)) {
                                $penghargaan->cover = $folder.'/'.$filename;
                            }
                        }
                    }
                }
            }

            $penghargaan->judul = $request->get('judul');
            $penghargaan->slug = Str::slug($request->get('judul'));
            $penghargaan->konten = $request->get('konten');

            $penghargaan->save();   

            return redirect()->route('penghargaan.index')->withStatus('Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('penghargaan.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('penghargaan.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $penghargaan = Penghargaan::find($id);

            $cover = $penghargaan->cover;
            if($cover != null){
                if(file_exists($cover)){
                    if(File::delete($cover)){
                        $penghargaan->delete();
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
