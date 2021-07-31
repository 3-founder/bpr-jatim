<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Epaper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use File;

class EpaperController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Epaper';
        $this->param['pageTitle'] = 'Epaper';
        $this->param['pageIcon'] = 'newspaper';
    }
    
    public function index(Request $request)
    {
        
        $this->param['btnRight']['text'] = 'Tambah Epaper';
        $this->param['btnRight']['link'] = route('epaper.create');

        try {
            $keyword = $request->get('keyword');
            $getEpaper = Epaper::orderBy('judul', 'ASC');

            if ($keyword) {
                $getEpaper->where('judul', 'LIKE', "%$keyword%")->orWhere('konten', 'LIKE', "%$keyword%");
            }

            $this->param['data'] = $getEpaper->paginate(10);
        } catch (\Exception $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.epaper.index', $this->param);
    }

    public function create()
    {
        
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('epaper.index');

        return \view('backend.epaper.create', $this->param);
    }

    public function show($id)
    {
        try {
            $data = Epaper::find($id);
            $pdfUrl = asset('../'.$data->konten);
            // $pdfUrl = 
            // return response()->file(storage_path($pdfUrl));
            // return redirect($pdfUrl);
            // return view('backend.epaper.detail', $pdfUrl);
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML('<h1>Test</h1>');
            // return $pdf->stream();
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
            if($request->file('cover') != null || $request->file('konten') != null) {
                $folder = 'upload/epaper/';
                $file = $request->file('cover');
                $filePdf = $request->file('konten');
                $filename = date('YmdHis').$file->getClientOriginalName();
                $filenamePdf = date('YmdHis').$filePdf->getClientOriginalName();
                // Get canonicalized absolute pathname
                $path = realpath($folder);

                // If it exist, check if it's a directory
                if(!($path !== true AND is_dir($path)))
                {
                    // Path/folder does not exist then create a new folder
                    mkdir($folder, 0755, true);
                }
                if($file->move($folder, $filename) && $filePdf->move($folder, $filenamePdf)) {
                    $newEpaper = new Epaper;

                    $newEpaper->judul = $request->get('judul');
                    $newEpaper->slug = Str::slug($request->get('judul'));
                    $newEpaper->cover = $folder.$filename;
                    $newEpaper->konten = $folder.$filenamePdf;

                    $newEpaper->save();       
                }
            }

            return redirect()->route('epaper.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('epaper.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('epaper.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('epaper.index');

            $this->param['konten'] = Epaper::find($id);
            
            return \view('backend.epaper.edit', $this->param);
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
        $epaper = Epaper::find($id);

        $isUnique = $epaper->judul == $request->get('judul') ? '' : '|unique:epaper,judul';

        $validatedData = $request->validate(
            [
                'judul' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'judul' => 'Judul',
            ]
        );

        try {
            $folder = 'upload/epaper/';
            if($request->file('cover') != null) {
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
                    if(File::delete($epaper->cover)) {
                        $epaper->cover = $folder.$filename;
                    }
                }
            }

            if($request->file('konten') != null) {
                $filePdf = $request->file('konten');
                $filenamePdf = date('YmdHis').$filePdf->getClientOriginalName();
                // Get canonicalized absolute pathname
                $path = realpath($folder);

                // If it exist, check if it's a directory
                if(!($path !== true AND is_dir($path)))
                {
                    // Path/folder does not exist then create a new folder
                    mkdir($folder, 0755, true);
                }
                if(File::delete($epaper->konten)) {
                    if($filePdf->move($folder, $filenamePdf)) 
                    {
                        $epaper->konten = $folder.$filenamePdf;
                    }
                }
            }

            $epaper->judul = $request->get('judul');
            $epaper->slug = Str::slug($request->get('judul'));

            $epaper->save();   

            return redirect()->route('epaper.index')->withStatus('Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('epaper.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('epaper.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $epaper = Epaper::find($id);

            $cover = $epaper->cover;
            $pdf = $epaper->konten;
            if($cover != null && $pdf != null) {
                if(file_exists($cover) && file_exists($pdf)){
                    if(File::delete($cover) && File::delete($pdf)){
                        $epaper->delete();
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
