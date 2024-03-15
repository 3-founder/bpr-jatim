<?php

namespace App\Http\Controllers\API;

use App\Helpers\AssetPathHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Epaper;

class EpaperController extends Controller
{
    public function getEpaper(Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $keyword = $request->get('keyword');
            $data = Epaper::orderBy('judul', 'ASC');

            if ($keyword) {
                $data->where('judul', 'LIKE', "%$keyword%")->orWhere('konten', 'LIKE', "%$keyword%");
            }

            $data = $data->paginate(5);

            foreach ($data as $key => $value) {
                $value->cover = $request->getSchemeAndHttpHost().'/'.AssetPathHelper::assetPath($value->cover);

                $value->konten =  $request->getSchemeAndHttpHost().'/'.AssetPathHelper::assetPath($value->konten);

                $value->tgl = date('d M Y',strtotime($value->updated_at));
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
                'epaper' => $data
            );

            return response($response, $status);
        }
    }

    public function detailEpaper($slug, Request $request)
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = Epaper::where('slug', $slug)->first();
            if ($data) {
                $data->cover =  $request->getSchemeAndHttpHost().'/'.AssetPathHelper::assetPath($data->cover);
                $data->konten =  $request->getSchemeAndHttpHost().'/'.AssetPathHelper::assetPath($data->konten);
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
                'epaper' => $data
            );

            return response($response, $status);
        }
    }
}
