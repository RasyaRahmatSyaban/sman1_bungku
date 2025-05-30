<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'id_wali_kelas'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'id_wali_kelas');
    }
}