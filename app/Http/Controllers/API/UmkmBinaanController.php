<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\UmkmBinaan;
use Illuminate\Http\Request;

class UmkmBinaanController extends Controller
{
    public function getCabang()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Kota::select('id', 'nama_kota', 'alamat', 'telp')->orderBy('nama_kota', 'ASC')->get();
            
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

            return response($response, $status);
        }
    }

    public function getUmkmBinaanByKota($id_kota)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = UmkmBinaan::where('id_kota', $id_kota)->orderBy('nama', 'ASC')->get();
            
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

            return response($response, $status);
        }
    }

    public function getUmkmBinaanBySlug($slug)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = UmkmBinaan::where('slug', $slug)->first();
            
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

            return response($response, $status);
        }
    }
}
