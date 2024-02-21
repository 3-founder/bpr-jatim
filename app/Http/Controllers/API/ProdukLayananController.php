<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ItemProdukLayanan;
use App\Models\JenisProdukLayanan;
use Illuminate\Http\Request;

class ProdukLayananController extends Controller
{
    public function getMenuProdukLayanan()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = JenisProdukLayanan::orderBy('nama_jenis', 'ASC')->get();
            
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

    public function getItemProdukLayananByJenis(Request $request, $id_jenis)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = ItemProdukLayanan::select('id','judul', 'slug','cover', 'updated_at')->where('id_jenis', $id_jenis)->orderBy('judul', 'ASC')->get();

            foreach ($data as $key => $value) {
                $value->cover =  $request->getSchemeAndHttpHost().'/'.$value->cover;
                
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
                'data' => $data
            );

            return response($response, $status);
        }
    }

    public function getKontenProdukLayananBySlug(Request $request,$slug)
    {
        $status = null;
        $message = null;
        $data = null;
        $sidemenu = null;
        
        try {
            $data = ItemProdukLayanan::where('slug', $slug)->first();
            $data->cover =  $request->getSchemeAndHttpHost().'/'.$data->cover;
            
            $sidemenu = ItemProdukLayanan::select('id','judul', 'slug')
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
