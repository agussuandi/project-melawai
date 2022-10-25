<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\MKaryawan;
use App\Models\HisKaryawanCovid19;
use App\Models\RelKaryawanKeluargaVaksin;

class HomeController extends Controller
{
    public function index()
    {
        try
        {
            $karyawanPositif = MKaryawan::positif()->get();
            $karyawanNegatif = MKaryawan::negatif()->get();

            $hisKaryawanCovid19 = HisKaryawanCovid19::with('karyawan')
                ->whereDate('created_at', date('Y-m-d'))
            ->get();
            
            $relKaryawanKeluargaVaksin = RelKaryawanKeluargaVaksin::with(['karyawan', 'relKaryawanKeluargaVaksinSertifikat'])
                ->groupBy('karyawan_id')
            ->get();

            $karyawan = MKaryawan::all();

            return view('pages.home.index', [
                'karyawan'                  => $karyawan,
                'karyawanPositif'           => $karyawanPositif,
                'karyawanNegatif'           => $karyawanNegatif,
                'hisKaryawanCovid19'        => $hisKaryawanCovid19,
                'relKaryawanKeluargaVaksin' => $relKaryawanKeluargaVaksin
            ]);
        }
        catch (\Throwable $th)
        {
            dd($th->getMessage());
        }
    }
}
