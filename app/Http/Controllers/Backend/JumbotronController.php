<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\JumbotronRequest;
use App\Models\Jumbotron;
use App\Repository\JumbotronRepository;
use Illuminate\Http\Request;

class JumbotronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.jumbotron.index', [
            'pageIcon' => 'image',
            'pageTitle' => 'Jumbotron',
            'jumbotrons' => Jumbotron::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.jumbotron.create', [
            'pageIcon' => 'image',
            'pageTitle' => 'Tambah Jumbotron',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JumbotronRequest $request)
    {
        JumbotronRepository::add($request->image);

        return redirect()
            ->route('jumbotrons.index')
            ->with('swals', 'Berhasil menambahkan jumbotron');
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
        Jumbotron::find($id)?->delete();

        return redirect()
            ->route('jumbotrons.index')
            ->with('swals', 'Berhasil menghapus jumbotron');
    }
}
