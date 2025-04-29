<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa', 'id', 'siswa_id'
            )->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('mapel_id')->constrained('mata_pelajaran', 'id', 'mapel_id'
            )->onUpdate('cascade')->onDelete('restrict');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai');
    }
}
