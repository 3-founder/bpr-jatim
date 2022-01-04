<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JenisProdukLayanan;
use Illuminate\Http\Request;

class JenisProdukLayananController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Master Jenis Produk & Layanan';
        $this->param['pageTitle'] = 'Master Jenis Produk & Layanan';
        $this->param['pageIcon'] = 'boxes';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('jenis-produk-layanan.create');

        try {
            $keyword = $request->get('keyword');
            $getJenis = JenisProdukLayanan::orderBy('nama_jenis', 'ASC');

            if ($keyword) {
                $getJenis->where('nama_jenis', 'LIKE', "%$keyword%");
            }

            $this->param['jenis'] = $getJenis->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.jenis-produk-layanan.list-jenis-produk-layanan', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('jenis-produk-layanan.index');

        return \view('backend.jenis-produk-layanan.tambah-jenis-produk-layanan', $this->param);
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
                'name' => 'required|unique:jenis_produk_layanan,nama_jenis',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah terdaftar'
            ],
            [
                'name' => 'Nama Jenis',
            ]
        );
        try {
            $newJenis = new JenisProdukLayanan;

            $newJenis->nama_jenis = $request->get('name');
            $newJenis->keterangan = $request->get('keterangan');

            $newJenis->save();

            return redirect()->route('jenis-produk-layanan.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('jenis-produk-layanan.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('jenis-produk-layanan.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
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
            $this->param['title'] = 'Edit Jenis Produk & Layanan';
            $this->param['pageTitle'] = 'Edit Jenis Produk & Layanan';
            $this->param['pageIcon'] = 'boxes';
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('jenis-produk-layanan.index');
            $this->param['jenis'] = JenisProdukLayanan::find($id);

            return \view('backend.jenis-produk-layanan.edit-jenis-produk-layanan', $this->param);
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
        $jenis = JenisProdukLayanan::find($id);

        $isUnique = $jenis->nama_jenis == $request->name ? '' : '|unique:jenis_produk_layanan,nama_jenis';
        $validatedData = $request->validate(
            [
                'name' => 'required'. $isUnique,
            ],
            [
                'name.required' => ':attribute tidak boleh kosong.',
            ],
            [
                'name' => 'Nama Jenis',
            ]
        );
        try {
            $jenis->nama_jenis = $request->get('name');
            $jenis->keterangan = $request->get('keterangan');
            
            $jenis->save();

            if($isUnique != '')
                return redirect()->route('jenis-produk-layanan.index')->withStatus('Data berhasil diperbarui.');
            else
                return redirect()->route('jenis-produk-layanan.index');

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
            $jenis = JenisProdukLayanan::findOrFail($id);

            $jenis->delete();

            return redirect()->route('jenis-produk-layanan.index')->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jenis-produk-layanan.index')->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('jenis-produk-layanan.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }
}
