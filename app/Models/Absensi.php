<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $fillable = ['id_siswa', 'id_jadwal', 'tanggal', 'status'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
}