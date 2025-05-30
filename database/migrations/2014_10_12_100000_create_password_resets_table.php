<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('role', ['siswa', 'guru']);
            $table->string('jurusan')->nullable();
            $table->string('kelas')->nullable();
            $table->timestamps();
            $table->enum('status', ['belum_kembali', 'sudah_kembali'])
                  ->default('belum_kembali')
                  ->after('kelas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
};