<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\About;
use App\Http\Requests\AboutRequest;

class AboutController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Tentang BPR';
        $this->param['pageTitle'] = 'Tentang BPR';
        $this->param['pageIcon'] = 'landmark';
    }
    
    public function index(Request $request)
    {
        $tipe = $request->get('t');
        try {
            if (!$tipe) {
                return redirect()->route('about.index')->withError('Terjadi Kesalahan');
            }
            $this->param['about'] = About::where('tipe', $tipe)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('about.index')->withError('Terjadi Kesalahan');
        }

        return \view('backend.about.list-about', $this->param);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       //
    }

    public function edit($id)
    {
        //
    }

    public function update(AboutRequest $request, $id)
    {
        $attr = $request->all();
        $aboutById = About::findOrFail($id);

        $aboutById->update($attr);

        return back()->withStatus('updated Successfully!');
        
    }

    public function destroy($id)
    {
     //
    }
}
