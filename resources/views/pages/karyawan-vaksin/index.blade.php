@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Karyawan Vaksin</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('karyawan-vaksin.create') }}" class="btn btn-primary mb-3">Tambah Karyawan Vaksin</a>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Vaksin</th>
                            <th>Sertifikat</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($relKaryawanVaksin as $key => $relVaksin)
                            <tr>
                                <td>{{ $relKaryawanVaksin->firstItem() + $key }}</td>
                                <td>{{ $relVaksin->karyawan->name }}</td>
                                <td>{{ $relVaksin->vaksin }}</td>
                                <td>
                                    <a href="{{ url($relVaksin->sertifikat_vaksin) }}" target="_blank">Lihat / Unduh</a>
                                </td>
                                <td>
                                    <a href="{{ route('karyawan-vaksin.edit', encrypt($relVaksin->id)) }}">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data Tidak Ada</td>
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