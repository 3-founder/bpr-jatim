<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tenor;
use Illuminate\Http\Request;

class TenorController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Master Tenor';
        $this->param['pageTitle'] = 'Master Tenor';
        $this->param['pageIcon'] = 'business-time';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah Tenor';
        $this->param['btnRight']['link'] = route('tenor.create');

        try {
            $keyword = $request->get('keyword');
            $getTenor = Tenor::orderBy('tenor', 'ASC');

            if ($keyword) {
                $getTenor->where('tenor', 'LIKE', "%$keyword%");
            }

            $this->param['tenor'] = $getTenor->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.tenor.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('tenor.index');

        return \view('backend.tenor.create', $this->param);
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
                'tenor' => 'required|unique:tenor,tenor',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah terdaftar'
            ],
            [
                'tenor' => 'Tenor',
            ]
        );
        try {
            $newTenor = new Tenor;

            $newTenor->tenor = $request->get('tenor');

            $newTenor->save();

            return redirect()->route('tenor.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('tenor.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('tenor.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
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
            $this->param['title'] = 'Edit Tenor';
            $this->param['pageTitle'] = 'Edit Tenor';
            $this->param['pageIcon'] = 'business-time';
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('tenor.index');
            $this->param['tenor'] = Tenor::find($id);

            return \view('backend.tenor.edit', $this->param);
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
        $tenor = Tenor::find($id);

        $isUnique = $tenor->tenor == $request->tenor ? '' : '|unique:tenor,tenor';
        $validatedData = $request->validate(
            [
                'tenor' => 'required'. $isUnique,
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'tenor' => 'Tenor',
            ]
        );
        try {
            $tenor->tenor = $request->get('tenor');
            
            $tenor->save();

            if($isUnique != '')
                return redirect()->route('tenor.index')->withStatus('Data berhasil diperbarui.');
            else
                return redirect()->route('tenor.index');

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
            $tenor = Tenor::findOrFail($id);

            $tenor->delete();

            return redirect()->route('tenor.index')->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('tenor.index')->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('tenor.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }
}
