@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Form Pemulihan Covid 19 Karyawan</h4>
        </div>
        <form action="{{ route('karyawan.covid.update', encrypt($hisKaryawanCovid19->karyawan->id)) }}" method="POST">
            @csrf
            @method('PUT')
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
                <hr/>
                <div class="mb-3">
                    <label for="positiveDate" class="form-label">Tanggal Positif Covid19</label>
                    <input type="text" class="form-control" id="positiveDate" name="positiveDate" value="{{ $hisKaryawanCovid19->positive_date }}" readonly  />
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Keterangan</label>
                    <textarea id="note" class="form-control" disabled>{{ $hisKaryawanCovid19->note }}</textarea>
                </div>
                <h4>Data Monitoring Karyawan Positif Covid19</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Karyawan</th>
                                <th>Tanggal Positif</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hisKaryawanCovid19History as $key => $employee)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $employee->karyawan->name }}</td>
                                    <td>{{ $employee->positive_date }}</td>
                                    <td>{{ $employee->note }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data Tidak Ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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