@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Tambah Karyawan</h4>
        </div>
        <form action="{{ route('karyawan.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" autofocus required maxlength="200"  />
                </div>
                <div class="mb-3">
                    <label for="birthDate" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="birthDate" name="birthDate" placeholder="Name" autocomplete="off" required  />
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea name="address" id="address" class="form-control" style="height: 90px"></textarea>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select name="jabatan" id="jabatan" class="form-control">
                        <option value="" disabled selected>-- Pilih Jabatan --</option>
                        <option value="Staff IT">Staff IT</option>
                        <option value="Staff Keuangan">Staff Keuangan</option>
                        <option value="Staff HR">Staff HR</option>
                        <option value="Super Visor">Super Visor</option>
                        <option value="Manager">Manager</option>
                    </select>
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