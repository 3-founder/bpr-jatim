<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ItemProdukLayanan;
use App\Models\JenisProdukLayanan;
use Illuminate\Http\Request;

class ItemProdukLayananController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Master Jenis Produk & Layanan';
        $this->param['pageTitle'] = 'Master Jenis Produk & Layanan';
        $this->param['pageIcon'] = 'store';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah Konten';
        $this->param['btnRight']['link'] = route('item-produk-layanan.create');

        try {
            $keyword = $request->get('keyword');
            $getKonten = ItemProdukLayanan::select('item_produk_layanan.*', 'jenis_produk_layanan.nama_jenis')
                                        ->join('jenis_produk_layanan', 'jenis_produk_layanan.id', 'item_produk_layanan.id_jenis')
                                        ->orderBy('judul', 'ASC');

            if ($keyword) {
                $getKonten->where('item_produk_layanan.judul', 'LIKE', "%$keyword%")->orWhere('jenis_produk_layanan.nama_jenis', 'LIKE', "%$keyword%");
            }

            $this->param['konten'] = $getKonten->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.item-produk-layanan.list-item-produk-layanan', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('item-produk-layanan.index');
        $this->param['jenis'] = JenisProdukLayanan::orderBy('nama_jenis', 'ASC')->get();

        return \view('backend.item-produk-layanan.tambah-item-produk-layanan', $this->param);
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
        //
    }
}
