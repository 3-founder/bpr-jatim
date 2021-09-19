<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuangan;

class LaporanKeuanganController extends Controller
{
    public function getLaporan()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = LaporanKeuangan::orderBy('tahun', 'DESC')->get();

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
                'data' => $data
            );

            return response($response,
            $status,
            array(
                'Content-Type'=>'application/json; charset=utf-8'
            ));
        }
    }
}
