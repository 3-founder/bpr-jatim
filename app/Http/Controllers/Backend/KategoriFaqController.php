<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriFaqController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Master Kategori FAQ';
        $this->param['pageTitle'] = 'Master Kategori FAQ';
        $this->param['pageIcon'] = 'Boxes';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('kategori-faq.create');

        $this->param['data'] = DB::table('kategori_faq')
            ->paginate(10);
        return view('backend.kategori_faq.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('kategori-faq.index');

        return view('backend.kategori_faq.add', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:kategori_faq,nama_kategori'
        ], [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute telah digunakan.'
        ], [
            'nama_kategori' => 'Nama jenis'
        ]);

        try{
            DB::table('kategori_faq')
                ->insert([
                    'nama_kategori' => $request->name,
                    'keterangan' => $request->keterangan,
                    'created_at' => now()
                ]);

            return redirect()->route('kategori-faq.index')->withStatus('Data berhasil ditambahkan.');
        } catch(Exception $e){
            DB::rollBack();
            return redirect()->route('kategori-faq.index')->withStatus('Data gagal ditambahkan. '.$e);
        } catch(QueryException $e){
            DB::rollBack();
            return redirect()->route('kategori-faq.index')->withStatus('Data gagal ditambahkan. '.$e);
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
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('kategori-faq.index');

        $this->param['data'] = DB::table('kategori_faq')
            ->where('id', $id)
            ->first();

        return view('backend.kategori_faq.edit', $this->param);
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
        $data = DB::table('kategori_faq')
            ->where('id', $id)
            ->first();

        $isUnique = $data->nama_kategori != $request->name ? '' : '|unique:kategori_faq,nama_kategori';
        $validate = $request->validate([
            'name' => 'required'.$isUnique
        ], [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute telah digunakan.'
        ], [
            'name' => 'Nama Kategori'
        ]);

        try{
            DB::table('kategori_faq')
                ->where('id', $id)
                ->update([
                    'nama_kategori' => $request->name,
                    'keterangan' => $request->keterangan,
                    'updated_at' => now()
                ]);
            
            return redirect()->route('kategori-faq.index')->withStatus('Data berhasil diperbarui.');
        } catch(Exception $e){
            DB::rollBack();
            return redirect()->route('kategori-faq.index')->withStatus('Data gagal diperbarui. '.$e);
        } catch(QueryException $e){
            DB::rollBack();
            return redirect()->route('kategori-faq.index')->withStatus('Data gagal diperbarui. '.$e);
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
        $data = DB::table('kategori_faq')
            ->where('id', $id)
            ->first();
        if(!$data){
            return redirect()->route('kategori-faq.index')->withStatus('Data tidak ditemukan.');
        }

        try{
            DB::table('kategori_faq')
                ->where('id', $id)
                ->delete();

            return redirect()->route('kategori-faq.index')->withStatus('Data berhasil dihapus.');
        } catch(Exception $e){
            DB::rollBack();
            return redirect()->route('kategori-faq.index')->withStatus('Data gagal dihapus. '.$e);
        } catch(QueryException $e){
            DB::rollBack();
            return redirect()->route('kategori-faq.index')->withStatus('Data gagal dihapus. '.$e);
        }
    }
}
