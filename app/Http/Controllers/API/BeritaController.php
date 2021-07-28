<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function getBerita(Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $keyword = $request->get('keyword');
            $berita = Berita::orderBy('updated_at', 'ASC')->get();

            $data['slide'] = [];
            $data['right'] = [];
            $data['box'] = [];

            if ($keyword) {
                $berita->where('judul', 'LIKE', "%$keyword%")->orWhere('konten', 'LIKE', "%$keyword%");
            }
            
            // $berita = $berita->paginate(5);

            foreach ($berita as $key => $value) {
                $value->cover =  $request->getSchemeAndHttpHost()."/".$value->cover;
                $value->judul = substr($value->judul,0,60);
                $value->konten = substr($value->konten,0,100);
                $value->tgl = date('d M Y H:i',strtotime($value->created_at));
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

    public function detailBerita(Request $request,$slug)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Berita::where('slug', $slug)->first();
            $data->cover = $request->getSchemeAndHttpHost()."/".$data->cover;
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
