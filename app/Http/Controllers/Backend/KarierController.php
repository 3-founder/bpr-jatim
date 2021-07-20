<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Karier;
use Illuminate\Http\Request;

class KarierController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Karier';
        $this->param['pageTitle'] = 'Karier';
        $this->param['pageIcon'] = 'walking';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->param['data'] = Karier::first();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('karier.index')->withError('Terjadi Kesalahan');
        }

        return \view('backend.karier.index', $this->param);
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
            $karierUpdate = Karier::findOrFail($id);
            $karierUpdate->judul = $request->get('judul');
            $karierUpdate->konten = $request->get('konten');
            $karierUpdate->save();

            return back()->withStatus('updated Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('karier.index')->withError('Terjadi Kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('karier.index')->withError('Terjadi Kesalahan');
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
