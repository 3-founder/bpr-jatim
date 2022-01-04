<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kurs;
use Illuminate\Http\Request;

class KursController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Master Kurs';
        $this->param['pageTitle'] = 'Master Kurs';
        $this->param['pageIcon'] = 'dollar-sign';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('kurs.create');

        try {
            $keyword = $request->get('keyword');

            $getKurs = \DB::table('kurs AS k1')
                            ->select('k1.*')
                            ->leftJoin('kurs AS k2', function($join){
                                $join->on('k1.nama', '=', 'k2.nama');
                                $join->on('k1.id', '<', 'k2.id');
                            })
                            ->whereNull('k2.id');
                            
            if ($keyword) {
                $getKurs->where('k1.nama', 'LIKE', "%$keyword%");
                // $getKurs = \DB::select(\DB::raw('SELECT k1.* FROM kurs k1 LEFT JOIN kurs k2 ON (k1.nama = k2.nama AND k1.id < k2.id) WHERE k2.id IS NULL AND k1.nama LIKE "%$keyword%"'));
            }

            $this->param['kurs'] = $getKurs->orderBy('k1.nama', 'ASC')->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.kurs.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('kurs.index');

        return \view('backend.kurs.create', $this->param);
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
                'name' => 'required',
                'harga_beli' => 'required',
                'harga_jual' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'name' => 'Mata Uang',
                'harga_beli' => 'Harga Beli',
                'harga_jual' => 'Harga Jual'
            ]
        );
        try {
            $currentKurs = Kurs::where('nama', strtoupper($request->get('name')))->orderBy('id', 'DESC')->get();

            if(count($currentKurs) > 0) {
                // terdapat kurs sebelumnya
                $new_kurs_beli = $request->get('harga_beli');
                $new_kurs_jual = $request->get('harga_jual');
                $temp_kurs_beli = $currentKurs[0]->harga_beli;
                $temp_kurs_jual = $currentKurs[0]->harga_jual;
            }
            else {
                // kurs belum tersedia
                $new_kurs_beli = $request->get('harga_beli');
                $new_kurs_jual = $request->get('harga_jual');
                $temp_kurs_beli = $request->get('harga_beli');
                $temp_kurs_jual = $request->get('harga_jual');
            }
            $newKurs = new Kurs;

            $newKurs->nama = $request->get('name');
            $newKurs->harga_beli = $new_kurs_beli;
            $newKurs->temp_harga_beli = $temp_kurs_beli;
            $newKurs->harga_jual = $new_kurs_jual;
            $newKurs->temp_harga_jual = $temp_kurs_jual;

            $newKurs->save();

            return redirect()->route('kurs.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('kurs.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kurs.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
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
            $this->param['title'] = 'Edit Kurs';
            $this->param['pageTitle'] = 'Edit Kurs';
            $this->param['pageIcon'] = 'boxes';
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('kurs.index');
            $this->param['kurs'] = Kurs::find($id);

            return \view('backend.kurs.edit', $this->param);
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
        $kurs = Kurs::find($id);

        // $isUnique = $kurs->nama == $request->name ? '' : '|unique:kurs,nama';
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'harga_beli' => 'required',
                'harga_jual' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'name' => 'Mata Uang',
                'harga_beli' => 'Harga Beli',
                'harga_jual' => 'Harga Jual'
            ]
        );
        try {
            $kurs->nama = $request->get('name');
            $kurs->harga_beli = $request->get('harga_beli');
            $kurs->harga_jual = $request->get('harga_jual');

            // if($kurs->harga_beli != $request->get('harga_beli')) {
            //     $kurs->temp_harga_beli = $kurs->harga_beli;
            //     $kurs->harga_beli = $request->get('harga_beli');
            //     if($request->get('harga_beli') > $kurs->temp_harga_beli) {
            //         $kurs->ket_beli = 'naik';
            //     }
            //     else if($request->get('harga_beli') < $kurs->temp_harga_beli) {
            //         $kurs->ket_beli = 'turun';
            //     }
            //     else {
            //         $kurs->ket_beli = 'tetap';
            //     }
            // }
            // if($kurs->harga_jual != $request->get('harga_jual')) {
            //     $kurs->temp_harga_jual = $kurs->harga_jual;
            //     $kurs->harga_jual = $request->get('harga_jual');
            //     if($request->get('harga_jual') > $kurs->temp_harga_jual) {
            //         $kurs->ket_jual = 'naik';
            //     }
            //     else if($request->get('harga_jual') < $kurs->temp_harga_jual) {
            //         $kurs->ket_jual = 'turun';
            //     }
            //     else {
            //         $kurs->ket_jual = 'tetap';
            //     }
            // }
            
            $kurs->save();

            return redirect()->route('kurs.index')->withStatus('Data berhasil diperbarui.');
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
            $kurs = Kurs::findOrFail($id);

            $kurs->delete();

            return redirect()->route('kurs.index')->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kurs.index')->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kurs.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }
}
