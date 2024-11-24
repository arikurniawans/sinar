<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_binaans', function (Blueprint $table) {
            $table->id('idbinaan'); // Menetapkan idbinaan sebagai primary key dan auto-increment
            $table->string('nama');
            $table->string('nik');
            $table->string('no_kk');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('alamat_ktp')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('dusun')->nullable();
            $table->string('nama_kel')->nullable();
            $table->string('nama_kec')->nullable();
            $table->string('nama_kabkot')->nullable();
            $table->string('nama_prop')->nullable();
            $table->integer('ragam_disabilitas'); // Mengubah ragam_disabilitas menjadi integer
            $table->string('wisma')->nullable();
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_binaans');
    }
};
