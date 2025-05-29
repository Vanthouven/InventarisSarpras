<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowing_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrowing_id')
                  ->constrained('borrowings')
                  ->onDelete('cascade');
            $table->foreignId('item_id')
                  ->constrained('items')
                  ->onDelete('restrict');
            $table->unsignedInteger('quantity')->default(1);
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
        Schema::dropIfExists('borrowing_item');
    }
}
