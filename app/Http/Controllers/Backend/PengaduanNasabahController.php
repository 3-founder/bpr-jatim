<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PengaduanNasabah;
use Illuminate\Http\Request;

class PengaduanNasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['title'] = 'Berita & Info';
        $this->param['pageTitle'] = 'Berita & Info';
        $this->param['pageIcon'] = 'landmark';

        try {
            $keyword = $request->get('keyword');
            $data = PengaduanNasabah::select(
                'pengaduan_nasabah.id',
                'pengaduan_nasabah.nama',
                'pengaduan_nasabah.jenis_kelamin',
                'pengaduan_nasabah.alamat',
                'pengaduan_nasabah.nomor_identitas',
                'kota.nama_kota'
            )
            ->join('kota', 'kota.id', 'pengaduan_nasabah.id_kota')
            ->orderBy('nama', 'ASC');

            if ($keyword) {
                $data->where('pengaduan_nasabah.nama', 'LIKE', "%$keyword%")
                    ->orWhere('pengaduan_nasabah.jenis_kelamin', 'LIKE', "%$keyword%")
                    ->orWhere('pengaduan_nasabah.alamat', 'LIKE', "%$keyword%")
                    ->orWhere('pengaduan_nasabah.nomor_identitas', 'LIKE', "%$keyword%")
                    ->orWhere('kota.nama_kota', 'LIKE', "%$keyword%");
            }

            $this->param['data'] = $data->paginate(10);

            return view('backend.berita-info.pengaduan-nasabah.list-pengaduan', $this->param);
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch(\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
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
        $this->param['title'] = 'Berita & Info';
        $this->param['pageTitle'] = 'Berita & Info';
        $this->param['pageIcon'] = 'landmark';
        $this->param['btnRight']['text'] = 'Kembali';
        $this->param['btnRight']['link'] = route('pengaduan-nasabah');

        try {
            $this->param['data'] = PengaduanNasabah::select(
                'pengaduan_nasabah.*',
                'kota.nama_kota'
            )
            ->join('kota', 'kota.id', 'pengaduan_nasabah.id_kota')
            ->where('pengaduan_nasabah.id', $id)
            ->first();

            return view('backend.berita-info.pengaduan-nasabah.detail-pengaduan', $this->param);
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch(\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
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
