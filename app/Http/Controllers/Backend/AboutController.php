<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\About;
use App\Http\Requests\AboutRequest;

class AboutController extends Controller
{
    private $param;
    private $menu;
    
    public function __construct()
    {
        $this->param['title'] = 'Tentang BPR';
        $this->param['pageTitle'] = 'Tentang BPR';
        $this->param['pageIcon'] = 'landmark';
    }
    
    public function index(Request $request)
    {
        $tipe = $request->get('t');
        $menu = 'Tentang BPR - ';
        if ($tipe == 'sejarah')
            $menu .= 'Sejarah';
        else if ($tipe == 'visi-misi')
            $menu .= 'Visi Misi';
        else if ($tipe == 'peranan')
            $menu .= 'Peranan';
        else if ($tipe == 'manajemen')
            $menu .= 'Manajemen';
        else if ($tipe == 'identitas')
            $menu .= 'Identitas Perusahaan';
        else if ($tipe == 'hukum')
            $menu = 'Transparansi - Hukum Perusahaan';
        else if ($tipe == 'komposisi')
            $menu = 'Transparansi - Komposisi Saham';
        else if ($tipe == 'tata_kelola')
            $menu = 'Transparansi - Tata Kelola Perusahaan';

        if ($this->hasPermission($menu)) {
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
        else
            return view('error_page.forbidden');
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
        $tipe = $request->tipe;
        $menu = 'Tentang BPR - ';
        if ($tipe == 'sejarah')
            $menu .= 'Sejarah';
        else if ($tipe == 'visi-misi')
            $menu .= 'Visi Misi';
        else if ($tipe == 'peranan')
            $menu .= 'Peranan';
        else if ($tipe == 'manajemen')
            $menu .= 'Manajemen';
        else if ($tipe == 'identitas')
            $menu .= 'Identitas Perusahaan';
        else if ($tipe == 'hukum')
            $menu = 'Transparansi - Hukum Perusahaan';
        else if ($tipe == 'komposisi')
            $menu = 'Transparansi - Komposisi Saham';
        else if ($tipe == 'tata_kelola')
            $menu = 'Transparansi - Tata Kelola Perusahaan';

        if ($this->hasPermission($menu)) {
            $attr = $request->all();
            $aboutById = About::findOrFail($id);
    
            $aboutById->update($attr);
    
            return back()->withStatus('updated Successfully!');
        }
        else
            return view('error_page.forbidden');
    }

    public function destroy($id)
    {
     //
    }
}
