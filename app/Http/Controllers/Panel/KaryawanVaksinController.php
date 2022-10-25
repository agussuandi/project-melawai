<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Storage;

use App\Models\MKaryawan;
use App\Models\RelKaryawanVaksin;

class KaryawanVaksinController extends Controller
{
    public function index()
    {
        try
        {
            $relKaryawanVaksin = RelKaryawanVaksin::with('karyawan')->paginate(10);

            return view('pages.karyawan-vaksin.index', [
                'relKaryawanVaksin' => $relKaryawanVaksin
            ]);
        }
        catch (\Throwable $th)
        {
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function create()
    {
        try
        {
            $karyawan = MKaryawan::select('id', 'name')->get();

            return view('pages.karyawan-vaksin.create', [
                'karyawan' => $karyawan
            ]);
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan-vaksin.index')->with('error', 'Gagal mengakses page Create Karyawan Vaksin');
        }
    }

    public function store(Request $request)
    {
        try
        {
            $userInfo   = auth()->user();
            $imgName    = str()->slug($request->vaksin)."_karyawan-{$request->karyawan}";
            $extension  = $request->sertifikat->extension();
            $fileName   = "{$imgName}-{$extension}";
            $pathPrefix = "public/vaksin/{$request->karyawan}";
            $putContent = Storage::putFileAs($pathPrefix, $request->sertifikat, $fileName);

            DB::transaction(function () use($request, $putContent, $userInfo) {
                $relKaryawanVaksin                    = new RelKaryawanVaksin;
                $relKaryawanVaksin->karyawan_id       = $request->input('karyawan');
                $relKaryawanVaksin->vaksin            = $request->input('vaksin');
                $relKaryawanVaksin->sertifikat_vaksin = str_replace('public', 'storage', $putContent);
                $relKaryawanVaksin->created_by        = $userInfo->id;
                $relKaryawanVaksin->created_at        = now();
                $relKaryawanVaksin->save();
            });

            return redirect()->route('karyawan-vaksin.index')->with('success', 'Karyawan Vaksin berhasil ditambah');
        }
        catch (\Throwable $th)
        {
            return redirect()->route('karyawan-vaksin.index')->with('error', 'Karyawan Vaksin gagal ditambah');
        }
    }

    public function edit($id)
    {
        try
        {
            $relKaryawanVaksin = RelKaryawanVaksin::find(decrypt($id));

            return view('pages.karyawan-vaksin.edit', [
                'relKaryawanVaksin' => $relKaryawanVaksin
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
            $userInfo   = auth()->user();
            if ($request->sertifikat && $request->sertifikat !== null)
            {
                $imgName    = str()->slug($request->vaksin)."_karyawan-{$request->karyawan}";
                $extension  = $request->sertifikat->extension();
                $fileName   = "{$imgName}-{$extension}";
                $pathPrefix = "public/vaksin/{$request->karyawan}";
                $putContent = Storage::putFileAs($pathPrefix, $request->sertifikat, $fileName);
            }

            $putContent = $putContent ?? false;

            DB::transaction(function () use($id, $request, $putContent, $userInfo) {
                $relKaryawanVaksin             = RelKaryawanVaksin::find(decrypt($id));
                $relKaryawanVaksin->vaksin     = $request->input('vaksin');
                $relKaryawanVaksin->created_by = $userInfo->id;
                $relKaryawanVaksin->created_at = now();
                if ($request->vaksin && $request->vaksin !== null)
                {
                    $relKaryawanVaksin->sertifikat_vaksin = str_replace('public', 'storage', $putContent);
                }
                $relKaryawanVaksin->save();
            });

            return redirect()->route('karyawan-vaksin.index')->with('success', 'Karyawan Vaksin berhasil ditambah');
        }
        catch (\Throwable $th)
        {
            dd($th->getMessage());
            return redirect()->route('karyawan-vaksin.index')->with('error', 'Karyawan Vaksin gagal ditambah');
        }
    }
}
