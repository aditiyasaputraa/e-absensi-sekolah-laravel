<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Absensi;

class Siswa extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'kelas',
    ];
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}
