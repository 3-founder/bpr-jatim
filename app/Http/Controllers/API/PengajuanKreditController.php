<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanKreditController extends Controller
{
    public function postPengajuanKredit(Request $request)
    {
        $status = null;
        $message = null;

        try{
            DB::table('pengajuan_kredit')
                ->insert([
                    'tenor' => $request->get('tenor'),
                    'nominal' => $request->get('nominal'),
                    'nama' => $request->get('nama'),
                    'telp' => $request->get('telp'),
                    'email' => $request->get('email'),
                    'alamat' => $request->get('alamat'),
                    'kota' => $request->get('kota'),
                    'status' => 0,
                    'created_at' => now()
                ]);

            $status = 200;
            $message = 'success.';
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
        ]);
    }
}
