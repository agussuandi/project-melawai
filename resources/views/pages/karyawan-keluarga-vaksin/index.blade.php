@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Karyawan Keluarga Vaksin</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('karyawan-keluarga-vaksin.create') }}" class="btn btn-primary mb-3">Tambah Karyawan Keluarga Vaksin</a>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Nama Keluarga</th>
                            <th>Hubungan Keluarga</th>
                            <th>Vaksin</th>
                            <th>Sertifikat</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($relKaryawanKeluargaVaksinSertifikat as $key => $relVaksin)
                            <tr>
                                <td>{{ $relKaryawanKeluargaVaksinSertifikat->firstItem() + $key }}</td>
                                <td>{{ $relVaksin->relKaryawanKeluargaVaksin->karyawan->name }}</td>
                                <td>{{ $relVaksin->name }}</td>
                                <td>{{ $relVaksin->vaksin }}</td>
                                <td>{{ $relVaksin->relation }}</td>
                                <td>
                                    <a href="{{ url($relVaksin->sertifikat_vaksin) }}" target="_blank">Lihat / Unduh</a>
                                </td>
                                <td>
                                    <a href="{{ route('karyawan-keluarga-vaksin.edit', encrypt($relVaksin->id)) }}">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Data Tidak Ada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('javascript')

@endsection