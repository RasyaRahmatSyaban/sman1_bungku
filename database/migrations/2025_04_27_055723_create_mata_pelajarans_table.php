<?php

// database/migrations/xxxx_xx_xx_create_mata_pelajaran_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataPelajaransTable extends Migration
{
    public function up()
    {
        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mapel');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->foreignId('guru_id')->constrained('guru', 'id', 'guru_id'
            )->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('id_kelas')->constrained('kelas', 'id', 'id_kelas'
            )->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mata_pelajaran');
    }
}

