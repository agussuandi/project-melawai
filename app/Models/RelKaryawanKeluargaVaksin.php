<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelKaryawanKeluargaVaksin extends Model
{
    use HasFactory;

    protected $table = 'rel_karyawan_keluarga_vaksin';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function karyawan()
    {
        return $this->hasOne(MKaryawan::class, 'id', 'karyawan_id');
    }

    public function relKaryawanKeluargaVaksinSertifikat()
    {
        return $this->hasMany(RelKaryawanKeluargaVaksinSertifikat::class, 'karyawan_keluarga_vaksin_id', 'id');
    }
}
