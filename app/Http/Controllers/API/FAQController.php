<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FAQController extends Controller
{
    public function getKategoriIndex()
    {
        $data = null;
        $status = null;
        $message = null;
        try{
            $data = DB::table('kategori_faq')
                ->get();
            $message = 'success.';
            $status = 200;

            if(count($data) == 0){
                $data = null;
                $status = 400;
                $message = 'Tidak dapat menemukan kategori';
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ]);
        } catch(Exception $e){
            $status = 400;
            $message = 'fail. '.$e;

            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => null
            ]);
        } catch(QueryException $e){
            $status = 400;
            $message = 'fail. '. $e;

            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => null
            ]);
        }
    }

    public function getItemsByKategori($kategori)
    {
        $data = null;
        $message = null;
        $status = null;

        try{
            $data = DB::table('items_faq')
                ->where('id_kategori', $kategori)
                ->join('kategori_faq', 'items_faq.id_kategori', 'kategori_faq.id')
                ->get();
            $status = 200;
            $message = 'success';

            if(count($data) == 0){
                $data = null;
                $status = 400;
                $message = 'Tidak dapat menemukan kategori';
            }
        } catch(Exception $e){
            $status = 400;
            $message = 'fail. '.$e;
        } catch(QueryException $e){
            $status = 400;
            $message = 'fail. '.$e;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
}
