<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Promo';
        $this->param['pageTitle'] = 'Promo';
        $this->param['pageIcon'] = 'newspaper';
    }
    
    public function index(Request $request)
    {
        
        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('promo.create');

        try {
            $keyword = $request->get('keyword');
            $getPromo = Promo::orderBy('judul', 'ASC');

            if ($keyword) {
                $getPromo->where('judul', 'LIKE', "%$keyword%")->orWhere('konten', 'LIKE', "%$keyword%");
            }

            $this->param['data'] = $getPromo->paginate(10);
        } catch (\Exception $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.promo.index', $this->param);
    }

    public function create()
    {
        
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('promo.index');

        return \view('backend.promo.create', $this->param);
    }

    public function show($id)
    {
        try {
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('promo.index');

            $this->param['konten'] = Promo::find($id);
            
            return \view('backend.promo.detail', $this->param);
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
                $folder = 'public/upload/promo/';
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
                    $newPromo = new Promo;

                    $newPromo->judul = $request->get('judul');
                    $newPromo->slug = Str::slug($request->get('judul'));
                    $newPromo->cover = $folder.'/'.$filename;
                    $newPromo->konten = $request->get('konten');

                    $newPromo->save();       
                }
            }

            return redirect()->route('promo.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('promo.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('promo.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('promo.index');

            $this->param['konten'] = Promo::find($id);
            
            return \view('backend.promo.edit', $this->param);
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
        $promo = Promo::find($id);

        $isUnique = $promo->judul == $request->get('judul') ? '' : '|unique:promo,judul';

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
                $folder = 'public/upload/promo/';
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
                    $promo->cover = $folder.'/'.$filename;
                }
            }

            $promo->judul = $request->get('judul');
            $promo->slug = Str::slug($request->get('judul'));
            $promo->konten = $request->get('konten');

            $promo->save();   

            return redirect()->route('promo.index')->withStatus('Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('promo.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('promo.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $promo = Promo::find($id);

            $cover = $promo->cover;
            if($cover != null){
                if(file_exists($cover)){
                    if(File::delete($cover)){
                        $promo->delete();
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
