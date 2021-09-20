<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TanggungJawabPerusahaan;
use Illuminate\Http\Request;

class TanggungJawabPerusahaanController extends Controller
{
    public function getIndex()
    {
        $data = TanggungJawabPerusahaan::orderBy('tahun','DESC')->get();

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
