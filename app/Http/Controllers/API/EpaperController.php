<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Epaper;

class EpaperController extends Controller
{
    public function getEpaper(Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $keyword = $request->get('keyword');
            $data = Epaper::orderBy('judul', 'ASC');

            if ($keyword) {
                $data->where('judul', 'LIKE', "%$keyword%")->orWhere('konten', 'LIKE', "%$keyword%");
            }
            
            $data = $data->paginate(5);

            foreach ($data as $key => $value) {
                $value->cover =  $request->getSchemeAndHttpHost().'/public/'.$value->cover;
                $value->cover =  str_replace('public/public', 'public',$value->cover);
                $value->konten =  $request->getSchemeAndHttpHost().'/public/'.$value->konten;
                $value->konten =  str_replace('public/public', 'public',$value->konten);
                $value->tgl = date('d M Y',strtotime($value->updated_at));
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
                'epaper' => $data
            );

            return response($response, $status);
        }
    }

    public function detailEpaper($slug, Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Epaper::where('slug', $slug)->first();
            $data->cover =  $request->getSchemeAndHttpHost().'/public/'.$data->cover;
            $data->cover =  str_replace('public/public', 'public',$data->cover);
            $data->konten =  $request->getSchemeAndHttpHost().'/public/'.$data->konten;
            $data->konten =  str_replace('public/public', 'public',$data->konten);
            
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
                'epaper' => $data
            );

            return response($response, $status);
        }
    }
}
