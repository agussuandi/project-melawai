@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Form Log Covid 19 Karyawan</h4>
        </div>
        <form action="{{ route('karyawan.covid.log.store', encrypt($hisKaryawanCovid19->karyawan->id)) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" autocomplete="off" value="{{ $hisKaryawanCovid19->karyawan->name }}" disabled />
                </div>
                <div class="mb-3">
                    <label for="birthDate" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="birthDate" disabled value="{{ $hisKaryawanCovid19->karyawan->birth_date }}"  />
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea id="address" class="form-control" disabled>{{ $hisKaryawanCovid19->karyawan->address }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" disabled value="{{ $hisKaryawanCovid19->karyawan->jabatan }}"  />
                </div>
                <div class="mb-3">
                    <label for="positiveDate" class="form-label">Tanggal Positif Covid19</label>
                    <input type="text" class="form-control" id="positiveDate" name="positiveDate" value="{{ $hisKaryawanCovid19->positive_date }}" readonly  />
                </div>
                <hr/>
                <div class="mb-3">
                    <label for="note" class="form-label">Keterangan</label>
                    <textarea id="note" name="note" class="form-control"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('karyawan.index') }}" class="btn btn-warning">Kembali</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@stop
@section('javascript')

@endsection