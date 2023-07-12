<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    public function up()
    {
        Schema::create('tb_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai', 100);
            $table->string('jk', 20);
            $table->string('nohp', 15);
            $table->foreignId('id_jabatan')->constrained('tb_jabatan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('tb_user')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pegawai');
    }
}
