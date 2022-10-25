@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Home</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th width="20%">Karyawan Positif</th>
                    <td>{{ sizeof($karyawanPositif) }} Karyawan</td>
                </tr>
                <tr>
                    <th width="20%">Karyawan Negatif</th>
                    <td>{{ sizeof($karyawanNegatif) }} Karyawan</td>
                </tr>
            </table>
            <hr />
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
                        @forelse ($hisKaryawanCovid19 as $key => $employee)
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
            <hr />
            <h4>Data Monitoring Vaksin Keluarga Karyawan</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Jabatan</th>
                            <th>Alamat</th>
                            <th>Jumlah Anggota Keluarga Sudah Vaksin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($karyawan as $key => $employee)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->jabatan }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>{{ isset($employee->relKaryawanKeluargaVaksin->relKaryawanKeluargaVaksinSertifikat) ? sizeof($employee->relKaryawanKeluargaVaksin->relKaryawanKeluargaVaksinSertifikat) : 0 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data Tidak Ada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
@stop
@section('javascript')

@endsection