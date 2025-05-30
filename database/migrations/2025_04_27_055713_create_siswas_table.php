<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users', 'id')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->string('nama');
            $table->string('nis')->unique();
            $table->text('alamat');
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->foreignId('id_kelas')->constrained('kelas', 'id')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
