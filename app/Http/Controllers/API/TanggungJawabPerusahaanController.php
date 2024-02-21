<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TanggungJawabPerusahaan;
use Illuminate\Http\Request;

class TanggungJawabPerusahaanController extends Controller
{
    public function getIndex($tahun)
    {
        $data = TanggungJawabPerusahaan::where('tahun',$tahun)->orderBy('tahun','DESC')->get();

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
    public function getDefaultContent($tahun,$id="", Request $request)
    {
        if($id!=""){
            $data = TanggungJawabPerusahaan::where('id',$id)->get();
        }
        else{
            $data = TanggungJawabPerusahaan::where('tahun',$tahun)->orderBy('tahun','DESC')->get();
        }

        foreach ($data as $key => $value) {
            $value->cover = $request->getSchemeAndHttpHost().'/'.$value->cover;
            
            $value->file = $request->getSchemeAndHttpHost().'/'.$value->file;
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

    public function getAllTanggungJawab()
    {
        $data = TanggungJawabPerusahaan::select('*')->orderBy('tahun', 'DESC')->get();

        return response()->json([
            'msg' => 'successfully get data.',
            'data' => $data
        ], 200);
    }
}
