@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Karyawan Vaksin Sertifikat</h4>
        </div>
        <form action="{{ route('karyawan-keluarga-vaksin.update', encrypt($relKaryawanKeluargaVaksinSertifikat->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3">
                    <label for="karyawan" class="form-label">Karyawan</label>
                    <input type="text" class="form-control" id="karyawan" disabled value="{{ $relKaryawanKeluargaVaksinSertifikat->relKaryawanKeluargaVaksin->karyawan->name }}" />
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Keluarga</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Keluarga" autocomplete="off" maxlength="200" value="{{ $relKaryawanKeluargaVaksinSertifikat->name }}" />
                </div>
                <div class="mb-3">
                    <label for="relation" class="form-label">Hubungan Keluarga</label>
                    <input type="text" class="form-control" id="relation" name="relation" placeholder="Hubungan Keluarga" autocomplete="off" maxlength="50" value="{{ $relKaryawanKeluargaVaksinSertifikat->relation }}" />
                </div>
                <div class="mb-3">
                    <label for="vaksin" class="form-label">Vaksin</label>
                    <select name="vaksin" id="vaksin" name="vaksin" class="form-control">
                        <option value="" disabled selected>-- Pilih Vaksin --</option>
                        <option value="Vaksin 1" {{ $relKaryawanKeluargaVaksinSertifikat->vaksin === 'Vaksin 1' ? 'selected' : '' }}>Vaksin 1</option>
                        <option value="Vaksin 2" {{ $relKaryawanKeluargaVaksinSertifikat->vaksin === 'Vaksin 2' ? 'selected' : '' }}>Vaksin 2</option>
                        <option value="Vaksin Booster 1" {{ $relKaryawanKeluargaVaksinSertifikat->vaksin === 'Vaksin Booster 1' ? 'selected' : '' }}>Vaksin Booster 1</option>
                        <option value="Vaksin Booster 2" {{ $relKaryawanKeluargaVaksinSertifikat->vaksin === 'Vaksin Booster 2' ? 'selected' : '' }}>Vaksin Booster 2</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="vaksin" class="form-label">Sertifikat</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="sertifikat" name="sertifikat" />
                    </div>
                </div>
                <div class="mb-3">
                    <label for="currentSertifikat" class="form-label">Sertifikat Sebelumnya</label>
                    <br />
                    <a href="{{ url($relKaryawanKeluargaVaksinSertifikat->sertifikat_vaksin) }}" target="_blank">Lihat Sertifikat</a>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@stop
@section('javascript')

@endsection