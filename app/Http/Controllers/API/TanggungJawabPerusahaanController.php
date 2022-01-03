<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TanggungJawabPerusahaan;
use Illuminate\Http\Request;

class TanggungJawabPerusahaanController extends Controller
{
    public function getIndex($tahun)
    {
        $data = TanggungJawabPerusahaan::select('title','id')->where('tahun',$tahun)->orderBy('tahun','DESC')->get();

        if (!$data) {
            abort(404);
        }

        return response(
            [
            'msg' => 'successfully get data',
            'data' => $data,
            ], 200
        );
    }
    public function getDefaultContent($tahun,$id="")
    {
        if($id!=""){
            $data = TanggungJawabPerusahaan::where('id',$id)->first();
        }
        else{
            $data = TanggungJawabPerusahaan::where('tahun',$tahun)->orderBy('tahun','DESC')->first();
        }


        if (!$data) {
            abort(404);
        }

        return response(
            [
            'msg' => 'successfully get data',
            'data' => $data,
            ], 200
        );
    }
    public function getTahun()
    {
        $data = TanggungJawabPerusahaan::select('tahun')->orderBy('tahun','DESC')->distinct()->get();
    
        if (!$data) {
            abort(404);
        }
    
        return response(
            [
            'msg' => 'successfully get data',
            'data' => $data,
            ], 200
        );
    }
}
