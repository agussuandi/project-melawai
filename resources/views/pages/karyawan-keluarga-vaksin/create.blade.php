@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Tambah Karyawan Keluarga Vaksin</h4>
        </div>
        <form action="{{ route('karyawan-keluarga-vaksin.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="name" class="form-label">Nama Keluarga</label>
                    <input type="text" class="form-control" id="name" placeholder="Nama Keluarga" autocomplete="off" maxlength="200" />
                </div>
                <div class="mb-3">
                    <label for="relation" class="form-label">Hubungan Keluarga</label>
                    <input type="text" class="form-control" id="relation" placeholder="Hubungan Keluarga" autocomplete="off" maxlength="50" />
                </div>
                <div class="mb-3">
                    <label for="vaksin" class="form-label">Vaksin</label>
                    <select name="vaksin" id="vaksin" class="form-control">
                        <option value="" disabled selected>-- Pilih Vaksin --</option>
                        <option value="Vaksin 1">Vaksin 1</option>
                        <option value="Vaksin 2">Vaksin 2</option>
                        <option value="Vaksin Booster 1">Vaksin Booster 1</option>
                        <option value="Vaksin Booster 2">Vaksin Booster 2</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-info text-light" onclick="handleAddKeluarga()">Add Keluarga</button>
                </div>
                <div class="mb-3">
                    <label for="keluarga" class="form-label">Daftar Anggota Keluarga</label>
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-hover" id="table-keluarga">
                            <thead>
                                <tr>
                                    <th>Nama Keluarga</th>
                                    <th>Hubungan Keluarga</th>
                                    <th>Vaksin</th>
                                    <th>Sertifikat Vaksin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="tr-empyt">
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            </tbody>
                        </table>
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
    <script>
        handleAddKeluarga = async () => {
            const elTable = document.getElementById('table-keluarga')
            const eltableBody = elTable.getElementsByTagName('tbody')[0]
            const elBodyRow = await eltableBody.getElementsByTagName('tr')

            let elVaksin       = document.getElementById('vaksin')
            let elRelation     = document.getElementById('relation')
            let elNamaKeluarga = document.getElementById('name')

            const elEmpty = document.getElementById('tr-empyt')
            
            if (elEmpty !== undefined && elEmpty !== null) {
                elEmpty.remove()
            }

            eltableBody.insertRow().innerHTML = `
                <td>
                    <input type="text" class="form-control" name="name[]" value="${elNamaKeluarga.value}" required readonly />
                </td>
                <td>
                    <input type="text" class="form-control" name="relation[]" value="${elRelation.value}" required readonly />
                </td>
                <td>
                    <input type="text" class="form-control" name="vaksin[]" value="${elVaksin.value}" required readonly />
                </td>
                <td>
                    <div class="input-group">
                        <input type="file" class="form-control" name="sertifikat[]" required />
                    </div>
                </td>
            `

            // elVaksin.value = ''
            // elRelation.value = ''
            // elNamaKeluarga = ''
        }
    </script>
@endsection