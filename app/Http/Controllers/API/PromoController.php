<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PromoResource;
use Illuminate\Http\Request;
use App\Models\Promo;

class PromoController extends Controller
{
    public function getPromo(Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $keyword = $request->get('keyword');
            $data = Promo::select('id', 'judul', 'slug', 'cover', 'konten', 'updated_at')->orderBy('judul', 'ASC');

            if ($keyword) {
                $data->where('judul', 'LIKE', "%$keyword%")->orWhere('konten', 'LIKE', "%$keyword%");
            }

            $data = $data->paginate(5);
            foreach ($data as $key => $value) {
                $value->cover =  $request->getSchemeAndHttpHost() . '/public/' . $value->cover;
                $value->cover =  str_replace('public/public', 'public', $value->cover);
                $value->judulFull = $value->judul;
                $value->kontenFull = $value->konten;
                $value->judul = substr($value->judul, 0, 30);
                $value->konten = substr($value->konten, 0, 100);
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
                'promo' => $data
            );

            return response($response, $status);
        }
    }

    public function detailPromo($slug, Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Promo::where('slug', $slug)->first();
            $data->cover =  $request->getSchemeAndHttpHost() . '/public/' . $data->cover;
            $data->cover =  str_replace('public/public', 'public', $data->cover);

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
                'promo' => $data
            );

            return response($response, $status);
        }
    }

    public function popupPromo(Request $request)
    {
        $promos = Promo::where('is_shown', 1);
        return PromoResource::collection($promos->get());
    }
}
