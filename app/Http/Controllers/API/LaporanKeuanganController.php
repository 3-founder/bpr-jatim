<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    public function getLaporan(Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $keyword = $request->get('keyword');
            $data = LaporanKeuangan::query();

            if ($keyword) {
                $data->where('title', 'LIKE', "%$keyword%")->orWhere('tahun', 'LIKE', "%$keyword%");
            }   

            $data = $data->orderBy('tahun', 'DESC')->get();

            foreach ($data as $key => $value) {
                $value->cover = $request->getSchemeAndHttpHost() . '/public/' . $value->cover;
                $value->cover =  str_replace('public', '', $value->cover);
                $value->file = $request->getSchemeAndHttpHost() . '/public/' . $value->file;
                $value->file =  str_replace('public', '', $value->file);
            }

            $status = 200;
            $message = 'berhasil';
        } catch (\Exception $e) {
            $status = 400;
            $message = 'gagal.' . $e->getMessage();
        } catch (\Illuminate\Database\QueryException $e) {
            $status = 400;
            $message = 'gagal.' . $e->getMessage();
        } finally {

            $response = array(
                'status' => $status,
                'message' => $message,
                'data' => $data
            );

            return response(
                $response,
                $status,
                array(
                    'Content-Type' => 'application/json; charset=utf-8'
                )
            );
        }
    }
}
