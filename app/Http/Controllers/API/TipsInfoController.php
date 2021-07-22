<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TipsKeamananInfoTerkini;

class TipsInfoController extends Controller
{
    public function getTipsInfo()
    {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = TipsKeamananInfoTerkini::first();
            
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
