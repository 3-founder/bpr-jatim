<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanKreditController extends Controller
{
    private $param;
    private $menu;

    public function __construct()
    {
        $this->param['title'] = 'Pengajuan Kredit';
        $this->param['pageTitle'] = 'Pengajuan Kredit';
        $this->param['pageIcon'] = 'list-alt';
        $this->menu = 'List Pengajuan Kredit';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->hasPermission($this->menu)){
            $this->param['data'] = DB::table('pengajuan_kredit')
                ->select('pengajuan_kredit.*','kota.nama_kota')
                ->join('kota', 'kota.id', 'pengajuan_kredit.kota')
                ->orderByDesc('pengajuan_kredit.created_at')
                ->paginate(10);
    
            return view('backend.pengajuan_kredit.index', $this->param);
        } else return view('error_page.forbidden');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->hasPermission($this->menu)){
            $this->param['btnRight']['text'] = ' Lihat Data';
            $this->param['btnRight']['link'] = route('pengajuan-kredit.index');
            $this->param['btnTindakLanjut']['text'] = 'Tindak Lanjut';
            $this->param['btnTindakLanjut']['link'] = route('pengajuan-kredit.destroy', $id);
            $this->param['data'] = DB::table('pengajuan_kredit')
                ->where('pengajuan_kredit.id', $id)
                ->join('kota', 'kota.id', 'pengajuan_kredit.kota')
                ->select('pengajuan_kredit.*', 'kota.nama_kota')
                ->first();
    
            if($this->param['data'] == null){
                return redirect()->route('pengajuan-kredit.index')->withStatus('Data tidak dapat ditemukan.');
            }
    
            return view('backend.pengajuan_kredit.detail', $this->param);
        } else return view('error_page.forbidden');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->hasPermission($this->menu)){
            $data = DB::table('pengajuan_kredit')
                ->where('id', $id)
                ->first();
            if($data == null){
                return redirect()->route('pengajuan-kredit.index')->withStatus('Data tidak ditemukan.');
            }
    
            try{
                DB::table('pengajuan_kredit')
                    ->where('id', $id)
                    ->update([
                        'status' => '1'
                    ]);
    
                return redirect()->route('pengajuan-kredit.index')->withStatus('Data berhasil ditindak lanjuti.');
            } catch(Exception $e){
                DB::rollBack();
                return redirect()->route('pengajuan-kredit.index')->withStatus('Data gagal ditindak lanjuti. '.$e);
            } catch(QueryException $e){
                DB::rollBack();
                return redirect()->route('pengajuan-kredit.index')->withStatus('Data gagal ditindak lanjuti. '.$e);
            }
        } else return view('error_page.forbidden');
    }
}
