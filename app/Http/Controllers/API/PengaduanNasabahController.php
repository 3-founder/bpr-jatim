<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PengaduanNasabahRequest;
use Illuminate\Http\Request;
use App\Models\PengaduanNasabah;
use Illuminate\Http\Response;

class PengaduanNasabahController extends Controller
{
    public function store(PengaduanNasabahRequest $request)
    {
        PengaduanNasabah::create($request->validated());

        return response()->json([
            'status' => '201',
            'message' => 'Berhasil menyimpan pengaduan',
        ], Response::HTTP_CREATED);
    }
}
