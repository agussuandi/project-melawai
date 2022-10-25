@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Karyawan</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Jabatan</th>
                            <th>Status Kesehatan</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($karyawan as $key => $employee)
                            <tr>
                                <td>{{ $karyawan->firstItem() + $key }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->birth_date }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>{{ $employee->jabatan }}</td>
                                <td>
                                    {!! (bool)$employee->flag_covid19 
                                        ? '<span class="badge text-bg-danger">Positif Covid 19</span>' 
                                        : '<span class="badge text-bg-primary">Negatif Covid 19</span>'
                                    !!}
                                </td>
                                <td>
                                    <a href="{{ route('karyawan.edit', encrypt($employee->id)) }}">Edit</a>
                                    <div class="clearfix"></div>
                                    @if ($employee->flag_covid19 === 0)
                                        <a href="{{ route('karyawan.covid.index', encrypt($employee->id)) }}">Positif Covid</a>
                                    @else
                                        <a href="{{ route('karyawan.covid.edit', encrypt($employee->id)) }}">Pulih Covid</a>
                                        <div class="clearfix"></div>
                                        <a href="{{ route('karyawan.covid.log.create', encrypt($employee->id)) }}">Tambah Log Covid</a>
                                    @endif
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
            {{ $karyawan->links() }}
        </div>
    </div>
@stop
@section('javascript')

@endsection