<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\JaringanKantor;
use \App\Models\Kota;

class JaringanKantorController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Jaringan Kantor Kas';
        $this->param['pageTitle'] = 'Jaringan Kantor Kas';
        $this->param['pageIcon'] = 'code-branch';
    }
    
    public function index(Request $request)
    {
        
        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('jaringan-kantor.create');

        try {
            $keyword = $request->get('keyword');
            $getKantor = JaringanKantor::orderBy('id_kota', 'ASC')->orderBy('id', 'ASC');

            if ($keyword) {
                $getKantor->where('jaringan_kantor', 'LIKE', "%$keyword%");
            }

            $this->param['jaringanKantor'] = $getKantor->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.jaringan-kantor.list-jaringan-kantor', $this->param);
    }

    public function create()
    {
        
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('jaringan-kantor.index');
        $this->param['cabang'] = Kota::get();

        return \view('backend.jaringan-kantor.tambah-jaringan-kantor', $this->param);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'id_kota' => 'required',
                'jaringan_kantor' => 'required',
                'jenis' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'id_kota' => 'Cabang',
                'jaringan_kantor' => 'Jaringan Kantor Kas',
                'jenis' => 'Jenis',
            ]
        );
        try {
            $newJaringanKantor = new JaringanKantor;

            $newJaringanKantor->id_kota = $request->get('id_kota');
            $newJaringanKantor->jaringan_kantor = $request->get('jaringan_kantor');
            $newJaringanKantor->jenis = $request->get('jenis');
            $newJaringanKantor->alamat = $request->get('alamat');
            $newJaringanKantor->kode_area = $request->get('kode_area');
            $newJaringanKantor->telepon = $request->get('telepon');
            $newJaringanKantor->fax = $request->get('fax');

            $newJaringanKantor->save();

            return redirect()->route('jaringan-kantor.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('jaringan-kantor.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('jaringan-kantor.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('jaringan-kantor.index');
            $this->param['cabang'] = Kota::get();
            $this->param['jaringanKantor'] = JaringanKantor::find($id);

            return \view('backend.jaringan-kantor.edit-jaringan-kantor', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate(
            [
                'id_kota' => 'required',
                'jaringan_kantor' => 'required',
                'jenis' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'id_kota' => 'Cabang',
                'jaringan_kantor' => 'Jaringan Kantor Kas',
                'jenis' => 'Jenis',
            ]
        );
        try {
            $jaringanKantor = JaringanKantor::find($id);
            $jaringanKantor->id_kota = $request->get('id_kota');
            $jaringanKantor->jaringan_kantor = $request->get('jaringan_kantor');
            $jaringanKantor->jenis = $request->get('jenis');
            $jaringanKantor->alamat = $request->get('alamat');
            $jaringanKantor->kode_area = $request->get('kode_area');
            $jaringanKantor->telepon = $request->get('telepon');
            $jaringanKantor->fax = $request->get('fax');
            $jaringanKantor->save();

            return redirect()->route('jaringan-kantor.index')->withStatus('Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = JaringanKantor::findOrFail($id);

            $user->delete();

            return redirect()->route('jaringan-kantor.index')->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jaringan-kantor.index')->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('jaringan-kantor.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }
}
