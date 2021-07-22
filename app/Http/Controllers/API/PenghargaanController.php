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
            $data = Penghargaan::select('judul', 'slug', 'cover', 'updated_at')->orderBy('judul', 'ASC');

            if ($keyword) {
                $data->where('judul', 'LIKE', "%$keyword%")->orWhere('konten', 'LIKE', "%$keyword%");
            }
            
            $data = $data->paginate(5);
            
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

    public function detailPenghargaan($slug)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Penghargaan::where('slug', $slug)->first();
            
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
