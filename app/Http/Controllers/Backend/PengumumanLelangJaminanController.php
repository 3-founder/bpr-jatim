<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PengumumanLelangJaminan;
use Illuminate\Http\Request;

class PengumumanLelangJaminanController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Pengumuman Lelang Jaminan';
        $this->param['pageTitle'] = 'Pengumuman Lelang Jaminan';
        $this->param['pageIcon'] = 'info';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->param['data'] = PengumumanLelangJaminan::first();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('pengumuman-lelang-jaminan.index')->withError('Terjadi Kesalahan');
        }

        return \view('backend.pengumuman-lelang-jaminan.index', $this->param);
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
        $this->validate($request, [
            'judul' => 'required',
            'konten' => 'required'
        ], [
            'required' => ':attribute tidak boleh kosong.'
        ], [
            'judul' => 'Judul',
            'konten' => 'Konten'
        ]);

        try {
            $newData = PengumumanLelangJaminan::findOrFail($id);
            $newData->judul = $request->get('judul');
            $newData->konten = $request->get('konten');
            $newData->save();

            return back()->withStatus('updated Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('pengumuman-lelang-jaminan.index')->withError('Terjadi Kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('pengumuman-lelang-jaminan.index')->withError('Terjadi Kesalahan');
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
        //
    }
}
