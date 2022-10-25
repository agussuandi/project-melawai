<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\MKaryawan;
use App\Models\HisKaryawanCovid19;

class KaryawanController extends Controller
{
    public function index()
    {
        try
        {
            $karyawan = MKaryawan::paginate(10);

            return view('pages.karyawan.index', [
                'karyawan' => $karyawan
            ]);
        }
        catch (\Throwable $th)
        {
            //throw $th;
        }
    }

    public function create()
    {
        try
        {
            return view('pages.karyawan.create');
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan.index')->with('error', 'Gagal mengakses page');
        }
    }
    
    public function store(Request $request)
    {
        try
        {
            DB::transaction(function () use($request) {
                $karyawan             = new MKaryawan;
                $karyawan->name       = $request->input('name');
                $karyawan->birth_date = $request->input('birthDate');
                $karyawan->address    = $request->input('address');
                $karyawan->jabatan    = $request->input('jabatan');
                $karyawan->created_by = auth()->user()->id;
                $karyawan->created_at = now();
                $karyawan->save();
            });

            return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambah');
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan.index')->with('error', 'Karyawan gagal ditambah');
        }
    }

    public function edit($id)
    {
        try
        {
            return view('pages.karyawan.edit', [
                'karyawan' => MKaryawan::find(decrypt($id))
            ]);
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan.index')->with('error', 'Gagal mengakses page Edit');
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            DB::transaction(function () use($request, $id) {
                $karyawan             = MKaryawan::find(decrypt($id));
                $karyawan->name       = $request->input('name');
                $karyawan->birth_date = $request->input('birthDate');
                $karyawan->address    = $request->input('address');
                $karyawan->jabatan    = $request->input('jabatan');
                $karyawan->updated_by = auth()->user()->id;
                $karyawan->updated_at = now();
                $karyawan->save();
            });

            return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diubah');
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan.index')->with('error', 'Karyawan gagal diubah');
        }
    }

    public function covid($id)
    {
        try
        {
            return view('pages.karyawan.form-covid', [
                'karyawan' => MKaryawan::find(decrypt($id))
            ]);
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan.index')->with('error', 'Gagal mengakses page Edit');
        }
    }

    public function covidStore(Request $request, $id)
    {
        try
        {
            DB::transaction(function () use($request, $id) {
                $hisKaryawanCovid19                = new HisKaryawanCovid19;
                $hisKaryawanCovid19->karyawan_id   = decrypt($id);
                $hisKaryawanCovid19->positive_date = $request->input('positiveDate');
                $hisKaryawanCovid19->note          = $request->input('note');
                $hisKaryawanCovid19->created_by    = auth()->user()->id;
                $hisKaryawanCovid19->created_at    = now();
                $hisKaryawanCovid19->save();

                $karyawan               = MKaryawan::find($hisKaryawanCovid19->karyawan_id);
                $karyawan->flag_covid19 = 1;
                $karyawan->updated_by   = auth()->user()->id;
                $karyawan->updated_at   = now();
                $karyawan->save();
            });

            return redirect()->route('karyawan.index')->with('success', 'Data Covid19 pada Karyawan berhasil');
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan.index')->with('error', 'Data Covid19 pada Karyawan gagal');
        }
    }

    public function covidEdit(Request $request, $id)
    {
        try
        {
            $hisKaryawanCovid19 = HisKaryawanCovid19::where('karyawan_id', decrypt($id))
                ->orderBy('id', 'desc')
            ->first();

            $hisKaryawanCovid19History = HisKaryawanCovid19::where('karyawan_id', $hisKaryawanCovid19->karyawan_id)
                ->where('positive_date', $hisKaryawanCovid19->positive_date)
            ->get();

            return view('pages.karyawan.form-pemulihan', [
                'hisKaryawanCovid19'        => $hisKaryawanCovid19,
                'hisKaryawanCovid19History' => $hisKaryawanCovid19History
            ]);
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan.index')->with('error', 'Page Pemulihan Covid19 gagal diakses');
        }
    }

    public function covidUpdate(Request $request, $id)
    {
        try
        {
            DB::transaction(function () use($request, $id) {
                $hisKaryawanCovid19                = new HisKaryawanCovid19;
                $hisKaryawanCovid19->karyawan_id   = decrypt($id);
                $hisKaryawanCovid19->positive_date = $request->input('positiveDate');
                $hisKaryawanCovid19->note          = 'Karyawan dinyatakan sudah negatif/sembuh dari Covid19';
                $hisKaryawanCovid19->created_by    = auth()->user()->id;
                $hisKaryawanCovid19->created_at    = now();
                $hisKaryawanCovid19->save();

                $karyawan               = MKaryawan::find($hisKaryawanCovid19->karyawan_id);
                $karyawan->flag_covid19 = 0;
                $karyawan->updated_by   = auth()->user()->id;
                $karyawan->updated_at   = now();
                $karyawan->save();
            });

            return redirect()->route('karyawan.index')->with('success', 'Pemulihan Covid19 pada Karyawan berhasil');
        }
        catch (\Throwable $th)
        {
            dd($th->getMessage());
            return redirect()->route('karyawan.index')->with('error', 'Pemulihan Covid19 pada Karyawan gagal');
        }
    }

    public function covidLogCreate($id)
    {
        try
        {
            $hisKaryawanCovid19 = HisKaryawanCovid19::where('karyawan_id', decrypt($id))
                ->orderBy('id', 'desc')
            ->first();

            return view('pages.karyawan.form-covid-log', [
                'hisKaryawanCovid19' => $hisKaryawanCovid19
            ]);
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan.index')->with('error', 'Gagal mengakses page Edit');
        }
    } 

    public function covidLogStore(Request $request, $id)
    {
        try
        {
            DB::transaction(function () use($request, $id) {
                $hisKaryawanCovid19                = new HisKaryawanCovid19;
                $hisKaryawanCovid19->karyawan_id   = decrypt($id);
                $hisKaryawanCovid19->positive_date = $request->input('positiveDate');
                $hisKaryawanCovid19->note          = $request->input('note');
                $hisKaryawanCovid19->created_by    = auth()->user()->id;
                $hisKaryawanCovid19->created_at    = now();
                $hisKaryawanCovid19->save();
            });

            return redirect()->route('karyawan.index')->with('success', 'Data Log Covid19 pada Karyawan berhasil');
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan.index')->with('error', 'Data Log Covid19 pada Karyawan gagal');
        }
    }
}
