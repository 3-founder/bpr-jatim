<?php

namespace App\Http\Controllers\API;

use App\Helpers\AssetPathHelper;
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

    public function getUmkmBinaanByKota(Request $request,$id_kota)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            // $data = UmkmBinaan::where('id_kota', $id_kota)->orderBy('nama', 'ASC')->get();

            $data = \DB::table('umkm_binaan as ub')->select('ub.*','k.nama_kota')->join('kota as k','ub.id_kota','k.id')->where('ub.id_kota', $id_kota)->orderBy('ub.nama', 'ASC')->get();
            foreach ($data as $key => $value) {
                $value->foto =  $request->getSchemeAndHttpHost().'/'.AssetPathHelper::assetPath($value->foto);
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
    public function getUmkmBinaan(Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $keyword = $request->get('key');
            $idKota = $request->get('id_kota');

            $data = \DB::table('umkm_binaan as ub')->select('ub.*','k.nama_kota')->join('kota as k','ub.id_kota','k.id')->orderBy('ub.nama', 'ASC');

            if($keyword){
                if($idKota==''){
                    $data->where('ub.jenis_usaha', 'LIKE', "%$keyword%");
                }
                else{
                    $data->where('ub.jenis_usaha', 'LIKE', "%$keyword%");
                    $data->where('ub.id_kota',$request->get('id_kota'));
                }
            }

            if($idKota){
                if($keyword==''){
                    $data->where('ub.id_kota',$request->get('id_kota'));
                }
                else{
                    $data->where('ub.jenis_usaha', 'LIKE', "%$keyword%");
                    $data->where('ub.id_kota',$request->get('id_kota'));
                }
            }


            $data = $data->get();
            foreach ($data as $key => $value) {
                $value->foto =  $request->getSchemeAndHttpHost().'/'.AssetPathHelper::assetPath($value->foto);
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

    public function getUmkmBinaanBySlug($slug, Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = UmkmBinaan::where('slug', $slug)->first();
            $data->foto = $request->getSchemeAndHttpHost().'/'.AssetPathHelper::assetPath($data->foto);

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
