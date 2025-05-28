<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Schema::table('items', function (Blueprint $table) {
        //     $table->renameColumn('nama', 'namaBarang'); // Aktifkan ini untuk mengubah nama colom
        // });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->renameColumn('namaBarang', 'nama'); // Untuk rollback
        });
    }
};
