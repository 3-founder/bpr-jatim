<?php

namespace App\Http\Controllers\API;

use App\Helpers\AssetPathHelper;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function getBerita(Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $kategori = KategoriBerita::get();
            $keyword = $request->get('keyword');
            $keyKategori = $request->get('kategori');
            $berita = \DB::table('berita as b')->select('b.id','judul', 'slug', 'cover', 'b.updated_at','konten','b.created_at','b.updated_at','k.kategori')->join('kategori_berita as  k','b.id_kategori','k.id')->orderBy('created_at', 'DESC');


            $data['slide'] = [];
            $data['right'] = [];
            $data['box'] = [];

            if ($keyword) {
                $berita->where('judul', 'LIKE', "%$keyword%")->orWhere('konten', 'LIKE', "%$keyword%");
            }

            if ($keyKategori) {
                $berita->where('id_kategori',$keyKategori);
            }

            $berita = $berita->get();

            foreach ($berita as $key => $value) {
                $value->cover =  AssetPathHelper::assetPath($request->getSchemeAndHttpHost().'/'.$value->cover);

                $value->judul = substr($value->judul,0,60);
                $value->konten = substr($value->konten,0,100);
                $value->tgl = date('d M Y H:i',strtotime($value->created_at));
                if($keyword || $keyKategori){
                    array_push($data['box'],$value);
                }
                else{
                    if($key<=3){
                        array_push($data['slide'],$value);
                    }
                    else if($key>=4 && $key<=6){
                        array_push($data['right'],$value);
                    }
                    else{
                        array_push($data['box'],$value);
                    }
                }
            }

            $status = 200;
            $message = 'berhasil';
        }
        catch (\Exception $e) {
            $status = 400;
            $message = 'gagal.'.$e->getMessage();
        }
        catch (\Illuminate\Database\QueryException $e) {
            $status = 400;
            $message = 'gagal.'.$e->getMessage();
        }
        finally {
            $response = array(
                'status' => $status,
                'message' => $message,
                'berita' => $data,
                'kategori' => $kategori
            );

            return response($response, $status);
        }
    }

    public function detailBerita(Request $request,$slug)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Berita::with('kategori')->where('slug', $slug)->first();
            $data->telah_dilihat += 1;
            $data->save();
            $data->cover =  $request->getSchemeAndHttpHost().'/'.AssetPathHelper::assetPath($data->cover);

            $data->tgl = date('d M Y H:i',strtotime($data->created_at));

            $status = 200;
            $message = 'berhasil';
        }
        catch (\Exception $e) {
            $status = 400;
            $message = 'gagal.'.$e->getMessage();
        }
        catch (\Illuminate\Database\QueryException $e) {
            $status = 400;
            $message = 'gagal.'.$e->getMessage();
        }
        finally {
            $response = array(
                'status' => $status,
                'message' => $message,
                'berita' => $data
            );

            return response($response, $status);
        }
    }
}
