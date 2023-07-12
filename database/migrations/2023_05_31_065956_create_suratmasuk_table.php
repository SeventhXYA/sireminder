<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratmasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_suratmasuk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tb_user')->onUpdate('cascade')->onDelete('cascade');
            $table->string('pengirim', 100);
            $table->string('no_surat')->nullable();
            $table->string('tgl_surat')->nullable();
            $table->text('perihal');
            $table->foreignId('id_status')->nullable()->constrained('tb_status')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('id_rencanakerja')->nullable()->constrained('tb_rencanakerja')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('tb_user')->onDelete('set null');
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
        Schema::dropIfExists('tb_suratmasuk');
    }
}
