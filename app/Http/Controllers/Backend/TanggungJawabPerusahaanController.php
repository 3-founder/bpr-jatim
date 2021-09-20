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
        $this->param['btnRight']['text'] = 'Tambah Tanggung Jawab Perusahaan';
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
                'tahun' => 'required|unique:tanggung_jawab_perusahaan,tahun',
                'laporan' => 'required|file|max:10240|mimes:pdf',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah tersedia.',
                'mimes' => ':attribute hanya dapat menerima file pdf.',
                'file' => ':attribute harus berbentuk file.',
                'max' => 'Maksimal ukuran file hingga 10mb.'
            ],
            [
                'tahun' => 'Tahun',
                'laporan' => 'File Laporan Keuangan'
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
                if($file->move($folder, $filename)) {
                    $NewLaporanTj = new TanggungJawabPerusahaan();

                    $NewLaporanTj->tahun = $request->get('tahun');
                    $NewLaporanTj->file = $folder.$filename;
                    $NewLaporanTj->user_id = auth()->user()->id;

                    $NewLaporanTj->save();

                    $status = 'success';
                    $message = 'successfully';
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
        $isUnique = $laporan->tahun == $request->get('tahun') ? '' : '|unique:lap_keuangan,tahun';
        $validFile = $request->file('laporan') != null ? 'file|max:10240|mimes:pdf' : '';

        $validatedData = $request->validate(
            [
                'tahun' => 'required'.$isUnique,
                'laporan' => $validFile
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah tersedia.',
                'mimes' => ':attribute hanya dapat menerima file pdf.',
                'file' => ':attribute harus berbentuk file.',
                'max' => 'Maksimal ukuran file hingga 10mb.'
            ],
            [
                'tahun' => 'Tahun',
                'laporan' => 'File Laporan Keuangan',
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
            }

            $laporan->tahun = $request->get('tahun');
            $laporan->user_id = auth()->user()->id;

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
