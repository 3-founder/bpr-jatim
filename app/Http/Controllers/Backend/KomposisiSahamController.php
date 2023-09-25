<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KomposisiSahamModel;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KomposisiSahamController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Komposisi Saham';
        $this->param['pageTitle'] = 'Komposisi Saham';
        $this->param['pageIcon'] = 'landmark';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('komposisi-saham.create');
        $this->param['data'] = DB::table('komposisi_saham')
            ->when($keyword, function($q, $keyword){
                return $q->where('pemilik_saham', 'like', '%' . $keyword . '%');
            })
            ->paginate(10);

        return view('backend.komposisi_saham.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('komposisi-saham.index');
        $this->param['dataJenis'] = ['pemprov', 'kota/kab', 'dpd'];

        return view('backend.komposisi_saham.add', $this->param);
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
            'pemilik_saham' => 'required',
            'jenis' => 'required',
            'lembar' => 'required',
            'nominal' => 'required',
        ], [
            'required' => ':attribute harus diisi.'
        ], [
            'pemilik_saham' => 'Pemilik saham',
            'jenis' => 'Jenis',
            'lembar' => 'Lembar',
            'nominal' => 'Nominal',
        ]);

        DB::beginTransaction();
        try{
            KomposisiSahamModel::insert([
                    'pemilik_saham' => $request->pemilik_saham,
                    'jenis' => $request->jenis,
                    'lembar' => str_replace('.', '', $request->lembar),
                    'nominal' => str_replace('.', '', $request->nominal),
                    'created_at' => now(),
                ]);
            DB::commit();

            return redirect()->route('komposisi-saham.index')->withStatus('Berhasil menambahkan komposisi saham.');
        } catch(Exception $e){
            DB::rollBack();
            return redirect()->route('komposisi-saham.index')->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch(QueryException $e){
            DB::rollBack();
            return redirect()->route('komposisi-saham.index')->withError('Terjadi kesalahan. ' . $e->getMessage());
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
        $this->param['btnRight']['link'] = route('komposisi-saham.index');
        $this->param['dataJenis'] = ['pemprov', 'kota/kab', 'dpd'];
        $this->param['data'] = KomposisiSahamModel::find($id);

        return view('backend.komposisi_saham.edit', $this->param);
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
        $validate = $request->validate([
            'pemilik_saham' => 'required',
            'jenis' => 'required',
            'lembar' => 'required',
            'nominal' => 'required',
        ], [
            'required' => ':attribute harus diisi.'
        ], [
            'pemilik_saham' => 'Pemilik saham',
            'jenis' => 'Jenis',
            'lembar' => 'Lembar',
            'nominal' => 'Nominal',
        ]);

        DB::beginTransaction();
        try{
            $komposisiSaham = KomposisiSahamModel::find($id);
            $komposisiSaham->pemilik_saham = $request->pemilik_saham;
            $komposisiSaham->jenis = $request->jenis;
            $komposisiSaham->lembar = str_replace('.', '', $request->lembar);
            $komposisiSaham->nominal = str_replace('.', '', $request->nominal);
            $komposisiSaham->updated_at = now();
            $komposisiSaham->save();

            DB::commit();
            return redirect()->route('komposisi-saham.index')->withStatus('Berhasil mengubah komposisi saham.');
        } catch(Exception $e){
            DB::rollBack();
            dd($e);
            return redirect()->route('komposisi-saham.index')->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch(QueryException $e){
            DB::rollBack();
            dd($e);
            return redirect()->route('komposisi-saham.index')->withError('Terjadi kesalahan. ' . $e->getMessage());
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
        DB::beginTransaction();
        try{
            $data = KomposisiSahamModel::find($id);
            $data->delete();

            DB::commit();
            return redirect()->back()->withStatus('Berhasil menghapus data.');
        } catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch(QueryException $e){
            DB::rollBack();
            return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }
}
