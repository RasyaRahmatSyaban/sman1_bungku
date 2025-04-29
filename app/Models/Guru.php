<?php

// app/Models/Guru.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $fillable = ['nama', 'nip', 'alamat'];

    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'guru_id');
    }
    
    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'wali_kelas_id');
    }
}
