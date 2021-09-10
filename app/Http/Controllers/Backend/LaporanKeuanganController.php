<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanKeuangan;
use File;

class LaporanKeuanganController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Laporan Keuangan';
        $this->param['pageTitle'] = 'Laporan Keuangan';
        $this->param['pageIcon'] = 'book';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah Laporan Keuangan';
        $this->param['btnRight']['link'] = route('laporan-keuangan.create');

        try {
            $keyword = $request->get('keyword');
            $getLaporan = LaporanKeuangan::select('lap_keuangan.*', 'users.name')
                                        ->join('users', 'users.id', 'lap_keuangan.user_id')
                                        ->orderBy('tahun', 'DESC');

            if ($keyword) {
                $getLaporan->where('tahun', 'LIKE', "%$keyword%");
            }

            $this->param['data'] = $getLaporan->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.lap-keuangan.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('laporan-keuangan.index');

        return \view('backend.lap-keuangan.create', $this->param);
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
                'tahun' => 'required|unique:lap_keuangan,tahun',
                'laporan' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah tersedia.',
            ],
            [
                'tahun' => 'Tahun',
                'laporan' => 'File Laporan Keuangan'
            ]
        );

        try {
            if($request->file('laporan') != null) {
                $folder = 'upload/laporan-keuangan/';
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
                    $newLaporan = new LaporanKeuangan;

                    $newLaporan->tahun = $request->get('tahun');
                    $newLaporan->file = $folder.$filename;
                    $newLaporan->user_id = auth()->user()->id;

                    $newLaporan->save();       
                }
            }

            return redirect()->route('laporan-keuangan.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('laporan-keuangan.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('laporan-keuangan.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
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
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('laporan-keuangan.index');
            $this->param['laporan'] = LaporanKeuangan::find($id);
            
            return \view('backend.lap-keuangan.edit', $this->param);
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
        $laporan = LaporanKeuangan::find($id);
        $isUnique = $laporan->tahun == $request->get('tahun') ? '' : '|unique:lap_keuangan,tahun';

        $validatedData = $request->validate(
            [
                'tahun' => 'required'.$isUnique,
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah tersedia.',
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
                            $folder = 'upload/berita/';
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
                }
                else {
                    $folder = 'upload/berita/';
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

            return redirect()->route('laporan-keuangan.index')->withStatus('Data berhasil disimpan.');
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
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
            $laporan = LaporanKeuangan::find($id);

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
