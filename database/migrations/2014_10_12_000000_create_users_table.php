<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Nama user untuk admin atau petugas, unik, nullable bagi viewer
            $table->string('name')->nullable()->unique();
            // Password untuk admin atau petugas, nullable bagi viewer
            $table->string('password')->nullable();
            // Role: admin, petugas, atau viewer (viewer tidak input name/password)
            $table->enum('role', ['admin', 'petugas', 'viewer']);
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
        Schema::dropIfExists('users');
        Schema::table('users', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
