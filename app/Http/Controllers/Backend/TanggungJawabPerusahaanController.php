<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TanggungJawabPerusahaan;
use File;

class TanggungJawabPerusahaanController extends Controller
{

    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Tanggung Jawab Perusahaan';
        $this->param['pageTitle'] = 'Tanggung Jawab Perusahaan';
        $this->param['pageIcon'] = 'book';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return view('backend.tanggung-jawab-perusahaan.index');
        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('tanggung-jawab-perusahaan.create');
        // $this->param['pageIcon'] = 'book';

        try {
            $keyword = $request->get('keyword');
            $getLaporan = TanggungJawabPerusahaan::select('tanggung_jawab_perusahaan.*', 'users.name')
                                        ->join('users', 'users.id', 'tanggung_jawab_perusahaan.user_id')
                                        ->orderBy('tahun', 'DESC');

            if ($keyword) {
                $getLaporan->where('tahun', 'LIKE', "%$keyword%");
            }

            $this->param['data'] = $getLaporan->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return view('backend.tanggung-jawab-perusahaan.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('tanggung-jawab-perusahaan.index');

        return view('backend.tanggung-jawab-perusahaan.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'tahun' => 'required',
                'title' => 'required',
                'cover' => 'required|file|max:2048|mimes:jpeg,jpg',
                'laporan' => 'required|file|max:10240|mimes:jpeg,jpg',
                'artikel' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah tersedia.',
                'mimes' => ':attribute hanya dapat menerima file jpeg atau jpg.',
                'file' => ':attribute harus berbentuk file.',
                'max' => 'Maksimal ukuran file hingga 10mb.'
            ],
            [
                'tahun' => 'Tahun',
                'title' => 'Title',
                'cover' => 'Cover',
                'laporan' => 'File Laporan Keuangan',
                'artikel' => 'Artikel'
            ]
        );

        try {
            if($request->file('laporan') != null) {
                $folder = 'upload/tanggung-jawab-perusahaan/';
                $file = $request->file('laporan');
                $filename = date('YmdHis').str_replace(' ', '_', $file->getClientOriginalName());
                // Get canonicalized absolute pathname
                $path = realpath($folder);

                // If it exist, check if it's a directory
                if(!($path !== true AND is_dir($path)))
                {
                    // Path/folder does not exist then create a new folder
                    mkdir($folder, 0755, true);
                }
                // if($file->move($folder, $filename)) {
                if(copy($file->getPathname(), $folder.$filename)) {
                    if($request->file('cover') != null) {
                        $folderC = 'upload/tanggung-jawab-perusahaan/';
                        $fileC = $request->file('cover');
                        $filenameC = date('YmdHis').str_replace(' ', '_', $fileC->getClientOriginalName());
                        // Get canonicalized absolute pathname
                        $pathC = realpath($folderC);

                        // If it exist, check if it's a directory
                        if(!($pathC !== true AND is_dir($pathC)))
                        {
                            // Path/folder does not exist then create a new folder
                            mkdir($folderC, 0755, true);
                        }
                        if($fileC->move($folderC, $filenameC)) {
                            $NewLaporanTj = new TanggungJawabPerusahaan();

                            $NewLaporanTj->tahun = $request->get('tahun');
                            $NewLaporanTj->title = $request->get('title');
                            $NewLaporanTj->file = $folder.$filename;
                            $NewLaporanTj->cover = $folderC.$filenameC;
                            $NewLaporanTj->user_id = auth()->user()->id;
                            $NewLaporanTj->artikel = $request->get('artikel');

                            $NewLaporanTj->save();

                            $status = 'success';
                            $message = 'successfully';
                        }
                    }
                }
            }

            return redirect()->route('tanggung-jawab-perusahaan.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
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
        //
        try {
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('tanggung-jawab-perusahaan.index');
            $this->param['laporan'] = TanggungJawabPerusahaan::find($id);

            return \view('backend.tanggung-jawab-perusahaan.edit', $this->param);
        }
        catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan');
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan');
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
        $laporan = TanggungJawabPerusahaan::find($id);

        $validCover = $request->file('cover') != null ? 'file|max:2048|mimes:jpeg,jpg' : '';
        $validFile = $request->file('laporan') != null ? 'file|max:10240|mimes:jpeg,jpg' : '';

        $validatedData = $request->validate(
            [
                'tahun' => 'required',
                'title' => 'required',
                'cover' => $validCover,
                'laporan' => $validFile,
                'artikel' => 'required'
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah tersedia.',
                'mimes' => ':attribute hanya dapat menerima file jpg.',
                'file' => ':attribute harus berbentuk file.',
                'max' => 'Maksimal ukuran file hingga 10mb.'
            ],
            [
                'tahun' => 'Tahun',
                'title' => 'Title',
                'cover' => 'Cover',
                'laporan' => 'File Laporan Keuangan',
                'artikel' => 'Artikel'
            ]
        );

        try {
            if($request->file('laporan') != null) {
                if($laporan->file != null) {
                    // mengecek apakah file sebelumnya ada atau tidak
                    if(file_exists($laporan->file)){
                        // Menghapus file sebelumnya
                        if(File::delete($laporan->file)) {
                            $folder = 'upload/tanggung-jawab-perusahaan/';
                            $file = $request->file('laporan');
                            $filename = date('YmdHis').str_replace(' ', '_', $file->getClientOriginalName());
                            // Get canonicalized absolute pathname
                            $path = realpath($folder);

                            // If it exist, check if it's a directory
                            if(!($path !== true AND is_dir($path)))
                            {
                                // Path/folder does not exist then create a new folder
                                mkdir($folder, 0755, true);
                            }
                            if($file->move($folder, $filename)) {
                                $laporan->file = $folder.$filename;
                            }
                        }
                    }
                }
                else {
                    $folder = 'upload/tanggung-jawab-perusahaan/';
                    $file = $request->file('laporan');
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
                        $laporan->file = $folder.$filename;
                    }
                }
                if($request->file('cover') != null) {
                    if($laporan->cover != null) {
                        // mengecek apakah file sebelumnya ada atau tidak
                        if(file_exists($laporan->cover)){
                            // Menghapus file sebelumnya
                            if(File::delete($laporan->cover)) {
                                $folderC = 'upload/tanggung-jawab-perusahaan/';
                                $fileC = $request->file('cover');
                                $filenameC = date('YmdHis').str_replace(' ', '_', $fileC->getClientOriginalName());
                                // Get canonicalized absolute pathname
                                $pathC = realpath($folderC);
    
                                // If it exist, check if it's a directory
                                if(!($pathC !== true AND is_dir($pathC)))
                                {
                                    // Path/folder does not exist then create a new folder
                                    mkdir($folderC, 0755, true);
                                }
                                if($fileC->move($folderC, $filenameC)) {
                                    $laporan->cover = $folderC.$filenameC;
                                }
                            }
                        }
                    }
                    else {
                        $folderC = 'upload/tanggung-jawab-perusahaan/';
                        $fileC = $request->file('cover');
                        $filenameC = date('YmdHis').$fileC->getClientOriginalName();
                        // Get canonicalized absolute pathname
                        $pathC = realpath($folderC);
    
                        // If it exist, check if it's a directory
                        if(!($pathC !== true AND is_dir($pathC)))
                        {
                            // Path/folder does not exist then create a new folder
                            mkdir($folderC, 0755, true);
                        }
                        if($fileC->move($folderC, $filenameC)) {
                            $laporan->cover = $folderC.$filenameC;
                        }
                    }
                }
            }

            $laporan->tahun = $request->get('tahun');
            $laporan->title = $request->get('title');
            $laporan->user_id = auth()->user()->id;
            $laporan->artikel = $request->get('artikel');

            $laporan->save();

            return redirect()->route('tanggung-jawab-perusahaan.index')->withStatus('Data berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $laporan = TanggungJawabPerusahaan::find($id);

            $cover = $laporan->cover;
            if($cover != null){
                if(file_exists($cover)){
                    File::delete($cover);
                }
            }

            $file = $laporan->file;
            if($file != null){
                if(file_exists($file)){
                    if(File::delete($file)){
                        $laporan->delete();
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
