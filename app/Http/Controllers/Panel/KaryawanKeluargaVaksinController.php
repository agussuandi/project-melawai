<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Storage;

use App\Models\MKaryawan;
use App\Models\RelKaryawanVaksin;
use App\Models\RelKaryawanKeluargaVaksin;
use App\Models\RelKaryawanKeluargaVaksinSertifikat;

class KaryawanKeluargaVaksinController extends Controller
{
    public function index()
    {
        try
        {
            $relKaryawanKeluargaVaksinSertifikat = RelKaryawanKeluargaVaksinSertifikat::with(['relKaryawanKeluargaVaksin'])->paginate(10);

            return view('pages.karyawan-keluarga-vaksin.index', [
                'relKaryawanKeluargaVaksinSertifikat' => $relKaryawanKeluargaVaksinSertifikat
            ]);
        }
        catch (\Throwable $th)
        {
            //throw $th;
        }
    }

    public function create(Request $request)
    {
        try
        {
            $karyawan = MKaryawan::select('id', 'name')->get();

            return view('pages.karyawan-keluarga-vaksin.create', [
                'karyawan' => $karyawan
            ]);
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan-keluarga-vaksin.index')->with('error', 'Gagal mengakses Tambah Karyawan Keluarga Vaksin');
        }
    }

    public function store(Request $request)
    {
        try
        {
            DB::transaction(function () use($request) {
                $userInfo = auth()->user();
                $relKaryawanKeluargaVaksin              = new RelKaryawanKeluargaVaksin;
                $relKaryawanKeluargaVaksin->karyawan_id = $request->karyawan;
                $relKaryawanKeluargaVaksin->created_by  = $userInfo->id;
                $relKaryawanKeluargaVaksin->created_at  = now();
                $relKaryawanKeluargaVaksin->save();

                foreach ($request->vaksin as $key => $value)
                {
                    $imgName    = str()->slug($value)."_karyawan-{$request->karyawan}-keluarga-{$request->name[$key]}";
                    $extension  = $request->sertifikat[$key]->extension();
                    $fileName   = "{$imgName}-{$extension}";
                    $pathPrefix = "public/vaksin/{$request->karyawan}";
                    $putContent = Storage::putFileAs($pathPrefix, $request->sertifikat[$key], $fileName);
                    
                    $relKaryawanKeluargaVaksinSertifikat                              = new RelKaryawanKeluargaVaksinSertifikat;
                    $relKaryawanKeluargaVaksinSertifikat->karyawan_keluarga_vaksin_id = $relKaryawanKeluargaVaksin->id;
                    $relKaryawanKeluargaVaksinSertifikat->name                        = $request->name[$key];
                    $relKaryawanKeluargaVaksinSertifikat->relation                    = $request->relation[$key];
                    $relKaryawanKeluargaVaksinSertifikat->vaksin                      = $request->vaksin[$key];
                    $relKaryawanKeluargaVaksinSertifikat->sertifikat_vaksin           = str_replace('public', 'storage', $putContent);
                    $relKaryawanKeluargaVaksinSertifikat->created_by                  = $userInfo->id;
                    $relKaryawanKeluargaVaksinSertifikat->created_at                  = now();
                    $relKaryawanKeluargaVaksinSertifikat->save();
                }
            });

            return redirect()->route('karyawan-keluarga-vaksin.index')->with('success', 'Berhasil menambahkan Karyawan Keluarga Vaksin');
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan-keluarga-vaksin.index')->with('error', 'Gagal menambahkan Karyawan Keluarga Vaksin');
        }
    }

    public function edit($id)
    {
        try
        {
            $relKaryawanKeluargaVaksinSertifikat = RelKaryawanKeluargaVaksinSertifikat::find(decrypt($id));

            return view('pages.karyawan-keluarga-vaksin.edit', [
                'relKaryawanKeluargaVaksinSertifikat' => $relKaryawanKeluargaVaksinSertifikat
            ]);
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan-vaksin.index')->with('error', 'Gagal mengakses page Edit Karyawan Vaksin');
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            DB::transaction(function () use($id, $request) {
                $userInfo = auth()->user();
                $relKaryawanKeluargaVaksinSertifikat = RelKaryawanKeluargaVaksinSertifikat::find(decrypt($id));
                $karyawan = $relKaryawanKeluargaVaksinSertifikat->relKaryawanKeluargaVaksin->karyawan;
                
                if ($request->sertifikat && $request->sertifikat !== null)
                {
                    $imgName    = str()->slug($request->vaksin)."_karyawan-{$karyawan->id}-keluarga-{$request->name}";
                    $extension  = $request->sertifikat->extension();
                    $fileName   = "{$imgName}.{$extension}";
                    $pathPrefix = "public/vaksin/{$karyawan->id}";
                    $putContent = Storage::putFileAs($pathPrefix, $request->sertifikat, $fileName);
                }
                
                $relKaryawanKeluargaVaksinSertifikat->name     = $request->name;
                $relKaryawanKeluargaVaksinSertifikat->relation = $request->relation;
                $relKaryawanKeluargaVaksinSertifikat->vaksin   = $request->vaksin;

                if ($request->vaksin && $request->vaksin !== null)
                {
                    $relKaryawanKeluargaVaksinSertifikat->sertifikat_vaksin = str_replace('public', 'storage', $putContent);
                }

                $relKaryawanKeluargaVaksinSertifikat->updated_by = $userInfo->id;
                $relKaryawanKeluargaVaksinSertifikat->updated_at = now();
                $relKaryawanKeluargaVaksinSertifikat->save();
            });

            return redirect()->route('karyawan-keluarga-vaksin.index')->with('success', 'Berhasil mengubah Karyawan Keluarga Vaksin');
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan-keluarga-vaksin.index')->with('error', 'Gagal mengubah Karyawan Keluarga Vaksin');
        }        
    }
}
