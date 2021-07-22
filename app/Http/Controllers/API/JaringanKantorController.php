<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JaringanKantor;
use Illuminate\Http\Request;

class JaringanKantorController extends Controller
{
    public function getJaringanKantor()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = JaringanKantor::with('kota')->get();
            
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

    public function getItemProdukLayananByJenis($id_jenis)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = ItemProdukLayanan::select('judul', 'slug', 'updated_at')->where('id_jenis', $id_jenis)->orderBy('judul', 'ASC')->get();
            
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

    public function getKontenProdukLayananBySlug($slug)
    {
        $status = null;
        $message = null;
        $data = null;
        $sidemenu = null;
        
        try {
            $data = ItemProdukLayanan::where('slug', $slug)->first();
            $sidemenu = ItemProdukLayanan::select('judul', 'slug')
                                        ->where('id_jenis', $data->id_jenis)
                                        ->orderBy('judul', 'ASC')
                                        ->get();

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
                'sidemenu' => $sidemenu,
                'data' => $data,
            );

            return response($response, $status);
        }
    }
}
