<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KomposisiSahamController extends Controller
{
    public function getKomposisiSaham() {
        $status = null;
        $message = null;
        $data = null;

        try {
            $data = DB::table('komposisi_saham AS k')
                    ->select(
                        'k.id',
                        'k.pemilik_saham',
                        'k.jenis',
                        'k.lembar',
                        'k.nominal',
                    )
                    ->get();
            
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

    public function getPersentaseSaham() {
        $status = null;
        $message = null;
        $data = null;

        try {
            $pemprov = DB::table('komposisi_saham')
                    ->select(
                        DB::raw('SUM(lembar) AS total_lembar'),
                        DB::raw('SUM(nominal) AS total_nominal'),
                    )
                    ->where('jenis', 'pemprov')
                    ->groupBy('jenis')
                    ->first();
            $pemprov->name = 'Persentase Pemegang Saham Bank BPR Jatim';

            $kotakab = DB::table('komposisi_saham')
                    ->select(
                        DB::raw('SUM(lembar) AS total_lembar'),
                        DB::raw('SUM(nominal) AS total_nominal'),
                    )
                    ->where('jenis', 'kota/kab')
                    ->groupBy('jenis')
                    ->first();
            $kotakab->name = 'Pemerintah Kabupaten/Kota Jatim';

            $dpd = DB::table('komposisi_saham')
                    ->select(
                        DB::raw('SUM(lembar) AS total_lembar'),
                        DB::raw('SUM(nominal) AS total_nominal'),
                    )
                    ->where('jenis', 'dpd')
                    ->groupBy('jenis')
                    ->first();
            $dpd->name = 'DPD Bank Jatim';
                
            $data = [
                'pemprov' => $pemprov,
                'kota_kab' => $kotakab,
                'dpd' => $dpd,
            ];
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
