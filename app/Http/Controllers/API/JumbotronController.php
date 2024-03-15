<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\JumbotronResource;
use App\Models\Jumbotron;
use Illuminate\Http\Request;

class JumbotronController extends Controller
{
    public function index(Request $request)
    {
        $jumbotron = Jumbotron::all();

        return response()->json([
            'status' => 200,
            'data' => JumbotronResource::collection($jumbotron),
        ]);
    }
}
