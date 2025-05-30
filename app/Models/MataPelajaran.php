<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';
    protected $fillable = ['nama_mapel', 'id_guru'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_mapel');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_mapel');
    }
}