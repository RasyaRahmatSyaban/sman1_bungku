<?php

// app/Models/Guru.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $fillable = ['id_user', 'nama', 'nip', 'alamat'];

    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'id_guru');
    }
    
    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_wali_kelas');
    }
}
