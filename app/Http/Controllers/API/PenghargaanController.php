<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penghargaan;

class PenghargaanController extends Controller
{
    public function getPenghargaan(Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $keyword = $request->get('keyword');
            $data = Penghargaan::select('id','konten','judul', 'slug', 'cover', 'updated_at')->orderBy('judul', 'ASC');

            if ($keyword) {
                $data->where('judul', 'LIKE', "%$keyword%")->orWhere('konten', 'LIKE', "%$keyword%");
            }
            
            $data = $data->paginate(5);
            
            foreach ($data as $key => $value) {
                $value->cover = $request->getSchemeAndHttpHost().'/public/'.$value->cover;
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
                'penghargaan' => $data
            );

            return response($response, $status);
        }
    }

    public function detailPenghargaan($slug, Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Penghargaan::where('slug', $slug)->first();
            $data->cover = $request->getSchemeAndHttpHost().$data->cover;
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
                'penghargaan' => $data
            );

            return response($response, $status);
        }
    }
}
