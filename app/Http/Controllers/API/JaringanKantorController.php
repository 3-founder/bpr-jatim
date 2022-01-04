<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JaringanKantor;
use App\Models\Kota;
use App\Models\ItemProdukLayanan;
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
            $kota = Kota::get(); 
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
                'data' => $data,
                'kota' =>  $kota
            );

            return response($response, $status);
        }
    }
}
