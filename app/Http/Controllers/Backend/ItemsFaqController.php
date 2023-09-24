<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\CKEditorRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsFaqController extends Controller
{
    private $param;
    private $menu;

    public function __construct()
    {
        $this->param['title'] = 'Pertanyaan FAQ';
        $this->param['pageTitle'] = 'Pertanyaan FAQ';
        $this->param['pageIcon'] = 'list-alt';
        $this->menu = 'Item FAQ';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->hasPermission($this->menu)){
            $this->param['btnRight']['text'] = 'Tambah';
            $this->param['btnRight']['link'] = route('items-faq.create');
            $this->param['data'] = DB::table('items_faq')
                ->join('kategori_faq', 'items_faq.id_kategori', 'kategori_faq.id')
                ->select('kategori_faq.nama_kategori', 'items_faq.pertanyaan', 'items_faq.jawaban', 'items_faq.id')
                ->paginate(10);
    
            return view('backend.items_faq.index', $this->param);
        } else return view('error_page.forbidden');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if($this->hasPermission($this->menu)){
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('items-faq.index');
            $this->param['data'] = DB::table('kategori_faq')
                ->get();
    
            return view('backend.items_faq.add', $this->param);
        } else return view('error_page.forbidden');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->hasPermission($this->menu)){
            $validate = $request->validate([
                'id_kategori' => 'required',
                'pertanyaan' => 'required|unique:items_faq,pertanyaan',
                'jawaban' => 'required'
            ], [
                'required' => ':attribute harus diisi.',
                'unique' => ':attribute telah digunakan.'
            ], [
                'id_kategori' => 'Kategori',
                'pertanyaan' => 'Pertanyaan',
                'jawaban' => 'Jawaban'
            ]);
    
            try {
                DB::table('items_faq')
                    ->insert([
                        'id_kategori' => $request->id_kategori,
                        'pertanyaan' => $request->pertanyaan,
                        'jawaban' => $request->jawaban,
                        'keterangan' => 'FAQ',
                        'created_at' => now()
                    ]);
    
                return redirect()->route('items-faq.index')->withStatus('Data berhasil ditambahkan.');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->route('items-faq.index')->withStatus('Data gagal ditambahkan. ' . $e);
            } catch (QueryException $e) {
                DB::rollBack();
                return redirect()->route('items-faq.index')->withStatus('Data gagal ditambahkan. ' . $e);
            }
        } else return view('error_page.forbidden');
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
        if($this->hasPermission($this->menu)){
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('items-faq.index');
            $this->param['itemFAQ'] = DB::table('items_faq')
                ->where('id', $id)
                ->first();
            $this->param['data'] = DB::table('kategori_faq')->get();
            if (!$this->param['itemFAQ']) {
                return redirect()->route('items-faq.index')->withStatus('Data tidak dapat ditemukan.');
            }
    
            return view('backend/items_faq.edit', $this->param);
        } else return view('error_page.forbidden');
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
        if($this->hasPermission($this->menu)){
            $data = DB::table('items_faq')
                ->where('id', $id)
                ->first();
    
            if (!$data) {
                return redirect()->route('items-faq.index')->withStatus('Data tidak dapat ditemukan.');
            }
    
            $isUnique = $data->pertanyaan == $request->pertanyaan ? '' : '|unique:items_faq,pertanyaan';
            $validate = $request->validate([
                'id_kategori' => 'required',
                'pertanyaan' => 'required' . $isUnique,
                'jawaban' => 'required'
            ], [
                'required' => ':attribute harus diisi.',
                'unique' => ':attribute telah digunakan'
            ], [
                'id_kategori' => 'Kategori',
                'pertanyaan' => 'Pertanyaan',
                'jawaban' => 'Jawaban'
            ]);
    
            try {
                DB::table('items_faq')
                    ->where('id', $id)
                    ->update([
                        'id_kategori' => $request->id_kategori,
                        'pertanyaan' => $request->pertanyaan,
                        'jawaban' => $request->jawaban,
                        'updated_at' => now()
                    ]);
    
                return redirect()->route('items-faq.index')->withStatus('Data berhasil diperbarui.');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->route('items-faq.index')->withStatus('Data gagal ditambahkan. ' . $e);
            } catch (QueryException $e) {
                DB::rollBack();
                return redirect()->route('items-faq.index')->withStatus('Data gagal ditambahkan. ' . $e);
            }
        } else return view('error_page.forbidden');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->hasPermission($this->menu)){
            $data = DB::table('items_faq')
                ->where('id', $id)
                ->first();
            if (!$data) {
                return redirect()->route('kategori-faq.index')->withStatus('Data tidak ditemukan.');
            }
    
            try {
                DB::table('kategori_faq')
                    ->where('id', $id)
                    ->delete();
    
                return redirect()->route('kategori-faq.index')->withStatus('Data berhasil dihapus.');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->route('kategori-faq.index')->withStatus('Data gagal dihapus. ' . $e);
            } catch (QueryException $e) {
                DB::rollBack();
                return redirect()->route('kategori-faq.index')->withStatus('Data gagal dihapus. ' . $e);
            }
        } else return view('error_page.forbidden');
    }

    public function upload(Request $request)
    {
        if($this->hasPermission($this->menu)){
            $upload = $request->file('upload');
    
            if ($upload) {
                $uploadedFile = CKEditorRepository::upload($upload, 'upload/ckedit');
    
                return response()->json([
                    'uploaded' => 1,
                    'url' => $request->getSchemeAndHttpHost() . "/{$uploadedFile}",
                ]);
            }
        } else return view('error_page.forbidden');
    }
}
