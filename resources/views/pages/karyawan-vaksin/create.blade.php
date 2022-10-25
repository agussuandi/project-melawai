@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Tambah Karyawan Vaksin</h4>
        </div>
        <form action="{{ route('karyawan-vaksin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="karyawan" class="form-label">Karyawan</label>
                    <select name="karyawan" id="karyawan" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Karyawan --</option>
                        @foreach ($karyawan as $key => $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="vaksin" class="form-label">Vaksin</label>
                    <select name="vaksin" id="vaksin" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Vaksin --</option>
                        <option value="Vaksin 1">Vaksin 1</option>
                        <option value="Vaksin 2">Vaksin 2</option>
                        <option value="Vaksin Booster 1">Vaksin Booster 1</option>
                        <option value="Vaksin Booster 2">Vaksin Booster 2</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="vaksin" class="form-label">Sertifikat</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="sertifikat" name="sertifikat" required />
                    </div>
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