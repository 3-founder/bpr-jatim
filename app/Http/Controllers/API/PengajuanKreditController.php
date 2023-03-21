<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PengajuanKreditRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PengajuanKreditController extends Controller
{
    public function postPengajuanKredit(PengajuanKreditRequest $request)
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
                    'status' => '0',
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
        ], Response::HTTP_CREATED);
    } 
}
