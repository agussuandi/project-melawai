<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelKaryawanKeluargaVaksinSertifikat extends Model
{
    use HasFactory;

    protected $table = 'rel_karyawan_keluarga_vaksin_sertifikat';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function relKaryawanKeluargaVaksin()
    {
        return $this->hasOne(RelKaryawanKeluargaVaksin::class, 'id', 'karyawan_keluarga_vaksin_id');
    }
}
