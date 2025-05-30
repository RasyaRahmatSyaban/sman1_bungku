<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = ['id_kelas','id_mapel', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function mata_pelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel');
    }
}
