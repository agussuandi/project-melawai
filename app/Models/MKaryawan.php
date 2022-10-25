<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKaryawan extends Model
{
    use HasFactory;

    protected $table = 'm_karyawan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function scopePositif($query)
    {
        $query->where('flag_covid19', 1);
    }

    public function scopeNegatif($query)
    {
        $query->where('flag_covid19', 0);
    }

    public function relKaryawanKeluargaVaksin()
    {
        return $this->hasOne(RelKaryawanKeluargaVaksin::class, 'karyawan_id', 'id');
    }
}
