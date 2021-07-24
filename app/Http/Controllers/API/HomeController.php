<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Bunga;
use App\Models\IntroVidio;
use App\Models\Kurs;
use App\Models\Profil;
use App\Models\Promo;
use App\Models\Tenor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getBunga()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Bunga::first()->bunga;
            
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

    public function getTenor()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Tenor::orderBy('tenor', 'ASC')->get();
            
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

    public function getKurs()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Kurs::select('nama', 'harga_beli', 'ket_beli', 'harga_jual', 'ket_jual', 'updated_at')
                        ->orderBy('nama', 'ASC')
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
                'data' => $data
            );

            return response($response, $status);
        }
    }

    public function getBerita()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Berita::select('judul', 'slug', 'cover', 'updated_at')->orderBy('updated_at', 'ASC')->take(10)->get();
            
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

    public function getProfil()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Profil::first();
            
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

    public function getVideo()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = IntroVidio::first();
            
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

    public function getPromo()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Promo::select('judul', 'slug', 'cover')->take(8)->get();
            
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
