<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Master Cabang';
        $this->param['pageTitle'] = 'Master Cabang';
        $this->param['pageIcon'] = 'city';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah Cabang';
        $this->param['btnRight']['link'] = route('kota.create');

        try {
            $keyword = $request->get('keyword');
            $getKota = Kota::orderBy('nama_kota', 'ASC');

            if ($keyword) {
                $getKota->where('nama_kota', 'LIKE', "%$keyword%");
            }

            $this->param['kota'] = $getKota->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.kota.list-kota', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('kota.index');

        return \view('backend.kota.tambah-kota', $this->param);
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
                'name' => 'required|unique:kota,nama_kota',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah terdaftar'
            ],
            [
                'name' => 'Nama Kota',
            ]
        );
        try {
            $newCity = new Kota;

            $newCity->nama_kota = $request->get('name');
            $newCity->alamat = $request->get('alamat');
            $newCity->telp = $request->get('telp');

            $newCity->save();

            return redirect()->route('kota.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('kota.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kota.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
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
            $this->param['title'] = 'Edit Cabang';
            $this->param['pageTitle'] = 'Edit Cabang';
            $this->param['pageIcon'] = 'boxes';
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('kota.index');
            $this->param['kota'] = Kota::find($id);

            return \view('backend.kota.edit-kota', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
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
        $kota = Kota::find($id);

        $isUnique = $kota->nama_kota == $request->name ? '' : '|unique:kota,nama_kota';
        $validatedData = $request->validate(
            [
                'name' => 'required'. $isUnique,
            ],
            [
                'name.required' => ':attribute tidak boleh kosong.',
            ],
            [
                'name' => 'Nama kota',
            ]
        );
        try {
            $kota->nama_kota = $request->get('name');
            
            $kota->save();

            if($isUnique != '')
                return redirect()->route('kota.index')->withStatus('Data berhasil diperbarui.');
            else
                return redirect()->route('kota.index');

        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
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
        try {
            $kota = Kota::findOrFail($id);

            $kota->delete();

            return redirect()->route('kota.index')->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kota.index')->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kota.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }
}
