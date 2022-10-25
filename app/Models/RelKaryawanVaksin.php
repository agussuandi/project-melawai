<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelKaryawanVaksin extends Model
{
    use HasFactory;

    protected $table = 'rel_karyawan_vaksin';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function karyawan()
    {
        return $this->hasOne(MKaryawan::class, 'id', 'karyawan_id');
    }
}
