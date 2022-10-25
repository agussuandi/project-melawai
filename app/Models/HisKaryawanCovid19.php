<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HisKaryawanCovid19 extends Model
{
    use HasFactory;

    protected $table = 'his_karyawan_covid19';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function karyawan()
    {
        return $this->hasOne(MKaryawan::class, 'id', 'karyawan_id');
    }
}
