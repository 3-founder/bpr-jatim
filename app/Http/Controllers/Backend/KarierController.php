<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Karier;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KarierController extends Controller
{
    private $param;
    private $menu;
    
    public function __construct()
    {
        $this->param['title'] = 'Karier';
        $this->param['pageTitle'] = 'Karier';
        $this->param['pageIcon'] = 'walking';
        $this->menu = 'Berita & Info - Karier';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->hasPermission($this->menu)){
            try {
                $this->param['btnRight']['text'] = 'Tambah';
                $this->param['btnRight']['link'] = route('karier.create');
                $this->param['data'] = DB::table('karier')
                    ->paginate(10);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('karier.index')->withError('Terjadi Kesalahan');
            }
    
            return \view('backend.karier.index', $this->param);
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
            $this->param['btnRight']['link'] = route('karier.index');
    
            return \view('backend.karier.create', $this->param);
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
            $this->validate($request, [
                'judul' => 'required',
                'konten' => 'required',
                'cover' => 'required'
            ], [
                'required' => ':attribute tidak boleh kosong.'
            ], [
                'judul' => 'Judul',
                'konten' => 'Konten',
                'cover' => 'Cover',
            ]);
            
            DB::beginTransaction();
            try {
                if($request->file('cover') != null) {
                    $folder = 'public/upload/karier/';
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
                    if($file->move($folder, $filename)) {
                        DB::table('karier')
                            ->insert([
                                'judul' => $request->judul,
                                'konten' => $request->konten,
                                'cover' => $folder.$filename,
                                'slug' => Str::slug($request->judul),
                                'created_at' => now()
                            ]);
                        DB::commit();
                        return redirect()->route('karier.index')->withStatus('Berhasil menambahkan data karier.');
                    } else {
                        return redirect()->back()->withError('Terjadi kesalahan.');
                    }
                } else {
                    return redirect()->back()->withError('Harap mengisi cover.');
                }
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
            } catch (QueryException $e){
                DB::rollBack();
                return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
            }
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
        if($this->hasPermission($this->menu)) {
            try{
                $this->param['btnRight']['text'] = 'Lihat Data';
                $this->param['btnRight']['link'] = route('karier.index');
                $this->param['data'] = Karier::findOrFail($id);
                return view('backend.karier.edit', $this->param);
            } catch(Exception $e) {
                return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
            } catch(QueryException $e) {
                return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
            }
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

                if($request->file('cover') != null) {
                    $folder = 'public/upload/karier/';
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
                    if($karierUpdate->cover != null){
                        if(file_exists($karierUpdate->cover)){
                            \File::delete($karierUpdate->cover);
                        }
                    }

                    if($file->move($folder, $filename)) {
                        $karierUpdate->cover = $folder.$filename;
                    }
                }

                $karierUpdate->judul = $request->get('judul');
                $karierUpdate->konten = $request->get('konten');
                $karierUpdate->slug = Str::slug($request->judul);
                $karierUpdate->updated_at = now();
                $karierUpdate->save();
    
                return redirect()->route('karier.index')->withStatus('Berhasil mengubah karier.');
            } catch (\Exception $e) {
                return redirect()->back()->withError('Terjadi Kesalahan. ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError('Terjadi Kesalahan. ' . $e->getMessage());
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
        if($this->hasPermission($this->menu)) {
            DB::beginTransaction();
            try {
                $karier = Karier::findOrFail($id);
                $cover = $karier->cover;
                if($cover != null){
                    if(file_exists($cover)){
                        if(\File::delete($cover)){
                            $karier->delete();
                        }
                    }
                }
                $karier->delete();

                DB::commit();
                return redirect()->route('karier.index')->withStatus('Berhasil menghapus data karier.');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
            } catch (QueryException $e) {
                DB::rollBack();
                return redirect()->back()->withError('Terjadi kesalahan. ' . $e->getMessage());
            }
        } else return view('error_page.forbidden');
    }
}
