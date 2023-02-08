<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ItemProdukLayanan;
use App\Models\JenisProdukLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemProdukLayananController extends Controller
{
    private $param;
    
    public function __construct()
    {
        $this->param['title'] = 'Master Konten Produk & Layanan';
        $this->param['pageTitle'] = 'Master Konten Produk & Layanan';
        $this->param['pageIcon'] = 'store';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('item-produk-layanan.create');

        try {
            $keyword = $request->get('keyword');
            $getKonten = ItemProdukLayanan::select('item_produk_layanan.*', 'jenis_produk_layanan.nama_jenis')
                                        ->join('jenis_produk_layanan', 'jenis_produk_layanan.id', 'item_produk_layanan.id_jenis')
                                        ->orderBy('judul', 'ASC');

            if ($keyword) {
                $getKonten->where('item_produk_layanan.judul', 'LIKE', "%$keyword%")
                        ->orWhere('item_produk_layanan.text_top', 'LIKE', "%$keyword%")
                        ->orWhere('jenis_produk_layanan.nama_jenis', 'LIKE', "%$keyword%");
            }

            $this->param['konten'] = $getKonten->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('backend.item-produk-layanan.list-item-produk-layanan', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('item-produk-layanan.index');
        $this->param['jenis'] = JenisProdukLayanan::orderBy('nama_jenis', 'ASC')->get();

        return \view('backend.item-produk-layanan.tambah-item-produk-layanan', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isUnique = '';
        if($request->get('jenis')) {
            $konten = ItemProdukLayanan::where('id_jenis', $request->get('jenis'))->get();

            if(count($konten) > 0) {
                foreach ($konten as $key => $value) {
                    $isUnique = $value->judul != $request->judul ? '' : '|unique:item_produk_layanan,judul';
                }
            }
        }

        $validatedData = $request->validate(
            [
                'jenis' => 'required|not_in:0',
                'judul' => 'required'.$isUnique,
                'cover' => 'required',
                'deskripsi' => 'required',
                'konten' => 'required'
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah terdaftar',
                'not_in' => ':attribute harus dipilih',
            ],
            [
                'jenis' => 'Jenis Produk & Layanan',
                'judul' => 'Judul',
                'deskripsi' => 'Deskripsi',
                'konten' => 'Konten',
                'cover' => 'Cover',
            ]
        );
        try {

            if($request->file('cover') != null) {
                $folder = 'public/upload/produk-layanan/';
                $file = $request->file('cover');
                $filename = date('YmdHis').$file->getClientOriginalName();
                // Get canonicalized absolute pathname
                $path = realpath($folder);

                // If it exist, check if it's a directory
                if(!($path !== true AND is_dir($path)))
                {
                    // Path/folder does not exist then create a new folder
                    mkdir($folder, 0755, true);
                }

                $compressed = \Image::make($file->getRealPath());

                if($compressed->save($folder.$filename, 50)) {
                    $newKonten = new ItemProdukLayanan;
                    
                    $newKonten->id_jenis = $request->get('jenis');
                    $newKonten->judul = $request->get('judul');
                    $newKonten->cover = $folder.$filename;
                    $newKonten->slug = Str::slug($request->get('judul'));
                    $newKonten->text_top = $request->get('deskripsi');
                    $newKonten->konten = $request->get('konten');
        
                    $newKonten->save();
                }
            }

            return redirect()->route('item-produk-layanan.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->route('item-produk-layanan.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            // return $e->getMessage();

            return redirect()->route('item-produk-layanan.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
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
        try {
            $this->param['title'] = 'Detail Konten Produk & Layanan';
            $this->param['pageTitle'] = 'Detail Konten Produk & Layanan';
            $this->param['pageIcon'] = 'store';
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('item-produk-layanan.index');
            $this->param['konten'] = ItemProdukLayanan::select('item_produk_layanan.*', 'jenis_produk_layanan.nama_jenis')
                                                        ->join('jenis_produk_layanan', 'jenis_produk_layanan.id', 'item_produk_layanan.id_jenis')
                                                        ->where('item_produk_layanan.id', $id)
                                                        ->first();

            return \view('backend.item-produk-layanan.detail-item-produk-layanan', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
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
        try {
            $this->param['title'] = 'Edit Konten Produk & Layanan';
            $this->param['pageTitle'] = 'Edit Konten Produk & Layanan';
            $this->param['pageIcon'] = 'store';
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('item-produk-layanan.index');
            $this->param['jenis'] = JenisProdukLayanan::orderBy('nama_jenis', 'ASC')->get();
            $this->param['konten'] = ItemProdukLayanan::find($id);

            return \view('backend.item-produk-layanan.edit-item-produk-layanan', $this->param);
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
        // return $request->all();
        // return $request->file('cover')->getClientOriginalName();
        $konten = ItemProdukLayanan::find($id);

        $isUnique = $konten->judul == $request->judul ? '' : '|unique:item_produk_layanan,judul';
        $validatedData = $request->validate(
            [
                'jenis' => 'required|not_in:0',
                'judul' => 'required'.$isUnique,
                'deskripsi' => 'required',
                'konten' => 'required'
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah terdaftar',
                'not_in' => ':attribute harus dipilih',
            ],
            [
                'jenis' => 'Jenis Produk & Layanan',
                'judul' => 'Judul',
                'deskripsi' => 'Deskripsi',
                'konten' => 'Konten'
            ]
        );
        try {
            if($request->file('cover') != null) {
                $folder = '/public/upload/produk-layanan/';
                $file = $request->file('cover');
                $filename = date('YmdHis').$file->getClientOriginalName();
                // Get canonicalized absolute pathname
                $path = realpath($folder);

                // If it exist, check if it's a directory
                if(!($path !== true AND is_dir($path)))
                {
                    // Path/folder does not exist then create a new folder
                    mkdir($folder, 0755, true);
                }

                if(\file_exists($konten->cover)){
                    // Menghapus file sebelumnya
                    \File::delete($konten->cover);
                }
                $compressed = \Image::make($file->getRealPath());

                if($compressed->save($folder.$filename, 50)) {
                    $konten->cover = $folder.$filename;
                }
                return $path;
            }
            $konten->id_jenis = $request->get('jenis');
            $konten->judul = $request->get('judul');
            $konten->slug = Str::slug($request->get('judul'));
            $konten->text_top = $request->get('deskripsi');
            $konten->konten = $request->get('konten');
            
            $konten->save();

            if($isUnique != '')
                return redirect()->route('item-produk-layanan.index')->withStatus('Data berhasil diperbarui.');
            else
                return redirect()->route('item-produk-layanan.index');

        } catch (\Exception $e) {
            // return $e->getMessage();
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            // return $e->getMessage();
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
            $konten = ItemProdukLayanan::findOrFail($id);

            $konten->delete();

            return redirect()->route('item-produk-layanan.index')->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('item-produk-layanan.index')->withError('Terjadi kesalahan : ' . $e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('item-produk-layanan.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }
}
