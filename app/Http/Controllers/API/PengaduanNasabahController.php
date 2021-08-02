<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaduanNasabah;

class PengaduanNasabahController extends Controller
{
    public function store(Request $request)
    {
        $status = null;
        $message = null;

        try {
            $data = $request->getContent();
            $data = json_decode($data, true);   
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['tgl_lahir'] = $data['tgl_lahir']=='' ? date('Y-m-d') : $data['tgl_lahir'];
            $data['tgl_lahir_perwakilan'] = $data['tgl_lahir_perwakilan']=='' ? date('Y-m-d') : $data['tgl_lahir_perwakilan'];
            PengaduanNasabah::insert($data);
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
            );

            return response($response, $status);
        }
    }
}
