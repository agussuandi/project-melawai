@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Karyawan Vaksin</h4>
        </div>
        <form action="{{ route('karyawan-vaksin.update', encrypt($relKaryawanVaksin->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3">
                    <label for="karyawan" class="form-label">Karyawan</label>
                    <input type="text" class="form-control" id="karyawan" disabled value="{{ $relKaryawanVaksin->karyawan->name }}" />
                </div>
                <div class="mb-3">
                    <label for="vaksin" class="form-label">Vaksin</label>
                    <select name="vaksin" id="vaksin" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Vaksin --</option>
                        <option value="Vaksin 1" {{ $relKaryawanVaksin->vaksin === 'Vaksin 1' ? 'selected' : '' }}>Vaksin 1</option>
                        <option value="Vaksin 2" {{ $relKaryawanVaksin->vaksin === 'Vaksin 2' ? 'selected' : '' }}>Vaksin 2</option>
                        <option value="Vaksin Booster 1" {{ $relKaryawanVaksin->vaksin === 'Vaksin Booster 1' ? 'selected' : '' }}>Vaksin Booster 1</option>
                        <option value="Vaksin Booster 2" {{ $relKaryawanVaksin->vaksin === 'Vaksin Booster 2' ? 'selected' : '' }}>Vaksin Booster 2</option>
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
                    <a href="{{ url($relKaryawanVaksin->sertifikat_vaksin) }}" target="_blank">Lihat Sertifikat</a>
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